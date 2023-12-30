<?php

namespace App\Controllers;

use App\Models\Permohonanmodels;

class Arsip extends BaseController
{
    protected $permohonanModels;
    protected $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->permohonanModels = new Permohonanmodels();
    }
    public function index()
    {
        $arsip = $this->permohonanModels->select('permohonan.*, surat.nama_surat')
            ->join('surat', 'surat.id_surat = permohonan.id_surat')
            ->where('status_verif', 'Disetujui')
            ->where('scan_surat IS NOT NULL')
            ->orderBy('no_srt', 'DESC')
            ->findAll();
        $data = [
            'title' => 'Arsip Surat | SIPS Kemlokolegi',
            'arsip' => $arsip
        ];
        return view('pengarsipan/arsip_surat', $data);
    }

    public function detail($id)
    {
        $permohonan = $this->permohonanModels->select('permohonan.*, surat.nama_surat')
            ->join('surat', 'surat.id_surat = permohonan.id_surat')->find($id);

        $data = [
            'title' => 'Detail Arsip | SIPS Kemlokolegi',
            'permohonan' => $permohonan
        ];
        return view('pengarsipan/detail_arsip', $data);
    }

    public function upload_scan_baru()
    {
        $id = $this->request->getVar('id');

        if (!$this->validate([
            'scan' => [
                'rules' => 'uploaded[scan]|is_image[scan]|mime_in[scan,image/jpg,image/jpeg,image/png]|max_size[scan,1024]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to(base_url() . '/arsip-surat/detail/' . $id)->with('error', 'File tidak sesuai dengan ketentuan atau belum dipilih')->withInput();
        }

        $id = $this->request->getVar('id');
        $data = $this->permohonanModels->find($id);

        $fileScan = $this->request->getFile('scan');

        $namaScan = $fileScan->getRandomName();

        $namaScanLama = $data['scan_surat'];

        $data = [
            'scan_surat' => $namaScan
        ];

        if ($this->permohonanModels->update($id, $data)) {
            $fileScan->move(APPPATH . 'dokumen/scan/', $namaScan);
            unlink(APPPATH . 'dokumen/scan/' . $namaScanLama);
            session()->setFlashdata('success', 'Perubahan tersimpan');
        } else {
            session()->setFlashdata('error', 'Perubahan tidak tersimpan');
        }

        return redirect()->to('/arsip-surat/detail/' . $id);
    }

    public function hapus($id)
    {
        $data = $this->permohonanModels->find($id);

        $dokumenNames = explode(',', $data['dokumen']);

        $scanNames = $data['scan_surat'];

        if ($this->permohonanModels->delete($id)) {
            foreach ($dokumenNames as $fileName) {
                // Hapus file dari direktori
                unlink(APPPATH . 'dokumen/uploads/' . $fileName);
            }

            unlink(APPPATH . 'dokumen/scan/' . $scanNames);

            session()->setFlashdata('success', 'Arsip permohonan berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Arsip permohonan gagal dihapus');
        }

        return redirect()->to('/arsip-surat');
    }
}
