<?php

namespace App\Controllers;

use App\Models\Permohonanmodels;
use App\Models\Suratmodels;
use App\Models\Usermodels;

class Permohonan extends BaseController
{
    protected $suratModels;
    protected $permohonanModels;
    protected $userModels;
    protected $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->suratModels = new Suratmodels();
        $this->permohonanModels = new Permohonanmodels();
        $this->userModels = new Usermodels();
    }

    public function index()
    {
        $surat = $this->suratModels->getActiveSurat();
        $data = [
            'title' => 'Permohonan | SIPS Kemlokolegi',
            'surat' => $surat
        ];
        return view('permohonan/permohonan', $data);
    }

    public function livesearch()
    {
        $data = [];
        $user = $this->userModels->builder('users')->like('username', $this->request->getVar('q'))
            ->select('username as id, username as text, nama, tempat, tgllhr, alamat, jk, telp, agama, kawin, pekerjaan')
            ->limit(10)->get();;
        $data = $user->getResult();

        echo json_encode($data);
    }

    public function form1()
    {
        $data = [
            'title' => 'SKTM (Umum) | SIPS Kemlokolegi',
            'validation' => validation_errors(),
        ];
        return view('permohonan/form_1', $data);
    }

    public function form2()
    {
        $data = [
            'title' => 'Surat Keterangan Penghasilan | SIPS Kemlokolegi',
            'validation' => validation_errors(),
        ];
        return view('permohonan/form_2', $data);
    }

    public function form3()
    {
        $data = [
            'title' => 'SKTM (Beasiswa) | SIPS Kemlokolegi',
            'validation' => validation_errors(),
        ];
        return view('permohonan/form_3', $data);
    }

    public function form4()
    {
        $data = [
            'title' => 'Surat Keterangan Ijin Hiburan | SIPS Kemlokolegi',
            'validation' => validation_errors(),
        ];
        return view('permohonan/form_4', $data);
    }

    public function form5()
    {
        $data = [
            'title' => 'Surat Keterangan Usaha| SIPS Kemlokolegi',
            'validation' => validation_errors(),
        ];
        return view('permohonan/form_5', $data);
    }

    public function form6()
    {
        $data = [
            'title' => 'Surat Keterangan Berkelakuan Baik | SIPS Kemlokolegi',
            'validation' => validation_errors(),
        ];
        return view('permohonan/form_6', $data);
    }

    public function form7()
    {
        $data = [
            'title' => 'Surat Keterangan Domisili | SIPS Kemlokolegi',
            'validation' => validation_errors(),
        ];
        return view('permohonan/form_7', $data);
    }

    public function form8()
    {
        // membuat format nomor
        if (in_groups('admin')) {
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
                'title' => 'Pengarsipan Surat Lainnya | SIPS Kemlokolegi',
                'nomor_surat' => $nomorsurat_baru,
                'no_instansi' => $nomorsurat['no_instansi'],
                'no_referensi' => $nomorsurat['no_referensi'],
                'validation' => validation_errors(),
            ];
            return view('permohonan/form_8', $data);
        }
    }

    public function form9()
    {
        $data = [
            'title' => 'Surat Pengantar KTP | SIPS Kemlokolegi',
            'validation' => validation_errors(),
        ];
        return view('permohonan/form_9', $data);
    }

    public function tambah_form_1()
    {
        $files = $this->request->getFileMultiple('dokumen');

        if (in_groups('admin')) {
            if (!$this->validate([
                'search' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'NIK harus diisi. '
                    ]
                ],
                'nama_pemohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                    'errors' => [
                        'required' => 'Nama pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'ttl_pemohon' => [
                    'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z0-9.,"\-\'\s]+$/]',
                    'errors' => [
                        'required' => 'Tempat tanggal lahir pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'jk_pemohon' => [
                    'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z"\-\'\s]+$/]',
                    'errors' => [
                        'required' => 'Jenis kelamin pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'status_pemohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                    'errors' => [
                        'required' => 'Status pernikahan pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'kerja_pemohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Pekerjaan pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'telp_pemohon' => [
                    'rules' => 'required|max_length[14]|numeric',
                    'errors' => [
                        'required' => 'No. Telp pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'alamat_pemohon' => [
                    'rules' => 'required|max_length[200]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Alamat pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'keperluan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Keperluan harus diisi. '
                    ]
                ],
                'dokumen' => [
                    'rules' => 'uploaded[dokumen]|is_image[dokumen]|mime_in[dokumen,image/jpg,image/jpeg,image/png]|max_size[dokumen,1024]',
                    'errors' => [
                        'max_size' => 'Ukuran gambar terlalu besar',
                        'is_image' => 'Yang anda pilih bukan gambar',
                        'mime_in' => 'Yang anda pilih bukan gambar'
                    ]
                ]
            ])) {
                return redirect()->to(base_url() . '/permohonan/form_1')->with('error', 'Data yang diinputkan tidak lengkap')->withInput();
            }
            $nik = $this->request->getVar('search');
            $nama = $this->request->getVar('nama_pemohon');

            $fileNames = [];

            foreach ($files as $file) {
                // Generate nama file yang unik
                $fileName = $file->getRandomName();

                // Pindahkan file ke folder yang ditentukan
                $file->move(APPPATH . 'dokumen/uploads/', $fileName);

                // Simpan nama file ke dalam array
                $fileNames[] = $fileName;
            }

            $this->permohonanModels->save([
                'id_surat' => '1',
                'nik_pemohon' => $nik,
                'nama_pemohon' => $nama,
                'ttl_pemohon' => $this->request->getVar('ttl_pemohon'),
                'jk_pemohon' => $this->request->getVar('jk_pemohon'),
                'status_pemohon' => $this->request->getVar('status_pemohon'),
                'kerja_pemohon' => $this->request->getVar('kerja_pemohon'),
                'alamat_pemohon' => $this->request->getVar('alamat_pemohon'),
                'telp_pemohon' => $this->request->getVar('telp_pemohon'),
                'keperluan' => $this->request->getVar('keperluan'),
                'dokumen' => implode(',', $fileNames),
                'status_verif' => 'Menunggu',
            ]);

            session()->setFlashdata('success', 'Permohonan berhasil diajukan');

            return redirect()->to('/permohonan');
        }

        if (!$this->validate([
            'nik_pemohon' => [
                'rules' => 'required|max_length[16]|numeric',
                'errors' => [
                    'required' => 'NIK pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'nama_pemohon' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                'errors' => [
                    'required' => 'Nama pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'ttl_pemohon' => [
                'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z0-9.,"\-\'\s]+$/]',
                'errors' => [
                    'required' => 'Tempat tanggal lahir pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'jk_pemohon' => [
                'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z"\-\'\s]+$/]',
                'errors' => [
                    'required' => 'Jenis kelamin pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'status_pemohon' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                'errors' => [
                    'required' => 'Status pernikahan pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'kerja_pemohon' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Pekerjaan pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'alamat_pemohon' => [
                'rules' => 'required|max_length[200]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Alamat pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'telp_pemohon' => [
                'rules' => 'required|max_length[14]|numeric',
                'errors' => [
                    'required' => 'No. Telp pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'keperluan' => [
                'rules' => 'required|max_length[300]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Keperluan harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. ',
                    'regex_match' => 'Terdapat karakter yang tidak valid'
                ]
            ],
            'dokumen' => [
                'rules' => 'uploaded[dokumen]|is_image[dokumen]|mime_in[dokumen,image/jpg,image/jpeg,image/png]|max_size[dokumen,1024]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to(base_url() . '/permohonan/form_1')->with('error', 'Data yang diinputkan tidak lengkap')->withInput();
        }

        $nik = $this->request->getVar('nik_pemohon');
        $nama = $this->request->getVar('nama_pemohon');
        $usernow = user()->username;

        //explode ttl
        $stringttl = $this->request->getVar('ttl_pemohon');
        $pecahan = explode(', ', $stringttl);
        $tempat = $pecahan[0];

        $valdat = $this->userModels->where('username', $nik)->asArray()->find();

        if (empty($valdat)) {
            return redirect()->to(base_url() . '/permohonan/form_1')->with('error', 'Data tidak ditemukan')->with('gagal', 'Data tidak ditemukan didatabase')->withInput();
        } else {
            if ($nik == $usernow && $nama == $valdat[0]['nama'] && $tempat == $valdat[0]['tempat']) {
                $fileNames = [];

                foreach ($files as $file) {
                    // Generate nama file yang unik
                    $fileName = $file->getRandomName();

                    // Pindahkan file ke folder yang ditentukan
                    $file->move(APPPATH . 'dokumen/uploads/', $fileName);

                    // Simpan nama file ke dalam array
                    $fileNames[] = $fileName;
                }

                $this->permohonanModels->save([
                    'id_surat' => '1',
                    'nik_pemohon' => $this->request->getVar('nik_pemohon'),
                    'nama_pemohon' => $this->request->getVar('nama_pemohon'),
                    'ttl_pemohon' => $this->request->getVar('ttl_pemohon'),
                    'jk_pemohon' => $this->request->getVar('jk_pemohon'),
                    'status_pemohon' => $this->request->getVar('status_pemohon'),
                    'kerja_pemohon' => $this->request->getVar('kerja_pemohon'),
                    'alamat_pemohon' => $this->request->getVar('alamat_pemohon'),
                    'telp_pemohon' => $this->request->getVar('telp_pemohon'),
                    'keperluan' => $this->request->getVar('keperluan'),
                    'dokumen' => implode(',', $fileNames),
                    'status_verif' => 'Menunggu',
                ]);

                session()->setFlashdata('success', 'Permohonan berhasil diajukan');

                return redirect()->to('/permohonan');
            } else {
                return redirect()->to(base_url() . '/permohonan/form_1')->with('error', 'Data yang diinputkan tidak sesuai')->with('gagal', 'Data tidak ditemukan didatabase')->withInput();
            }
        }
    }

    public function tambah_form_2()
    {
        $files = $this->request->getFileMultiple('dokumen');

        if (in_groups('admin')) {
            if (!$this->validate([
                'search' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'NIK harus diisi. '
                    ]
                ],
                'nama_pemohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                    'errors' => [
                        'required' => 'Nama pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'ttl_pemohon' => [
                    'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z0-9.,"\-\'\s]+$/]',
                    'errors' => [
                        'required' => 'Tempat tanggal lahir pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'jk_pemohon' => [
                    'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z"\-\'\s]+$/]',
                    'errors' => [
                        'required' => 'Jenis kelamin pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'status_pemohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                    'errors' => [
                        'required' => 'Status pernikahan pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'kerja_pemohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Pekerjaan pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'telp_pemohon' => [
                    'rules' => 'required|max_length[14]|numeric',
                    'errors' => [
                        'required' => 'No. Telp pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'alamat_pemohon' => [
                    'rules' => 'required|max_length[200]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Alamat pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'penghasilan' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Penghasilan pemohon harus diisi. '
                    ]
                ],
                'keperluan' => [
                    'rules' => 'required|max_length[300]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Keperluan harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. ',
                        'regex_match' => 'Terdapat karakter yang tidak valid'
                    ]
                ],
                'dokumen' => [
                    'rules' => 'uploaded[dokumen]|is_image[dokumen]|mime_in[dokumen,image/jpg,image/jpeg,image/png]|max_size[dokumen,1024]',
                    'errors' => [
                        'max_size' => 'Ukuran gambar terlalu besar',
                        'is_image' => 'Yang anda pilih bukan gambar',
                        'mime_in' => 'Yang anda pilih bukan gambar'
                    ]
                ]
            ])) {
                return redirect()->to(base_url() . '/permohonan/form_2')->with('error', 'Data yang diinputkan tidak lengkap')->withInput();
            }
            $nik = $this->request->getVar('search');
            $nama = $this->request->getVar('nama_pemohon');

            $fileNames = [];

            foreach ($files as $file) {
                // Generate nama file yang unik
                $fileName = $file->getRandomName();

                // Pindahkan file ke folder yang ditentukan
                $file->move(APPPATH . 'dokumen/uploads/', $fileName);

                // Simpan nama file ke dalam array
                $fileNames[] = $fileName;
            }

            $this->permohonanModels->save([
                'id_surat' => '2',
                'nik_pemohon' => $nik,
                'nama_pemohon' => $nama,
                'ttl_pemohon' => $this->request->getVar('ttl_pemohon'),
                'jk_pemohon' => $this->request->getVar('jk_pemohon'),
                'status_pemohon' => $this->request->getVar('status_pemohon'),
                'kerja_pemohon' => $this->request->getVar('kerja_pemohon'),
                'alamat_pemohon' => $this->request->getVar('alamat_pemohon'),
                'telp_pemohon' => $this->request->getVar('telp_pemohon'),
                'penghasilan' => $this->request->getVar('penghasilan'),
                'keperluan' => $this->request->getVar('keperluan'),
                'dokumen' => implode(',', $fileNames),
                'status_verif' => 'Menunggu',
            ]);

            session()->setFlashdata('success', 'Permohonan berhasil diajukan');

            return redirect()->to('/permohonan');
        }

        if (!$this->validate([
            'nik_pemohon' => [
                'rules' => 'required|max_length[16]|numeric',
                'errors' => [
                    'required' => 'NIK pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'nama_pemohon' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                'errors' => [
                    'required' => 'Nama pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'ttl_pemohon' => [
                'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z0-9.,"\-\'\s]+$/]',
                'errors' => [
                    'required' => 'Tempat tanggal lahir pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'jk_pemohon' => [
                'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z"\-\'\s]+$/]',
                'errors' => [
                    'required' => 'Jenis kelamin pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'status_pemohon' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                'errors' => [
                    'required' => 'Status pernikahan pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'kerja_pemohon' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Pekerjaan pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'alamat_pemohon' => [
                'rules' => 'required|max_length[200]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Alamat pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'telp_pemohon' => [
                'rules' => 'required|max_length[14]|numeric',
                'errors' => [
                    'required' => 'No. Telp pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'penghasilan' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Penghasilan pemohon harus diisi. '
                ]
            ],
            'keperluan' => [
                'rules' => 'required|max_length[300]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Keperluan harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. ',
                    'regex_match' => 'Terdapat karakter yang tidak valid'
                ]
            ],
            'dokumen' => [
                'rules' => 'uploaded[dokumen]|is_image[dokumen]|mime_in[dokumen,image/jpg,image/jpeg,image/png]|max_size[dokumen,1024]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to(base_url() . '/permohonan/form_2')->with('error', 'Data yang diinputkan tidak lengkap')->withInput();
        }

        $nik = $this->request->getVar('nik_pemohon');
        $nama = $this->request->getVar('nama_pemohon');
        $usernow = user()->username;

        //explode ttl
        $stringttl = $this->request->getVar('ttl_pemohon');
        $pecahan = explode(', ', $stringttl);
        $tempat = $pecahan[0];

        $valdat = $this->userModels->where('username', $nik)->asArray()->find();

        if (empty($valdat)) {
            return redirect()->to(base_url() . '/permohonan/form_2')->with('error', 'Data tidak ditemukan')->with('gagal', 'Data tidak ditemukan didatabase')->withInput();
        } else {
            if ($nik == $usernow && $nama == $valdat[0]['nama'] && $tempat == $valdat[0]['tempat']) {
                $fileNames = [];

                foreach ($files as $file) {
                    // Generate nama file yang unik
                    $fileName = $file->getRandomName();

                    // Pindahkan file ke folder yang ditentukan
                    $file->move(APPPATH . 'dokumen/uploads/', $fileName);

                    // Simpan nama file ke dalam array
                    $fileNames[] = $fileName;
                }

                $this->permohonanModels->save([
                    'id_surat' => '2',
                    'nik_pemohon' => $this->request->getVar('nik_pemohon'),
                    'nama_pemohon' => $this->request->getVar('nama_pemohon'),
                    'ttl_pemohon' => $this->request->getVar('ttl_pemohon'),
                    'jk_pemohon' => $this->request->getVar('jk_pemohon'),
                    'status_pemohon' => $this->request->getVar('status_pemohon'),
                    'kerja_pemohon' => $this->request->getVar('kerja_pemohon'),
                    'alamat_pemohon' => $this->request->getVar('alamat_pemohon'),
                    'telp_pemohon' => $this->request->getVar('telp_pemohon'),
                    'penghasilan' => $this->request->getVar('penghasilan'),
                    'keperluan' => $this->request->getVar('keperluan'),
                    'dokumen' => implode(',', $fileNames),
                    'status_verif' => 'Menunggu',
                ]);

                session()->setFlashdata('success', 'Permohonan berhasil diajukan');

                return redirect()->to('/permohonan');
            } else {
                return redirect()->to(base_url() . '/permohonan/form_2')->with('error', 'Data yang diinputkan tidak sesuai')->with('gagal', 'Data tidak ditemukan didatabase')->withInput();
            }
        }
    }

    public function tambah_form_3()
    {
        $files = $this->request->getFileMultiple('dokumen');

        if (in_groups('admin')) {
            if (!$this->validate([
                'search' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'NIK harus diisi. '
                    ]
                ],
                'nama_pemohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                    'errors' => [
                        'required' => 'Nama pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'ttl_pemohon' => [
                    'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z0-9.,"\-\'\s]+$/]',
                    'errors' => [
                        'required' => 'Tempat tanggal lahir pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'jk_pemohon' => [
                    'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z"\-\'\s]+$/]',
                    'errors' => [
                        'required' => 'Jenis kelamin pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'status_pemohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                    'errors' => [
                        'required' => 'Status pernikahan pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'kerja_pemohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Pekerjaan pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'telp_pemohon' => [
                    'rules' => 'required|max_length[14]|numeric',
                    'errors' => [
                        'required' => 'No. Telp pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'alamat_pemohon' => [
                    'rules' => 'required|max_length[200]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Alamat pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'searchdimohon' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'NIK dimohon harus diisi. '
                    ]
                ],
                'nama_dimohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                    'errors' => [
                        'required' => 'Nama dimohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'tempat_dimohon' => [
                    'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z0-9.,"\-\'\s]+$/]',
                    'errors' => [
                        'required' => 'Tempat lahir dimohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'tgllhr_dimohon' => [
                    'rules' => 'required|valid_date[Y-m-d]',
                    'errors' => [
                        'required' => 'Tanggal Lahir dimohon harus diisi. '
                    ]
                ],
                'jk_dimohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z0-9.,"\-\'\s]+$/]',
                    'errors' => [
                        'required' => 'Jenis Kelamin dimohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'alamat_dimohon' => [
                    'rules' => 'required|max_length[200]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Alamat dimohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'pendidikan' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Pendidikan dimohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'kelas' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Kelas/Semester dimohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'keperluan' => [
                    'rules' => 'required|max_length[300]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Keperluan harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. ',
                        'regex_match' => 'Terdapat karakter yang tidak valid'
                    ]
                ],
                'dokumen' => [
                    'rules' => 'uploaded[dokumen]|is_image[dokumen]|mime_in[dokumen,image/jpg,image/jpeg,image/png]|max_size[dokumen,1024]',
                    'errors' => [
                        'max_size' => 'Ukuran gambar terlalu besar',
                        'is_image' => 'Yang anda pilih bukan gambar',
                        'mime_in' => 'Yang anda pilih bukan gambar'
                    ]
                ]
            ])) {
                return redirect()->to(base_url() . '/permohonan/form_3')->with('error', 'Data yang diinputkan tidak lengkap')->withInput();
            }
            $nik = $this->request->getVar('search');
            $nama = $this->request->getVar('nama_pemohon');
            $ttl_dimohon = $this->request->getVar('tempat_dimohon') . ', ' . date('d-m-Y', strtotime($this->request->getVar('tgllhr_dimohon')));

            $fileNames = [];

            foreach ($files as $file) {
                // Generate nama file yang unik
                $fileName = $file->getRandomName();

                // Pindahkan file ke folder yang ditentukan
                $file->move(APPPATH . 'dokumen/uploads/', $fileName);

                // Simpan nama file ke dalam array
                $fileNames[] = $fileName;
            }

            $this->permohonanModels->save([
                'id_surat' => '3',
                'nik_pemohon' => $nik,
                'nama_pemohon' => $nama,
                'ttl_pemohon' => $this->request->getVar('ttl_pemohon'),
                'jk_pemohon' => $this->request->getVar('jk_pemohon'),
                'status_pemohon' => $this->request->getVar('status_pemohon'),
                'kerja_pemohon' => $this->request->getVar('kerja_pemohon'),
                'alamat_pemohon' => $this->request->getVar('alamat_pemohon'),
                'telp_pemohon' => $this->request->getVar('telp_pemohon'),
                'nik_dimohon' => $this->request->getVar('searchdimohon'),
                'nama_dimohon' => $this->request->getVar('nama_dimohon'),
                'ttl_dimohon' => $ttl_dimohon,
                'jk_dimohon' => $this->request->getVar('jk_dimohon'),
                'pendidikan' => $this->request->getVar('pendidikan'),
                'kelas' => $this->request->getVar('kelas'),
                'alamat_dimohon' => $this->request->getVar('alamat_dimohon'),
                'keperluan' => $this->request->getVar('keperluan'),
                'dokumen' => implode(',', $fileNames),
                'status_verif' => 'Menunggu',
            ]);

            session()->setFlashdata('success', 'Permohonan berhasil diajukan');

            return redirect()->to('/permohonan');
        }

        if (!$this->validate([
            'nik_pemohon' => [
                'rules' => 'required|max_length[16]|numeric',
                'errors' => [
                    'required' => 'NIK pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'nama_pemohon' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                'errors' => [
                    'required' => 'Nama pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'ttl_pemohon' => [
                'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z0-9.,"\-\'\s]+$/]',
                'errors' => [
                    'required' => 'Tempat tanggal lahir pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'jk_pemohon' => [
                'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z"\-\'\s]+$/]',
                'errors' => [
                    'required' => 'Jenis kelamin pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'status_pemohon' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                'errors' => [
                    'required' => 'Status pernikahan pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'kerja_pemohon' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Pekerjaan pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'alamat_pemohon' => [
                'rules' => 'required|max_length[200]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Alamat pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'telp_pemohon' => [
                'rules' => 'required|max_length[14]|numeric',
                'errors' => [
                    'required' => 'No. Telp pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'nik_dimohon' => [
                'rules' => 'required|max_length[16]|numeric',
                'errors' => [
                    'required' => 'NIK pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'nama_dimohon' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                'errors' => [
                    'required' => 'Nama dimohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'tempat_dimohon' => [
                'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z0-9.,"\-\'\s]+$/]',
                'errors' => [
                    'required' => 'Tempat lahir dimohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'tgllhr_dimohon' => [
                'rules' => 'required|valid_date[Y-m-d]',
                'errors' => [
                    'required' => 'Tanggal Lahir dimohon harus diisi. '
                ]
            ],
            'jk_dimohon' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z0-9.,"\-\'\s]+$/]',
                'errors' => [
                    'required' => 'Jenis Kelamin dimohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'alamat_dimohon' => [
                'rules' => 'required|max_length[200]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Alamat dimohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'pendidikan' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Pendidikan dimohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'kelas' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Kelas/Semester dimohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'keperluan' => [
                'rules' => 'required|max_length[300]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Keperluan harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. ',
                    'regex_match' => 'Terdapat karakter yang tidak valid'
                ]
            ],
            'dokumen' => [
                'rules' => 'uploaded[dokumen]|is_image[dokumen]|mime_in[dokumen,image/jpg,image/jpeg,image/png]|max_size[dokumen,1024]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to(base_url() . '/permohonan/form_3')->with('error', 'Data yang diinputkan tidak lengkap')->withInput();
        }

        $nik = $this->request->getVar('nik_pemohon');
        $nama = $this->request->getVar('nama_pemohon');
        $usernow = user()->username;

        //explode ttl
        $stringttl = $this->request->getVar('ttl_pemohon');
        $pecahan = explode(', ', $stringttl);
        $tempat = $pecahan[0];

        $ttl_dimohon = $this->request->getVar('tempat_dimohon') . ', ' . date('d-m-Y', strtotime($this->request->getVar('tgllhr_dimohon')));

        $valdat = $this->userModels->where('username', $nik)->asArray()->find();

        if (empty($valdat)) {
            return redirect()->to(base_url() . '/permohonan/form_3')->with('error', 'Data tidak ditemukan')->with('gagal', 'Data tidak ditemukan didatabase')->withInput();
        } else {
            if ($nik == $usernow && $nama == $valdat[0]['nama'] && $tempat == $valdat[0]['tempat']) {
                $fileNames = [];

                foreach ($files as $file) {
                    // Generate nama file yang unik
                    $fileName = $file->getRandomName();

                    // Pindahkan file ke folder yang ditentukan
                    $file->move(APPPATH . 'dokumen/uploads/', $fileName);

                    // Simpan nama file ke dalam array
                    $fileNames[] = $fileName;
                }

                $this->permohonanModels->save([
                    'id_surat' => '3',
                    'nik_pemohon' => $this->request->getVar('nik_pemohon'),
                    'nama_pemohon' => $this->request->getVar('nama_pemohon'),
                    'ttl_pemohon' => $this->request->getVar('ttl_pemohon'),
                    'jk_pemohon' => $this->request->getVar('jk_pemohon'),
                    'status_pemohon' => $this->request->getVar('status_pemohon'),
                    'kerja_pemohon' => $this->request->getVar('kerja_pemohon'),
                    'alamat_pemohon' => $this->request->getVar('alamat_pemohon'),
                    'telp_pemohon' => $this->request->getVar('telp_pemohon'),
                    'nik_dimohon' => $this->request->getVar('nik_dimohon'),
                    'nama_dimohon' => $this->request->getVar('nama_dimohon'),
                    'ttl_dimohon' => $ttl_dimohon,
                    'jk_dimohon' => $this->request->getVar('jk_dimohon'),
                    'pendidikan' => $this->request->getVar('pendidikan'),
                    'kelas' => $this->request->getVar('kelas'),
                    'alamat_dimohon' => $this->request->getVar('alamat_dimohon'),
                    'keperluan' => $this->request->getVar('keperluan'),
                    'dokumen' => implode(',', $fileNames),
                    'status_verif' => 'Menunggu',
                ]);

                session()->setFlashdata('success', 'Permohonan berhasil diajukan');

                return redirect()->to('/permohonan');
            } else {
                return redirect()->to(base_url() . '/permohonan/form_3')->with('error', 'Data yang diinputkan tidak sesuai')->with('gagal', 'Data tidak ditemukan didatabase')->withInput();
            }
        }
    }

    public function tambah_form_4()
    {
        $files = $this->request->getFileMultiple('dokumen');

        if (in_groups('admin')) {
            if (!$this->validate([
                'search' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'NIK harus diisi. '
                    ]
                ],
                'nama_pemohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                    'errors' => [
                        'required' => 'Nama pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'ttl_pemohon' => [
                    'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z0-9.,"\-\'\s]+$/]',
                    'errors' => [
                        'required' => 'Tempat tanggal lahir pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'jk_pemohon' => [
                    'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z"\-\'\s]+$/]',
                    'errors' => [
                        'required' => 'Jenis kelamin pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'status_pemohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                    'errors' => [
                        'required' => 'Status pernikahan pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'kerja_pemohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Pekerjaan pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'telp_pemohon' => [
                    'rules' => 'required|max_length[14]|numeric',
                    'errors' => [
                        'required' => 'No. Telp pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'alamat_pemohon' => [
                    'rules' => 'required|max_length[200]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Alamat pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'tglmulai' => [
                    'rules' => 'required|valid_date[d-m-Y]',
                    'errors' => [
                        'required' => 'Tanggal mulai harus diisi. '
                    ]
                ],
                'tglselesai' => [
                    'rules' => 'required|valid_date[d-m-Y]',
                    'errors' => [
                        'required' => 'Tanggal selesai harus diisi. '
                    ]
                ],
                'waktumulai' => [
                    'rules' => 'required|max_length[6]|regex_match[/^[a-zA-Z0-9.,?!():\"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Waktu mulai harus diisi. '
                    ]
                ],
                'waktuselesai' => [
                    'rules' => 'required|max_length[6]|regex_match[/^[a-zA-Z0-9.,?!():\"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Waktu selesai harus diisi. '
                    ]
                ],
                'keperluan' => [
                    'rules' => 'required|max_length[300]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Keperluan harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. ',
                        'regex_match' => 'Terdapat karakter yang tidak valid'
                    ]
                ],
                'dokumen' => [
                    'rules' => 'uploaded[dokumen]|is_image[dokumen]|mime_in[dokumen,image/jpg,image/jpeg,image/png]|max_size[dokumen,1024]',
                    'errors' => [
                        'max_size' => 'Ukuran gambar terlalu besar',
                        'is_image' => 'Yang anda pilih bukan gambar',
                        'mime_in' => 'Yang anda pilih bukan gambar'
                    ]
                ]
            ])) {
                return redirect()->to(base_url() . '/permohonan/form_4')->with('error', 'Data yang diinputkan tidak lengkap')->withInput();
            }
            $nik = $this->request->getVar('search');
            $nama = $this->request->getVar('nama_pemohon');

            $tglacara = $this->request->getVar('tglmulai') . ' - ' . $this->request->getVar('tglselesai');
            $waktuacara = $this->request->getVar('waktumulai') . ' WIB' . ' - ' . $this->request->getVar('waktuselesai') . ' WIB';

            $fileNames = [];

            foreach ($files as $file) {
                // Generate nama file yang unik
                $fileName = $file->getRandomName();

                // Pindahkan file ke folder yang ditentukan
                $file->move(APPPATH . 'dokumen/uploads/', $fileName);

                // Simpan nama file ke dalam array
                $fileNames[] = $fileName;
            }

            $this->permohonanModels->save([
                'id_surat' => '4',
                'nik_pemohon' => $nik,
                'nama_pemohon' => $nama,
                'ttl_pemohon' => $this->request->getVar('ttl_pemohon'),
                'jk_pemohon' => $this->request->getVar('jk_pemohon'),
                'status_pemohon' => $this->request->getVar('status_pemohon'),
                'kerja_pemohon' => $this->request->getVar('kerja_pemohon'),
                'alamat_pemohon' => $this->request->getVar('alamat_pemohon'),
                'telp_pemohon' => $this->request->getVar('telp_pemohon'),
                'tglacara' => $tglacara,
                'waktuacara' => $waktuacara,
                'keperluan' => $this->request->getVar('keperluan'),
                'dokumen' => implode(',', $fileNames),
                'status_verif' => 'Menunggu',
            ]);

            session()->setFlashdata('success', 'Permohonan berhasil diajukan');

            return redirect()->to('/permohonan');
        }

        if (!$this->validate([
            'nik_pemohon' => [
                'rules' => 'required|max_length[16]|numeric',
                'errors' => [
                    'required' => 'NIK pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'nama_pemohon' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                'errors' => [
                    'required' => 'Nama pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'ttl_pemohon' => [
                'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z0-9.,"\-\'\s]+$/]',
                'errors' => [
                    'required' => 'Tempat tanggal lahir pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'jk_pemohon' => [
                'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z"\-\'\s]+$/]',
                'errors' => [
                    'required' => 'Jenis kelamin pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'status_pemohon' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                'errors' => [
                    'required' => 'Status pernikahan pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'kerja_pemohon' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Pekerjaan pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'alamat_pemohon' => [
                'rules' => 'required|max_length[200]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Alamat pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'telp_pemohon' => [
                'rules' => 'required|max_length[14]|numeric',
                'errors' => [
                    'required' => 'No. Telp pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'tglmulai' => [
                'rules' => 'required|valid_date[d-m-Y]',
                'errors' => [
                    'required' => 'Tanggal mulai harus diisi. '
                ]
            ],
            'tglselesai' => [
                'rules' => 'required|valid_date[d-m-Y]',
                'errors' => [
                    'required' => 'Tanggal selesai harus diisi. '
                ]
            ],
            'waktumulai' => [
                'rules' => 'required|max_length[6]|regex_match[/^[a-zA-Z0-9.,?!():\"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Waktu mulai harus diisi. '
                ]
            ],
            'waktuselesai' => [
                'rules' => 'required|max_length[6]|regex_match[/^[a-zA-Z0-9.,?!():\"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Waktu selesai harus diisi. '
                ]
            ],
            'keperluan' => [
                'rules' => 'required|max_length[300]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Keperluan harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. ',
                    'regex_match' => 'Terdapat karakter yang tidak valid'
                ]
            ],
            'dokumen' => [
                'rules' => 'uploaded[dokumen]|is_image[dokumen]|mime_in[dokumen,image/jpg,image/jpeg,image/png]|max_size[dokumen,1024]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to(base_url() . '/permohonan/form_4')->with('error', 'Data yang diinputkan tidak lengkap')->withInput();
        }

        $nik = $this->request->getVar('nik_pemohon');
        $nama = $this->request->getVar('nama_pemohon');
        $usernow = user()->username;

        //explode ttl
        $stringttl = $this->request->getVar('ttl_pemohon');
        $pecahan = explode(', ', $stringttl);
        $tempat = $pecahan[0];

        $tglacara = $this->request->getVar('tglmulai') . ' - ' . $this->request->getVar('tglselesai');
        $waktuacara = $this->request->getVar('waktumulai') . ' WIB' . ' - ' . $this->request->getVar('waktuselesai') . ' WIB';

        $valdat = $this->userModels->where('username', $nik)->asArray()->find();

        if (empty($valdat)) {
            return redirect()->to(base_url() . '/permohonan/form_4')->with('error', 'Data tidak ditemukan')->with('gagal', 'Data tidak ditemukan didatabase')->withInput();
        } else {
            if ($nik == $usernow && $nama == $valdat[0]['nama'] && $tempat == $valdat[0]['tempat']) {
                $fileNames = [];

                foreach ($files as $file) {
                    // Generate nama file yang unik
                    $fileName = $file->getRandomName();

                    // Pindahkan file ke folder yang ditentukan
                    $file->move(APPPATH . 'dokumen/uploads/', $fileName);

                    // Simpan nama file ke dalam array
                    $fileNames[] = $fileName;
                }

                $this->permohonanModels->save([
                    'id_surat' => '4',
                    'nik_pemohon' => $this->request->getVar('nik_pemohon'),
                    'nama_pemohon' => $this->request->getVar('nama_pemohon'),
                    'ttl_pemohon' => $this->request->getVar('ttl_pemohon'),
                    'jk_pemohon' => $this->request->getVar('jk_pemohon'),
                    'status_pemohon' => $this->request->getVar('status_pemohon'),
                    'kerja_pemohon' => $this->request->getVar('kerja_pemohon'),
                    'alamat_pemohon' => $this->request->getVar('alamat_pemohon'),
                    'telp_pemohon' => $this->request->getVar('telp_pemohon'),
                    'tglacara' => $tglacara,
                    'waktuacara' => $waktuacara,
                    'keperluan' => $this->request->getVar('keperluan'),
                    'dokumen' => implode(',', $fileNames),
                    'status_verif' => 'Menunggu',
                ]);

                session()->setFlashdata('success', 'Permohonan berhasil diajukan');

                return redirect()->to('/permohonan');
            } else {
                return redirect()->to(base_url() . '/permohonan/form_4')->with('error', 'Data yang diinputkan tidak sesuai')->with('gagal', 'Data tidak ditemukan didatabase')->withInput();
            }
        }
    }

    public function tambah_form_5()
    {
        $files = $this->request->getFileMultiple('dokumen');

        if (in_groups('admin')) {
            if (!$this->validate([
                'search' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'NIK harus diisi. '
                    ]
                ],
                'nama_pemohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                    'errors' => [
                        'required' => 'Nama pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'ttl_pemohon' => [
                    'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z0-9.,"\-\'\s]+$/]',
                    'errors' => [
                        'required' => 'Tempat tanggal lahir pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'jk_pemohon' => [
                    'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z"\-\'\s]+$/]',
                    'errors' => [
                        'required' => 'Jenis kelamin pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'status_pemohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                    'errors' => [
                        'required' => 'Status pernikahan pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'kerja_pemohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Pekerjaan pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'telp_pemohon' => [
                    'rules' => 'required|max_length[14]|numeric',
                    'errors' => [
                        'required' => 'No. Telp pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'alamat_pemohon' => [
                    'rules' => 'required|max_length[200]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Alamat pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'nama_usaha' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Nama usaha harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'alamat_usaha' => [
                    'rules' => 'required|max_length[200]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Alamat usaha harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'keperluan' => [
                    'rules' => 'required|max_length[300]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Keperluan harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. ',
                        'regex_match' => 'Terdapat karakter yang tidak valid'
                    ]
                ],
                'dokumen' => [
                    'rules' => 'uploaded[dokumen]|is_image[dokumen]|mime_in[dokumen,image/jpg,image/jpeg,image/png]|max_size[dokumen,1024]',
                    'errors' => [
                        'max_size' => 'Ukuran gambar terlalu besar',
                        'is_image' => 'Yang anda pilih bukan gambar',
                        'mime_in' => 'Yang anda pilih bukan gambar'
                    ]
                ]
            ])) {
                return redirect()->to(base_url() . '/permohonan/form_5')->with('error', 'Data yang diinputkan tidak lengkap')->withInput();
            }
            $nik = $this->request->getVar('search');
            $nama = $this->request->getVar('nama_pemohon');

            $fileNames = [];

            foreach ($files as $file) {
                // Generate nama file yang unik
                $fileName = $file->getRandomName();

                // Pindahkan file ke folder yang ditentukan
                $file->move(APPPATH . 'dokumen/uploads/', $fileName);

                // Simpan nama file ke dalam array
                $fileNames[] = $fileName;
            }

            $this->permohonanModels->save([
                'id_surat' => '5',
                'nik_pemohon' => $nik,
                'nama_pemohon' => $nama,
                'ttl_pemohon' => $this->request->getVar('ttl_pemohon'),
                'jk_pemohon' => $this->request->getVar('jk_pemohon'),
                'status_pemohon' => $this->request->getVar('status_pemohon'),
                'kerja_pemohon' => $this->request->getVar('kerja_pemohon'),
                'alamat_pemohon' => $this->request->getVar('alamat_pemohon'),
                'telp_pemohon' => $this->request->getVar('telp_pemohon'),
                'nama_usaha' => $this->request->getVar('nama_usaha'),
                'alamat_usaha' => $this->request->getVar('alamat_usaha'),
                'keperluan' => $this->request->getVar('keperluan'),
                'dokumen' => implode(',', $fileNames),
                'status_verif' => 'Menunggu',
            ]);

            session()->setFlashdata('success', 'Permohonan berhasil diajukan');

            return redirect()->to('/permohonan');
        }

        if (!$this->validate([
            'nik_pemohon' => [
                'rules' => 'required|max_length[16]|numeric',
                'errors' => [
                    'required' => 'NIK pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'nama_pemohon' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                'errors' => [
                    'required' => 'Nama pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'ttl_pemohon' => [
                'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z0-9.,"\-\'\s]+$/]',
                'errors' => [
                    'required' => 'Tempat tanggal lahir pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'jk_pemohon' => [
                'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z"\-\'\s]+$/]',
                'errors' => [
                    'required' => 'Jenis kelamin pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'status_pemohon' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                'errors' => [
                    'required' => 'Status pernikahan pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'kerja_pemohon' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Pekerjaan pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'alamat_pemohon' => [
                'rules' => 'required|max_length[200]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Alamat pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'telp_pemohon' => [
                'rules' => 'required|max_length[14]|numeric',
                'errors' => [
                    'required' => 'No. Telp pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'nama_usaha' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Nama usaha harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'alamat_usaha' => [
                'rules' => 'required|max_length[200]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Alamat usaha harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'keperluan' => [
                'rules' => 'required|max_length[300]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Keperluan harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. ',
                    'regex_match' => 'Terdapat karakter yang tidak valid'
                ]
            ],
            'dokumen' => [
                'rules' => 'uploaded[dokumen]|is_image[dokumen]|mime_in[dokumen,image/jpg,image/jpeg,image/png]|max_size[dokumen,1024]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to(base_url() . '/permohonan/form_5')->with('error', 'Data yang diinputkan tidak lengkap')->withInput();
        }

        $nik = $this->request->getVar('nik_pemohon');
        $nama = $this->request->getVar('nama_pemohon');
        $usernow = user()->username;

        //explode ttl
        $stringttl = $this->request->getVar('ttl_pemohon');
        $pecahan = explode(', ', $stringttl);
        $tempat = $pecahan[0];

        $valdat = $this->userModels->where('username', $nik)->asArray()->find();

        if (empty($valdat)) {
            return redirect()->to(base_url() . '/permohonan/form_5')->with('error', 'Data tidak ditemukan')->with('gagal', 'Data tidak ditemukan didatabase')->withInput();
        } else {
            if ($nik == $usernow && $nama == $valdat[0]['nama'] && $tempat == $valdat[0]['tempat']) {
                $fileNames = [];

                foreach ($files as $file) {
                    // Generate nama file yang unik
                    $fileName = $file->getRandomName();

                    // Pindahkan file ke folder yang ditentukan
                    $file->move(APPPATH . 'dokumen/uploads/', $fileName);

                    // Simpan nama file ke dalam array
                    $fileNames[] = $fileName;
                }

                $this->permohonanModels->save([
                    'id_surat' => '5',
                    'nik_pemohon' => $this->request->getVar('nik_pemohon'),
                    'nama_pemohon' => $this->request->getVar('nama_pemohon'),
                    'ttl_pemohon' => $this->request->getVar('ttl_pemohon'),
                    'jk_pemohon' => $this->request->getVar('jk_pemohon'),
                    'status_pemohon' => $this->request->getVar('status_pemohon'),
                    'kerja_pemohon' => $this->request->getVar('kerja_pemohon'),
                    'alamat_pemohon' => $this->request->getVar('alamat_pemohon'),
                    'telp_pemohon' => $this->request->getVar('telp_pemohon'),
                    'nama_usaha' => $this->request->getVar('nama_usaha'),
                    'alamat_usaha' => $this->request->getVar('alamat_usaha'),
                    'keperluan' => $this->request->getVar('keperluan'),
                    'dokumen' => implode(',', $fileNames),
                    'status_verif' => 'Menunggu',
                ]);

                session()->setFlashdata('success', 'Permohonan berhasil diajukan');

                return redirect()->to('/permohonan');
            } else {
                return redirect()->to(base_url() . '/permohonan/form_5')->with('error', 'Data yang diinputkan tidak sesuai')->with('gagal', 'Data tidak ditemukan didatabase')->withInput();
            }
        }
    }

    public function tambah_form_6()
    {
        $files = $this->request->getFileMultiple('dokumen');

        if (in_groups('admin')) {
            if (!$this->validate([
                'search' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'NIK harus diisi. '
                    ]
                ],
                'nama_pemohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                    'errors' => [
                        'required' => 'Nama pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'ttl_pemohon' => [
                    'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z0-9.,"\-\'\s]+$/]',
                    'errors' => [
                        'required' => 'Tempat tanggal lahir pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'jk_pemohon' => [
                    'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z"\-\'\s]+$/]',
                    'errors' => [
                        'required' => 'Jenis kelamin pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'status_pemohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                    'errors' => [
                        'required' => 'Status pernikahan pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'kerja_pemohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Pekerjaan pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'telp_pemohon' => [
                    'rules' => 'required|max_length[14]|numeric',
                    'errors' => [
                        'required' => 'No. Telp pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'alamat_pemohon' => [
                    'rules' => 'required|max_length[200]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Alamat pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'keperluan' => [
                    'rules' => 'required|max_length[300]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Keperluan harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. ',
                        'regex_match' => 'Terdapat karakter yang tidak valid'
                    ]
                ],
                'dokumen' => [
                    'rules' => 'uploaded[dokumen]|is_image[dokumen]|mime_in[dokumen,image/jpg,image/jpeg,image/png]|max_size[dokumen,1024]',
                    'errors' => [
                        'max_size' => 'Ukuran gambar terlalu besar',
                        'is_image' => 'Yang anda pilih bukan gambar',
                        'mime_in' => 'Yang anda pilih bukan gambar'
                    ]
                ]
            ])) {
                return redirect()->to(base_url() . '/permohonan/form_6')->with('error', 'Data yang diinputkan tidak lengkap')->withInput();
            }
            $nik = $this->request->getVar('search');
            $nama = $this->request->getVar('nama_pemohon');

            $fileNames = [];

            foreach ($files as $file) {
                // Generate nama file yang unik
                $fileName = $file->getRandomName();

                // Pindahkan file ke folder yang ditentukan
                $file->move(APPPATH . 'dokumen/uploads/', $fileName);

                // Simpan nama file ke dalam array
                $fileNames[] = $fileName;
            }

            $this->permohonanModels->save([
                'id_surat' => '6',
                'nik_pemohon' => $nik,
                'nama_pemohon' => $nama,
                'ttl_pemohon' => $this->request->getVar('ttl_pemohon'),
                'jk_pemohon' => $this->request->getVar('jk_pemohon'),
                'status_pemohon' => $this->request->getVar('status_pemohon'),
                'kerja_pemohon' => $this->request->getVar('kerja_pemohon'),
                'alamat_pemohon' => $this->request->getVar('alamat_pemohon'),
                'telp_pemohon' => $this->request->getVar('telp_pemohon'),
                'keperluan' => $this->request->getVar('keperluan'),
                'dokumen' => implode(',', $fileNames),
                'status_verif' => 'Menunggu',
            ]);

            session()->setFlashdata('success', 'Permohonan berhasil diajukan');

            return redirect()->to('/permohonan');
        }

        if (!$this->validate([
            'nik_pemohon' => [
                'rules' => 'required|max_length[16]|numeric',
                'errors' => [
                    'required' => 'NIK pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'nama_pemohon' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                'errors' => [
                    'required' => 'Nama pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'ttl_pemohon' => [
                'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z0-9.,"\-\'\s]+$/]',
                'errors' => [
                    'required' => 'Tempat tanggal lahir pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'jk_pemohon' => [
                'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z"\-\'\s]+$/]',
                'errors' => [
                    'required' => 'Jenis kelamin pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'status_pemohon' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                'errors' => [
                    'required' => 'Status pernikahan pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'kerja_pemohon' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Pekerjaan pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'alamat_pemohon' => [
                'rules' => 'required|max_length[200]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Alamat pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'telp_pemohon' => [
                'rules' => 'required|max_length[14]|numeric',
                'errors' => [
                    'required' => 'No. Telp pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'keperluan' => [
                'rules' => 'required|max_length[300]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Keperluan harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. ',
                    'regex_match' => 'Terdapat karakter yang tidak valid'
                ]
            ],
            'dokumen' => [
                'rules' => 'uploaded[dokumen]|is_image[dokumen]|mime_in[dokumen,image/jpg,image/jpeg,image/png]|max_size[dokumen,1024]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to(base_url() . '/permohonan/form_6')->with('error', 'Data yang diinputkan tidak lengkap')->withInput();
        }

        $nik = $this->request->getVar('nik_pemohon');
        $nama = $this->request->getVar('nama_pemohon');
        $usernow = user()->username;

        //explode ttl
        $stringttl = $this->request->getVar('ttl_pemohon');
        $pecahan = explode(', ', $stringttl);
        $tempat = $pecahan[0];

        $valdat = $this->userModels->where('username', $nik)->asArray()->find();

        if (empty($valdat)) {
            return redirect()->to(base_url() . '/permohonan/form_6')->with('error', 'Data tidak ditemukan')->with('gagal', 'Data tidak ditemukan didatabase')->withInput();
        } else {
            if ($nik == $usernow && $nama == $valdat[0]['nama'] && $tempat == $valdat[0]['tempat']) {
                $fileNames = [];

                foreach ($files as $file) {
                    // Generate nama file yang unik
                    $fileName = $file->getRandomName();

                    // Pindahkan file ke folder yang ditentukan
                    $file->move(APPPATH . 'dokumen/uploads/', $fileName);

                    // Simpan nama file ke dalam array
                    $fileNames[] = $fileName;
                }

                $this->permohonanModels->save([
                    'id_surat' => '6',
                    'nik_pemohon' => $this->request->getVar('nik_pemohon'),
                    'nama_pemohon' => $this->request->getVar('nama_pemohon'),
                    'ttl_pemohon' => $this->request->getVar('ttl_pemohon'),
                    'jk_pemohon' => $this->request->getVar('jk_pemohon'),
                    'status_pemohon' => $this->request->getVar('status_pemohon'),
                    'kerja_pemohon' => $this->request->getVar('kerja_pemohon'),
                    'alamat_pemohon' => $this->request->getVar('alamat_pemohon'),
                    'telp_pemohon' => $this->request->getVar('telp_pemohon'),
                    'keperluan' => $this->request->getVar('keperluan'),
                    'dokumen' => implode(',', $fileNames),
                    'status_verif' => 'Menunggu',
                ]);

                session()->setFlashdata('success', 'Permohonan berhasil diajukan');

                return redirect()->to('/permohonan');
            } else {
                return redirect()->to(base_url() . '/permohonan/form_6')->with('error', 'Data yang diinputkan tidak sesuai')->with('gagal', 'Data tidak ditemukan didatabase')->withInput();
            }
        }
    }

    public function tambah_form_7()
    {
        $files = $this->request->getFileMultiple('dokumen');

        if (in_groups('admin')) {
            if (!$this->validate([
                'search' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'NIK harus diisi. '
                    ]
                ],
                'nama_pemohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                    'errors' => [
                        'required' => 'Nama pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'ttl_pemohon' => [
                    'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z0-9.,"\-\'\s]+$/]',
                    'errors' => [
                        'required' => 'Tempat tanggal lahir pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'jk_pemohon' => [
                    'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z"\-\'\s]+$/]',
                    'errors' => [
                        'required' => 'Jenis kelamin pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'status_pemohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                    'errors' => [
                        'required' => 'Status pernikahan pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'kerja_pemohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Pekerjaan pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'telp_pemohon' => [
                    'rules' => 'required|max_length[14]|numeric',
                    'errors' => [
                        'required' => 'No. Telp pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'alamat_pemohon' => [
                    'rules' => 'required|max_length[200]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Alamat pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'domisili' => [
                    'rules' => 'required|max_length[200]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Alamat domisili harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'keperluan' => [
                    'rules' => 'required|max_length[300]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Keperluan harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. ',
                        'regex_match' => 'Terdapat karakter yang tidak valid'
                    ]
                ],
                'dokumen' => [
                    'rules' => 'uploaded[dokumen]|is_image[dokumen]|mime_in[dokumen,image/jpg,image/jpeg,image/png]|max_size[dokumen,1024]',
                    'errors' => [
                        'max_size' => 'Ukuran gambar terlalu besar',
                        'is_image' => 'Yang anda pilih bukan gambar',
                        'mime_in' => 'Yang anda pilih bukan gambar'
                    ]
                ]
            ])) {
                return redirect()->to(base_url() . '/permohonan/form_7')->with('error', 'Data yang diinputkan tidak lengkap')->withInput();
            }
            $nik = $this->request->getVar('search');
            $nama = $this->request->getVar('nama_pemohon');

            $fileNames = [];

            foreach ($files as $file) {
                // Generate nama file yang unik
                $fileName = $file->getRandomName();

                // Pindahkan file ke folder yang ditentukan
                $file->move(APPPATH . 'dokumen/uploads/', $fileName);

                // Simpan nama file ke dalam array
                $fileNames[] = $fileName;
            }

            $this->permohonanModels->save([
                'id_surat' => '7',
                'nik_pemohon' => $nik,
                'nama_pemohon' => $nama,
                'ttl_pemohon' => $this->request->getVar('ttl_pemohon'),
                'jk_pemohon' => $this->request->getVar('jk_pemohon'),
                'status_pemohon' => $this->request->getVar('status_pemohon'),
                'kerja_pemohon' => $this->request->getVar('kerja_pemohon'),
                'alamat_pemohon' => $this->request->getVar('alamat_pemohon'),
                'telp_pemohon' => $this->request->getVar('telp_pemohon'),
                'domisili' => $this->request->getVar('domisili'),
                'keperluan' => $this->request->getVar('keperluan'),
                'dokumen' => implode(',', $fileNames),
                'status_verif' => 'Menunggu',
            ]);

            session()->setFlashdata('success', 'Permohonan berhasil diajukan');

            return redirect()->to('/permohonan');
        }

        if (!$this->validate([
            'nik_pemohon' => [
                'rules' => 'required|max_length[16]|numeric',
                'errors' => [
                    'required' => 'NIK pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'nama_pemohon' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                'errors' => [
                    'required' => 'Nama pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'ttl_pemohon' => [
                'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z0-9.,"\-\'\s]+$/]',
                'errors' => [
                    'required' => 'Tempat tanggal lahir pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'jk_pemohon' => [
                'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z"\-\'\s]+$/]',
                'errors' => [
                    'required' => 'Jenis kelamin pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'status_pemohon' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                'errors' => [
                    'required' => 'Status pernikahan pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'kerja_pemohon' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Pekerjaan pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'alamat_pemohon' => [
                'rules' => 'required|max_length[200]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Alamat pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'telp_pemohon' => [
                'rules' => 'required|max_length[14]|numeric',
                'errors' => [
                    'required' => 'No. Telp pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'domisili' => [
                'rules' => 'required|max_length[200]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Alamat domisili harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'keperluan' => [
                'rules' => 'required|max_length[300]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Keperluan harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. ',
                    'regex_match' => 'Terdapat karakter yang tidak valid'
                ]
            ],
            'dokumen' => [
                'rules' => 'uploaded[dokumen]|is_image[dokumen]|mime_in[dokumen,image/jpg,image/jpeg,image/png]|max_size[dokumen,1024]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to(base_url() . '/permohonan/form_7')->with('error', 'Data yang diinputkan tidak lengkap')->withInput();
        }

        $nik = $this->request->getVar('nik_pemohon');
        $nama = $this->request->getVar('nama_pemohon');
        $usernow = user()->username;

        //explode ttl
        $stringttl = $this->request->getVar('ttl_pemohon');
        $pecahan = explode(', ', $stringttl);
        $tempat = $pecahan[0];

        $valdat = $this->userModels->where('username', $nik)->asArray()->find();

        if (empty($valdat)) {
            return redirect()->to(base_url() . '/permohonan/form_7')->with('error', 'Data tidak ditemukan')->with('gagal', 'Data tidak ditemukan didatabase')->withInput();
        } else {
            if ($nik == $usernow && $nama == $valdat[0]['nama'] && $tempat == $valdat[0]['tempat']) {
                $fileNames = [];

                foreach ($files as $file) {
                    // Generate nama file yang unik
                    $fileName = $file->getRandomName();

                    // Pindahkan file ke folder yang ditentukan
                    $file->move(APPPATH . 'dokumen/uploads/', $fileName);

                    // Simpan nama file ke dalam array
                    $fileNames[] = $fileName;
                }

                $this->permohonanModels->save([
                    'id_surat' => '7',
                    'nik_pemohon' => $this->request->getVar('nik_pemohon'),
                    'nama_pemohon' => $this->request->getVar('nama_pemohon'),
                    'ttl_pemohon' => $this->request->getVar('ttl_pemohon'),
                    'jk_pemohon' => $this->request->getVar('jk_pemohon'),
                    'status_pemohon' => $this->request->getVar('status_pemohon'),
                    'kerja_pemohon' => $this->request->getVar('kerja_pemohon'),
                    'alamat_pemohon' => $this->request->getVar('alamat_pemohon'),
                    'telp_pemohon' => $this->request->getVar('telp_pemohon'),
                    'domisili' => $this->request->getVar('domisili'),
                    'keperluan' => $this->request->getVar('keperluan'),
                    'dokumen' => implode(',', $fileNames),
                    'status_verif' => 'Menunggu',
                ]);

                session()->setFlashdata('success', 'Permohonan berhasil diajukan');

                return redirect()->to('/permohonan');
            } else {
                return redirect()->to(base_url() . '/permohonan/form_7')->with('error', 'Data yang diinputkan tidak sesuai')->with('gagal', 'Data tidak ditemukan didatabase')->withInput();
            }
        }
    }

    public function tambah_form_8()
    {
        $files = $this->request->getFileMultiple('dokumen');

        if (in_groups('admin')) {
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
                'nama_surat_lain' => [
                    'rules' => 'required|max_length[200]|regex_match[/^[a-zA-Z0-9.,"\-\'\s]+$/]',
                    'errors' => [
                        'required' => 'Nama surat harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'search' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'NIK harus diisi. '
                    ]
                ],
                'nama_pemohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                    'errors' => [
                        'required' => 'Nama pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'ttl_pemohon' => [
                    'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z0-9.,"\-\'\s]+$/]',
                    'errors' => [
                        'required' => 'Tempat tanggal lahir pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'jk_pemohon' => [
                    'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z"\-\'\s]+$/]',
                    'errors' => [
                        'required' => 'Jenis kelamin pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'status_pemohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                    'errors' => [
                        'required' => 'Status pernikahan pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'kerja_pemohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Pekerjaan pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'telp_pemohon' => [
                    'rules' => 'required|max_length[14]|numeric',
                    'errors' => [
                        'required' => 'No. Telp pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'alamat_pemohon' => [
                    'rules' => 'required|max_length[200]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Alamat pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'keperluan' => [
                    'rules' => 'required|max_length[300]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Keperluan harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. ',
                        'regex_match' => 'Terdapat karakter yang tidak valid'
                    ]
                ],
                'dokumen' => [
                    'rules' => 'uploaded[dokumen]|is_image[dokumen]|mime_in[dokumen,image/jpg,image/jpeg,image/png]|max_size[dokumen,1024]',
                    'errors' => [
                        'max_size' => 'Ukuran gambar terlalu besar',
                        'is_image' => 'Yang anda pilih bukan gambar',
                        'mime_in' => 'Yang anda pilih bukan gambar'
                    ]
                ]
            ])) {
                return redirect()->to(base_url() . '/permohonan/form_6')->with('error', 'Data yang diinputkan tidak lengkap')->withInput();
            }
            $nik = $this->request->getVar('search');
            $nama = $this->request->getVar('nama_pemohon');

            $fileNames = [];

            foreach ($files as $file) {
                // Generate nama file yang unik
                $fileName = $file->getRandomName();

                // Pindahkan file ke folder yang ditentukan
                $file->move(APPPATH . 'dokumen/uploads/', $fileName);

                // Simpan nama file ke dalam array
                $fileNames[] = $fileName;
            }

            $this->permohonanModels->save([
                'id_surat' => '8',
                'no_srt' => $this->request->getVar('no_srt'),
                'no_instansi' => $this->request->getVar('no_instansi'),
                'no_ref' => $this->request->getVar('no_ref'),
                'tahun_srt' => $this->request->getVar('tahun_srt'),
                'nama_surat_lain' => $this->request->getVar('nama_surat_lain'),
                'nik_pemohon' => $nik,
                'nama_pemohon' => $nama,
                'ttl_pemohon' => $this->request->getVar('ttl_pemohon'),
                'jk_pemohon' => $this->request->getVar('jk_pemohon'),
                'status_pemohon' => $this->request->getVar('status_pemohon'),
                'kerja_pemohon' => $this->request->getVar('kerja_pemohon'),
                'alamat_pemohon' => $this->request->getVar('alamat_pemohon'),
                'telp_pemohon' => $this->request->getVar('telp_pemohon'),
                'keperluan' => $this->request->getVar('keperluan'),
                'dokumen' => implode(',', $fileNames),
                'status_verif' => 'Disetujui',
                'tgl_verif' => date('Y-m-d')
            ]);

            session()->setFlashdata('success', 'Permohonan berhasil diajukan');

            return redirect()->to('/permohonan');
        }
    }

    public function tambah_form_9()
    {
        $files = $this->request->getFileMultiple('dokumen');

        if (in_groups('admin')) {
            if (!$this->validate([
                'search' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'NIK harus diisi. '
                    ]
                ],
                'nama_pemohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                    'errors' => [
                        'required' => 'Nama pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'ttl_pemohon' => [
                    'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z0-9.,"\-\'\s]+$/]',
                    'errors' => [
                        'required' => 'Tempat tanggal lahir pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'jk_pemohon' => [
                    'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z"\-\'\s]+$/]',
                    'errors' => [
                        'required' => 'Jenis kelamin pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'status_pemohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                    'errors' => [
                        'required' => 'Status pernikahan pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'kerja_pemohon' => [
                    'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Pekerjaan pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'telp_pemohon' => [
                    'rules' => 'required|max_length[14]|numeric',
                    'errors' => [
                        'required' => 'No. Telp pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'alamat_pemohon' => [
                    'rules' => 'required|max_length[200]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Alamat pemohon harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. '
                    ]
                ],
                'keperluan' => [
                    'rules' => 'required|max_length[300]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                    'errors' => [
                        'required' => 'Keperluan harus diisi. ',
                        'max_length' => 'Inputan terlalu panjang. ',
                        'regex_match' => 'Terdapat karakter yang tidak valid'
                    ]
                ],
                'dokumen' => [
                    'rules' => 'uploaded[dokumen]|is_image[dokumen]|mime_in[dokumen,image/jpg,image/jpeg,image/png]|max_size[dokumen,1024]',
                    'errors' => [
                        'max_size' => 'Ukuran gambar terlalu besar',
                        'is_image' => 'Yang anda pilih bukan gambar',
                        'mime_in' => 'Yang anda pilih bukan gambar'
                    ]
                ]
            ])) {
                return redirect()->to(base_url() . '/permohonan/form_9')->with('error', 'Data yang diinputkan tidak lengkap')->withInput();
            }
            $nik = $this->request->getVar('search');
            $nama = $this->request->getVar('nama_pemohon');

            $fileNames = [];

            foreach ($files as $file) {
                // Generate nama file yang unik
                $fileName = $file->getRandomName();

                // Pindahkan file ke folder yang ditentukan
                $file->move(APPPATH . 'dokumen/uploads/', $fileName);

                // Simpan nama file ke dalam array
                $fileNames[] = $fileName;
            }

            $this->permohonanModels->save([
                'id_surat' => '9',
                'nik_pemohon' => $nik,
                'nama_pemohon' => $nama,
                'ttl_pemohon' => $this->request->getVar('ttl_pemohon'),
                'jk_pemohon' => $this->request->getVar('jk_pemohon'),
                'status_pemohon' => $this->request->getVar('status_pemohon'),
                'kerja_pemohon' => $this->request->getVar('kerja_pemohon'),
                'alamat_pemohon' => $this->request->getVar('alamat_pemohon'),
                'telp_pemohon' => $this->request->getVar('telp_pemohon'),
                'keperluan' => $this->request->getVar('keperluan'),
                'dokumen' => implode(',', $fileNames),
                'status_verif' => 'Menunggu',
            ]);

            session()->setFlashdata('success', 'Permohonan berhasil diajukan');

            return redirect()->to('/permohonan');
        }

        if (!$this->validate([
            'nik_pemohon' => [
                'rules' => 'required|max_length[16]|numeric',
                'errors' => [
                    'required' => 'NIK pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'nama_pemohon' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                'errors' => [
                    'required' => 'Nama pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'ttl_pemohon' => [
                'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z0-9.,"\-\'\s]+$/]',
                'errors' => [
                    'required' => 'Tempat tanggal lahir pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'jk_pemohon' => [
                'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z"\-\'\s]+$/]',
                'errors' => [
                    'required' => 'Jenis kelamin pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'status_pemohon' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                'errors' => [
                    'required' => 'Status pernikahan pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'kerja_pemohon' => [
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Pekerjaan pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'alamat_pemohon' => [
                'rules' => 'required|max_length[200]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Alamat pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'telp_pemohon' => [
                'rules' => 'required|max_length[14]|numeric',
                'errors' => [
                    'required' => 'No. Telp pemohon harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. '
                ]
            ],
            'keperluan' => [
                'rules' => 'required|max_length[300]|regex_match[/^[a-zA-Z0-9.,?!()"\-\'\s\/]+$/]',
                'errors' => [
                    'required' => 'Keperluan harus diisi. ',
                    'max_length' => 'Inputan terlalu panjang. ',
                    'regex_match' => 'Terdapat karakter yang tidak valid'
                ]
            ],
            'dokumen' => [
                'rules' => 'uploaded[dokumen]|is_image[dokumen]|mime_in[dokumen,image/jpg,image/jpeg,image/png]|max_size[dokumen,1024]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to(base_url() . '/permohonan/form_9')->with('error', 'Data yang diinputkan tidak lengkap')->withInput();
        }

        $nik = $this->request->getVar('nik_pemohon');
        $nama = $this->request->getVar('nama_pemohon');
        $usernow = user()->username;

        //explode ttl
        $stringttl = $this->request->getVar('ttl_pemohon');
        $pecahan = explode(', ', $stringttl);
        $tempat = $pecahan[0];

        $valdat = $this->userModels->where('username', $nik)->asArray()->find();

        if (empty($valdat)) {
            return redirect()->to(base_url() . '/permohonan/form_9')->with('error', 'Data tidak ditemukan')->with('gagal', 'Data tidak ditemukan didatabase')->withInput();
        } else {
            if ($nik == $usernow && $nama == $valdat[0]['nama'] && $tempat == $valdat[0]['tempat']) {
                $fileNames = [];

                foreach ($files as $file) {
                    // Generate nama file yang unik
                    $fileName = $file->getRandomName();

                    // Pindahkan file ke folder yang ditentukan
                    $file->move(APPPATH . 'dokumen/uploads/', $fileName);

                    // Simpan nama file ke dalam array
                    $fileNames[] = $fileName;
                }

                $this->permohonanModels->save([
                    'id_surat' => '9',
                    'nik_pemohon' => $this->request->getVar('nik_pemohon'),
                    'nama_pemohon' => $this->request->getVar('nama_pemohon'),
                    'ttl_pemohon' => $this->request->getVar('ttl_pemohon'),
                    'jk_pemohon' => $this->request->getVar('jk_pemohon'),
                    'status_pemohon' => $this->request->getVar('status_pemohon'),
                    'kerja_pemohon' => $this->request->getVar('kerja_pemohon'),
                    'alamat_pemohon' => $this->request->getVar('alamat_pemohon'),
                    'telp_pemohon' => $this->request->getVar('telp_pemohon'),
                    'keperluan' => $this->request->getVar('keperluan'),
                    'dokumen' => implode(',', $fileNames),
                    'status_verif' => 'Menunggu',
                ]);

                session()->setFlashdata('success', 'Permohonan berhasil diajukan');

                return redirect()->to('/permohonan');
            } else {
                return redirect()->to(base_url() . '/permohonan/form_9')->with('error', 'Data yang diinputkan tidak sesuai')->with('gagal', 'Data tidak ditemukan didatabase')->withInput();
            }
        }
    }
}
