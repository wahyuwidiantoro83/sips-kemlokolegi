<?php

namespace App\Controllers;

use App\Models\Permohonanmodels;

class Riwayat extends BaseController
{
    protected $permohonanModels;
    public function __construct()
    {
        $this->permohonanModels = new Permohonanmodels();
    }
    public function index()
    {
        $nik_pemohon = user()->username;
        $riwayat = $this->permohonanModels->select('permohonan.*, surat.nama_surat')
            ->join('surat', 'surat.id_surat = permohonan.id_surat')->where('nik_pemohon', $nik_pemohon)
            ->findAll();

        $data = [
            'title' => 'Riwayat Permohonan | SIPS Kemlokolegi',
            'riwayat' => $riwayat
        ];
        return view('permohonan/riwayat', $data);
    }
}
