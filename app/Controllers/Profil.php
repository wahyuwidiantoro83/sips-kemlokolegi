<?php

namespace App\Controllers;

use App\Models\Usermodels;
use CodeIgniter\Validation\Validation;

class Profil extends BaseController
{
    protected $verifyMyth;
    protected $userModels;
    public function __construct()
    {
        $this->verifyMyth = new \Myth\Auth\Password();
        $this->userModels = new Usermodels();
    }
    public function index()
    {
        $data = [
            'title' => 'Profil | SIPS Kemlokolegi',
            'validation' => validation_errors()
        ];

        return view('profile/my_profile', $data);
    }
    public function ubah_password()
    {
        if (!$this->validate([
            'password_baru' => [
                'rules' => 'required|strong_password|min_length[8]',
                'errors' => [
                    'required' => 'Password harus diisi. ',
                    'strong_password' => 'Password terlalu lemah, gunakan kombinasi huruf besar, kecil, dan angka. ',
                    'min_length' => 'Password harus terdiri atas 8 karakter atau lebih. '
                ]
            ],
            'konfirmasi' => [
                'rules' => 'required|matches[password_baru]',
                'errors' => [
                    'required' => 'Konfirmasi password harus diisi. ',
                    'matches' => 'Password dan konfirmasi password tidak sama'
                ]
            ]
        ])) {
            return redirect()->to(base_url() . '/profil')->withInput();
        }

        $password = $this->request->getVar('password');
        $password_baru = $this->request->getVar('password_baru');

        if ($this->verifyMyth->verify($password, user()->password_hash)) {
            $id = user()->id;
            $password_baru_hash = $this->verifyMyth->hash($password_baru);
            $data = [
                'password_hash' => $password_baru_hash
            ];

            $this->userModels->update($id, $data);

            session()->setFlashdata('sukses', 'Password berhasil diubah');

            return redirect()->to(base_url('profil'));
        } else {
            return redirect()->to(base_url('profil'))->with('error_password', 'password salah');
        }
    }
}
