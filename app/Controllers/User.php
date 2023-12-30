<?php

namespace App\Controllers;

use App\Models\Groupmodels;
use App\Models\Usermodels;
use Myth\Auth\Password;

class User extends BaseController
{
    protected $userModels;
    protected $groupModels;
    protected $hashmyth;
    protected $kirimPesan;
    public function __construct()
    {
        $this->userModels = new Usermodels();
        $this->groupModels = new Groupmodels();
        $this->hashmyth = new Password();
        $this->kirimPesan = new KirimPesan();
    }
    public function user()
    {
        $daftaruser = $this->userModels->get_users();
        $data = [
            'title' => 'Data User | SIPS Kemlokolegi',
            'users' => $daftaruser
        ];
        return view('user/data_user', $data);
    }

    public function detail($id)
    {
        $detail = $this->userModels->get_users($id);

        $data = [
            'title' => 'Detail | SIPS Kemlokolegi',
            'users' => $detail
        ];

        if (empty($data['users'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User ' . $id . ' tidak ditemukan');
        }

        return view('user/detail_user', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah User | SIPS Kemlokolegi',
            'validation' => validation_errors(),
            'optjk' => [
                'L' => 'Laki-laki',
                'P' => 'Perempuan'
            ],
            'optagama' => [
                'Islam' => 'Islam',
                'Kristen' => 'Kristen',
                'Katolik' => 'Katolik',
                'Budha' => 'Budha',
                'Hindu' => 'Hindu',
                'Konghuchu' => 'Konghuchu'
            ],
            'optkawin' => [
                'Kawin' => 'Kawin',
                'Belum Kawin' => 'Belum Kawin',
                'Cerai Hidup' => 'Cerai Hidup',
                'Cerai Mati' => 'Cerai Mati'
            ],
            'optkerja' => [
                'Wiraswasta' => 'Wiraswasta',
                'Pegawai Negeri Sipil' => 'Pegawai Negeri Sipil',
                'Guru' => 'Guru',
                'Tentara Nasional Indonesia' => 'Tentara Nasional Indonesia',
                'Belum/Tidak Bekerja' => 'Belum/Tidak Bekerja',
                'Pelajar/Mahasiswa' => 'Pelajar/Mahasiswa',
                'other' => 'Lainnya'
            ]
        ];

        return view('user/tambah_user', $data);
    }

    public function hapus($id)
    {
        $this->userModels->delete($id);
        session()->setFlashdata('pesan', 'Data user berhasil dihapus');
        return redirect()->to('/user');
    }

    public function save()
    {
        if (!$this->validate([
            'nik' => [
                'rules' => 'required|is_unique[users.username]|min_length[16]',
                'errors' => [
                    'required' => 'NIK harus diisi. ',
                    'is_unique' => 'NIK sudah terdaftar. ',
                    'min_length' => 'NIK harus terdiri dari 16 angka. '
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi. '
                ]
            ],
            'tempat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tempat lahir harus diisi. '
                ]
            ],
            'tgllhr' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal lahir harus diisi. '
                ]
            ],
            'jk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih jenis kelamin. '
                ]
            ],
            'dusun' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Dusun harus diisi. '
                ]
            ],
            'rt' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'RT harus diisi. '
                ]
            ],
            'rw' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'RW harus diisi. '
                ]
            ],
            'telp' => [
                'rules' => 'required|min_length[11]',
                'errors' => [
                    'required' => 'Nomor telepon harus diisi. '
                ]
            ],
            'agama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Agama harus diisi. '
                ]
            ],
            'kawin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status perkawinan harus diisi. '
                ]
            ],
            'kerja' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pekerjaan harus diisi. '
                ]
            ],
            'email' => [
                'rules' => 'permit_empty|valid_email|is_unique[users.email]',
                'errors' => [
                    'is_unique' => 'Email sudah terdaftar. '
                ]
            ],
            'password' => [
                'rules' => 'required|strong_password|min_length[8]',
                'errors' => [
                    'required' => 'Password harus diisi. ',
                    'strong_password' => 'Password terlalu lemah, gunakan kombinasi huruf besar, kecil, dan angka. ',
                    'min_length' => 'Password harus terdiri atas 8 karakter atau lebih. '
                ]
            ],
            'password2' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi password harus diisi. ',
                    'matches' => 'Password dan konfirmasi password tidak sama'
                ]
            ],
        ])) {
            return redirect()->to(base_url() . '/user/create')->withInput();
        }

        // dd($this->request->getPost());
        $alamat = "Dsn. " . ucfirst($this->request->getVar('dusun')) . ", RT " . $this->request->getVar('rt') . "/RW " . $this->request->getVar('rw') . ", Ds. Kemlokolegi, Kec. Baron, Kab. Nganjuk";
        $telp = "62" . $this->request->getVar('telp');
        $password = $this->request->getVar('password');
        $hashedPassword = $this->hashmyth->hash($password);

        if ($this->request->getVar('kerja') == 'other') {
            $kerja = $this->request->getVar('kerjalainnya');
        } else {
            $kerja = $this->request->getVar('kerja');
        }

        $this->userModels->save([
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('nik'),
            'nama' => ucwords($this->request->getVar('nama')),
            'tempat' => ucwords($this->request->getVar('tempat')),
            'tgllhr' => $this->request->getVar('tgllhr'),
            'jk' => $this->request->getVar('jk'),
            'alamat' => $alamat,
            'telp' => $telp,
            'agama' => $this->request->getVar('agama'),
            'kawin' => $this->request->getVar('kawin'),
            'pekerjaan' => $kerja,
            'password_hash' => $hashedPassword,
            'active' => 1,
        ]);

        $iduser = $this->userModels->getInsertID();

        $this->kirimPesan->send_addUser($telp, ucwords($this->request->getVar('nama')), $this->request->getVar('nik'), $password);

        $this->groupModels->save([
            'group_id' => '2',
            'user_id' => $iduser,
        ]);

        session()->setFlashdata('pesan', 'Data user berhasil ditambahkan');

        return redirect()->to('/user');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit User | SIPS Kemlokolegi',
            'validation' => validation_errors(),
            'users' => $this->userModels->get_users($id),
            'optjk' => [
                'L' => 'Laki-laki',
                'P' => 'Perempuan'
            ],
            'optagama' => [
                'Islam' => 'Islam',
                'Kristen' => 'Kristen',
                'Katolik' => 'Katolik',
                'Budha' => 'Budha',
                'Hindu' => 'Hindu',
                'Konghuchu' => 'Konghuchu'
            ],
            'optkawin' => [
                'Kawin' => 'Kawin',
                'Belum Kawin' => 'Belum Kawin',
                'Cerai Hidup' => 'Cerai Hidup',
                'Cerai Mati' => 'Cerai Mati'
            ]
        ];
        return view('user/edit_user', $data);
    }

    public function update($id)
    {
        if ($this->request->getVar('password') == '') {
            $rule_pw = 'permit_empty';
            $rule_confpw = 'permit_empty';
        } else {
            $rule_pw = 'required|strong_password|min_length[8]';
            $rule_confpw = 'required|matches[password]';
        }

        $niklama = $this->request->getVar('niklama');
        $emaillama = $this->request->getVar('emaillama');

        if ($this->request->getVar('nik') == $niklama) {
            $rule_nik = 'required';
        } else {
            $rule_nik = 'required|is_unique[users.username]|min_length[16]';
        }

        if ($this->request->getVar('email') == $emaillama) {
            $rule_email = 'permit_empty|valid_email';
        } else {
            $rule_email = 'permit_empty|valid_email|is_unique[users.email]';
        }

        if (!$this->validate([
            'nik' => [
                'rules' => $rule_nik,
                'errors' => [
                    'required' => 'NIK harus diisi. ',
                    'is_unique' => 'NIK sudah terdaftar. ',
                    'min_length' => 'NIK harus terdiri dari 16 angka. '
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi. '
                ]
            ],
            'tempat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tempat lahir harus diisi. '
                ]
            ],
            'tgllhr' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal lahir harus diisi. '
                ]
            ],
            'jk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih jenis kelamin. '
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Dusun harus diisi. '
                ]
            ],
            'telp' => [
                'rules' => 'required|min_length[11]',
                'errors' => [
                    'required' => 'Nomor telepon harus diisi. '
                ]
            ],
            'agama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Agama harus diisi. '
                ]
            ],
            'kawin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status perkawinan harus diisi. '
                ]
            ],
            'kerja' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pekerjaan harus diisi. '
                ]
            ],
            'email' => [
                'rules' => $rule_email,
                'errors' => [
                    'is_unique' => 'Email sudah terdaftar. '
                ]
            ],
            'password' => [
                'rules' => $rule_pw,
                'errors' => [
                    'required' => 'Password harus diisi. ',
                    'strong_password' => 'Password terlalu lemah, gunakan kombinasi huruf besar, kecil, dan angka. ',
                    'min_length' => 'Password harus terdiri atas 8 karakter atau lebih. '
                ]
            ],
            'password2' => [
                'rules' => $rule_confpw,
                'errors' => [
                    'required' => 'Konfirmasi password harus diisi. ',
                    'matches' => 'Password dan konfirmasi password tidak sama'
                ]
            ],
        ])) {
            return redirect()->to(base_url() . '/user/edit/' . $id)->withInput();
        }

        $telp = "62" . $this->request->getVar('telp');
        $password = $this->request->getVar('password');

        if ($password == '') {
            $hashedPassword = $this->request->getVar('password_hash');
        } else {
            $hashedPassword = $this->hashmyth->hash($password);
        }

        $this->userModels->save([
            'id' => $id,
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('nik'),
            'nama' => ucwords($this->request->getVar('nama')),
            'tempat' => ucwords($this->request->getVar('tempat')),
            'tgllhr' => $this->request->getVar('tgllhr'),
            'jk' => $this->request->getVar('jk'),
            'alamat' => $this->request->getVar('alamat'),
            'telp' => $telp,
            'agama' => $this->request->getVar('agama'),
            'kawin' => $this->request->getVar('kawin'),
            'pekerjaan' => $this->request->getVar('kerja'),
            'password_hash' => $hashedPassword,
        ]);

        session()->setFlashdata('pesan', 'Data user berhasil diubah');

        return redirect()->to('/user');
    }
}
