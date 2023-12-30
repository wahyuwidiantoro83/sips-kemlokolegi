<?php

namespace App\Controllers;

use App\Models\Permohonanmodels;
use CodeIgniter\HTTP\URI;

class Verifikasi extends BaseController
{
    protected $permohonanModels;
    protected $db;
    protected $kirimPesan;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->kirimPesan = new KirimPesan();
        $this->permohonanModels = new Permohonanmodels();
    }
    public function index()
    {
        $permohonan = $this->permohonanModels->select('permohonan.*, surat.nama_surat')
            ->join('surat', 'surat.id_surat = permohonan.id_surat')->where('status_verif', 'Menunggu')
            ->findAll();
        $data = [
            'title' => 'Permohonan Baru | SIPS Kemlokolegi',
            'permohonan' => $permohonan
        ];
        return view('pengarsipan/data_permohonan', $data);
    }

    public function permohonan_disetujui()
    {
        $permohonan = $this->permohonanModels->select('permohonan.*, surat.nama_surat')
            ->join('surat', 'surat.id_surat = permohonan.id_surat')->where('status_verif', 'Disetujui')->where('scan_surat', NULL)
            ->findAll();
        $data = [
            'title' => 'Permohonan Disetujui| SIPS Kemlokolegi',
            'permohonan' => $permohonan,
            'validation' => validation_errors(),
        ];
        return view('pengarsipan/permohonan_disetujui', $data);
    }
    public function permohonan_ditolak()
    {
        $permohonan = $this->permohonanModels->select('permohonan.*, surat.nama_surat')
            ->join('surat', 'surat.id_surat = permohonan.id_surat')->where('status_verif', 'Ditolak')
            ->findAll();
        $data = [
            'title' => 'Permohonan Ditolak| SIPS Kemlokolegi',
            'permohonan' => $permohonan
        ];
        return view('pengarsipan/permohonan_ditolak', $data);
    }

    public function form_verifikasi($id)
    {
        $permohonan = $this->permohonanModels->select('permohonan.*, surat.nama_surat')
            ->join('surat', 'surat.id_surat = permohonan.id_surat')->find($id);

        // membuat format nomor
        $tahun_sekarang = date('Y');
        $query_nomor = $this->db->table('nomor')->select('no_instansi, no_referensi')->limit(1)->get();
        $nomorsurat = $query_nomor->getRowArray();
        $nomorsurat_baru = 1;

        $nomor_verif = $this->permohonanModels->select('no_srt')->where('tahun_srt', $tahun_sekarang)->orderBy('no_srt', 'DESC')->first();

        // dd($nomor_verif);
        if ($nomor_verif) {
            $nomorsurat_terakhir = $nomor_verif['no_srt'];
            $nomorsurat_baru = $nomorsurat_terakhir + 1;
        }

        $data = [
            'title' => 'Verifikasi Permohonan | SIPS Kemlokolegi',
            'permohonan' => $permohonan,
            'nomor_surat' => $nomorsurat_baru,
            'no_instansi' => $nomorsurat['no_instansi'],
            'no_referensi' => $nomorsurat['no_referensi']
        ];
        return view('pengarsipan/form_verifikasi', $data);
    }

    public function setuju()
    {
        $id_permohonan = $this->request->getVar('id_permohonan');
        if (!$this->validate([
            'no_srt' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No surat harus diisi. '
                ]
            ],
            'no_instansi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No instansi harus diisi. '
                ]
            ],
            'no_ref' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No referensi harus diisi. '
                ]
            ],
            'tahun_srt' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun surat harus diisi. '
                ]
            ],
            'keperluan' => [
                'rules' => 'required|max_length[300]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Keperluan harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. ',
                    'regex_match' => 'Terdapat karakter yang tidak valid'
                ]
            ]
        ])) {
            return redirect()->to(base_url() . '/permohonan-baru/verifikasi/' . $id_permohonan)->with('error', 'Data yang diinputkan tidak lengkap');
        }

        $tanggal = date('Y-m-d');

        $data = [
            'no_srt' => $this->request->getVar('no_srt'),
            'no_instansi' => $this->request->getVar('no_instansi'),
            'no_ref' => $this->request->getVar('no_ref'),
            'tahun_srt' => $this->request->getVar('tahun_srt'),
            'status_verif' => 'Disetujui',
            'tgl_verif' => $tanggal,
            'keperluan' => $this->request->getVar('keperluan'),
        ];

        // $data = [
        //     'no_srt' => $this->request->getVar('no_srt'),
        //     'status_verif' => 'Disetujui',
        //     'tgl_verif' => $tanggal,
        //     'keperluan' => $this->request->getVar('keperluan'),
        //     'penghasilan' => $penghasilan
        // ];

        if ($this->request->getVar('penghasilan')) {
            $penghasilan = $this->request->getVar('penghasilan');
            $datapenghasilan = [
                'penghasilan' => $penghasilan
            ];
            $data = $data + $datapenghasilan;
        }

        if ($this->request->getVar('nik_dimohon')) {

            $nik = $this->request->getVar('nik_dimohon');
            $nama = $this->request->getVar('nama_dimohon');
            $ttl = $this->request->getVar('ttl_dimohon');
            $jk = $this->request->getVar('jk_dimohon');
            $alamat = $this->request->getVar('alamat_dimohon');
            $pendidikan = $this->request->getVar('pendidikan');
            $kelas = $this->request->getVar('kelas');

            $datakelas = [
                'nik_dimohon' => $nik,
                'nama_dimohon' => $nama,
                'ttl_dimohon' => $ttl,
                'jk_dimohon' => $jk,
                'alamat_dimohon' => $alamat,
                'pendidikan' => $pendidikan,
                'kelas' => $kelas
            ];
            $data = $data + $datakelas;
        }

        if ($this->request->getVar('tglacara')) {
            $tglacara = $this->request->getVar('tglacara');
            $waktuacara = $this->request->getVar('waktuacara');
            $datapenghasilan = [
                'tglacara' => $tglacara,
                'waktuacara' => $waktuacara
            ];
            $data = $data + $datapenghasilan;
        }

        if ($this->request->getVar('nama_usaha')) {
            $namausaha = $this->request->getVar('nama_usaha');
            $alamatusaha = $this->request->getVar('alamat_usaha');
            $datapenghasilan = [
                'nama_usaha' => $namausaha,
                'alamat_usaha' => $alamatusaha
            ];
            $data = $data + $datapenghasilan;
        }

        if ($this->permohonanModels->update($id_permohonan, $data)) {
            session()->setFlashdata('pesan', 'Verifikasi berhasil');
        } else {
            session()->setFlashdata('gagal', 'Verifikasi gagal');
        }


        return redirect()->to('/permohonan-baru');
    }
    public function tolak()
    {
        $id_permohonan = $this->request->getVar('id_permohonan');
        $tanggal = date('Y-m-d');

        $data = [
            'status_verif' => 'Ditolak',
            'tgl_verif' => $tanggal
        ];

        $permohonan = $this->permohonanModels->select('permohonan.*, surat.nama_surat')
            ->join('surat', 'surat.id_surat = permohonan.id_surat')->find($id_permohonan);

        $alasan = $this->request->getVar('alasan');

        if ($this->permohonanModels->update($id_permohonan, $data)) {
            session()->setFlashdata('pesan', 'Perubahan tersimpan');
            $this->kirimPesan->send_fail(
                $permohonan['telp_pemohon'],
                $permohonan['nama_pemohon'],
                $permohonan['nama_surat'],
                $permohonan['keperluan'],
                $permohonan['tgl_pengajuan'],
                $tanggal,
                $alasan
            );
        } else {
            session()->setFlashdata('gagal', 'Perubahan tidak tersimpan');
        }

        return redirect()->to('/permohonan-baru');
    }

    public function upload_scan()
    {
        if (!$this->validate([
            'dokumen' => [
                'rules' => 'uploaded[dokumen]|is_image[dokumen]|mime_in[dokumen,image/jpg,image/jpeg,image/png]|max_size[dokumen,1024]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to(base_url() . '/permohonan-disetujui')->with('error', 'Belum mengupload file scan baru')->withInput();
        }

        $id = $this->request->getVar('id');

        $permohonan = $this->permohonanModels->select('permohonan.*, surat.nama_surat')
            ->join('surat', 'surat.id_surat = permohonan.id_surat')->find($id);
        $no_surat = $permohonan['no_instansi'] . '/' . $permohonan['no_srt'] . '/' . $permohonan['no_ref'] . '/' . $permohonan['tahun_srt'];

        $filedokumen = $this->request->getFile('dokumen');

        $namadokumen = $filedokumen->getRandomName();
        //pindahkan file sampul
        $filedokumen->move(APPPATH . 'dokumen/scan/', $namadokumen);

        $data = [
            'scan_surat' => $namadokumen
        ];

        if ($this->permohonanModels->update($id, $data)) {
            $this->kirimPesan->send_success(
                $permohonan['telp_pemohon'],
                $permohonan['nama_pemohon'],
                $permohonan['nama_surat'],
                $no_surat,
                $permohonan['keperluan'],
                $permohonan['tgl_verif'],
                $namadokumen
            );
            session()->setFlashdata('pesan', 'Perubahan tersimpan');
        } else {
            session()->setFlashdata('gagal', 'Perubahan tidak tersimpan');
        }

        return redirect()->to('/permohonan-disetujui');
    }

    public function hapus($id)
    {
        $data = $this->permohonanModels->find($id);

        $fileNames = explode(',', $data['dokumen']);

        if ($this->permohonanModels->delete($id)) {
            foreach ($fileNames as $fileName) {
                // Hapus file dari direktori
                unlink(APPPATH . 'dokumen/uploads/' . $fileName);
            }
            session()->setFlashdata('pesan', 'Data permohonan berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Data permohonan gagal dihapus');
        }

        return redirect()->to('/permohonan-ditolak');
    }
}
