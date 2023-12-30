<?php

namespace App\Controllers;

use App\Models\Suratmodels;

class Setelan extends BaseController
{
    protected $suratModels;
    protected $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->suratModels = new Suratmodels();
    }
    public function index()
    {
        $result_nomor = $this->db->table('nomor')->limit(1)->get()->getRowArray();
        $result_perangkat = $this->db->table('perangkat')->limit(1)->get()->getRowArray();
        $surat = $this->suratModels->getAllSurat();
        $data = [
            'title' => 'Setelan Permohonan | SIPS Kemlokolegi',
            'nomor' => $result_nomor,
            'perangkat' => $result_perangkat,
            'surat' => $surat
        ];
        return view('setelan/index_setelan', $data);
    }

    public function update_perangkat($id)
    {
        if (!$this->validate([
            'kades' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Kepala Desa harus diisi. '
                ]
            ],
            'babinsa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Babinsa harus diisi. '
                ]
            ],
            'nrp_babin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'NRP Babinsa harus diisi. '
                ]
            ],
            'bhabinkamtibmas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Bhabinkamtibmas harus diisi. '
                ]
            ],
            'nrp_bhabin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'NRP Bhabinkamtibmas harus diisi. '
                ]
            ],
        ])) {
            return redirect()->to(base_url() . '/setelan')->with('error', 'Data yang diinputkan tidak lengkap');
        }

        $kades = $this->request->getVar('kades');
        $babinsa = $this->request->getVar('babinsa');
        $nrp_babinsa = $this->request->getVar('nrp_babin');
        $bhabinkamtibmas = $this->request->getVar('bhabinkamtibmas');
        $nrp_bhabin = $this->request->getVar('nrp_bhabin');
        $builder = $this->db->table('perangkat');
        $builder->where('id', $id);
        $data = [
            'kades' => $kades,
            'babinsa' => $babinsa,
            'nrp_babinsa' => $nrp_babinsa,
            'bhabinkamtibmas' => $bhabinkamtibmas,
            'nrp_bhabin' => $nrp_bhabin,
        ];
        $builder->update($data);

        if ($builder->update($data)) {
            session()->setFlashdata('success', 'Data berhasil diubah');
        } else {
            session()->setFlashdata('error', 'Data gagal diubah');
        }
        return redirect()->to('/setelan');
    }

    public function update_nomor($id)
    {
        if (!$this->validate([
            'no_instansi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No Instansi harus diisi. '
                ]
            ],
            'no_referensi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No Referensi harus diisi. '
                ]
            ]
        ])) {
            return redirect()->to(base_url() . '/setelan')->with('error', 'Data yang diinputkan tidak lengkap');
        }

        $no_instansi = $this->request->getVar('no_instansi');
        $no_referensi = $this->request->getVar('no_referensi');
        $builder = $this->db->table('nomor');
        $builder->where('id', $id);
        $data = [
            'no_instansi' => $no_instansi,
            'no_referensi' => $no_referensi
        ];
        $builder->update($data);

        if ($builder->update($data)) {
            session()->setFlashdata('success', 'Data berhasil diubah');
        } else {
            session()->setFlashdata('error', 'Data gagal diubah');
        }
        return redirect()->to('/setelan');
    }

    public function update_status()
    {
        $id = $this->request->getPost('id');
        $status = $this->request->getPost('status');
        $data = [
            'status' => $status,
        ];
        $this->suratModels->update($id, $data);
        echo json_encode(array('success' => true));
    }
}
