<?php

namespace App\Controllers;

use App\Models\Permohonanmodels;

class Home extends BaseController
{
    protected $permohonanModels;
    public function __construct()
    {
        $this->permohonanModels = new Permohonanmodels();
    }
    public function index()
    {
        $data = [
            'title' => 'Home | SIPS Kemlokolegi'
        ];

        if (in_groups('admin')) {
            $disetujui = $this->permohonanModels->where('status_verif', 'Disetujui')->countAllResults();
            $ditangguhkan = $this->permohonanModels->where('status_verif', 'Menunggu')->countAllResults();
            $ditolak = $this->permohonanModels->where('status_verif', 'Ditolak')->countAllResults();
            $total = $this->permohonanModels->countAllResults();
            $notifPermohonan = $this->permohonanModels->select('permohonan.*, surat.nama_surat')
                ->join('surat', 'surat.id_surat = permohonan.id_surat')->where('status_verif', 'Menunggu')
                ->limit(5)
                ->find();
            $favoritUmum = $this->permohonanModels
                ->select('permohonan.id_surat, surat.nama_surat, COUNT(*) AS jumlah_permohonan')
                ->join('surat', 'surat.id_surat = permohonan.id_surat')
                ->where('permohonan.id_surat <> 8')
                ->groupBy('permohonan.id_surat')
                ->orderBy('jumlah_permohonan', 'DESC')
                ->findAll();

            $data['labelsUmum'] = [];
            $data['dataUmum'] = [];

            foreach ($favoritUmum as $row) {
                $data['labelsUmum'][] = $row['nama_surat'];
                $data['dataUmum'][] = $row['jumlah_permohonan'];
            }

            $favoritLainnya = $this->permohonanModels
                ->select('nama_surat_lain, COUNT(*) AS jumlah_permohonan')
                ->where('id_surat', '8')
                ->groupBy('nama_surat_lain')
                ->orderBy('jumlah_permohonan', 'DESC')
                ->findAll();

            $data['labelsLain'] = [];
            $data['dataLain'] = [];

            foreach ($favoritLainnya as $row) {
                $data['labelsLain'][] = $row['nama_surat_lain'];
                $data['dataLain'][] = $row['jumlah_permohonan'];
            }

            $datapermohonanbulan = $this->permohonanModels->select('MONTH(tgl_pengajuan) as month, COUNT(id) as total')
                ->where('YEAR(tgl_pengajuan)', date('Y'))
                ->groupBy('MONTH(tgl_pengajuan)')
                ->findAll();
            $data['labels'] = [];
            $data['data'] = [];
            foreach ($datapermohonanbulan as $row) {
                $monthNumber = $row['month'];
                $monthName = date('F', mktime(0, 0, 0, $monthNumber, 1));
                $data['labels'][] = $monthName;
                $data['data'][] = $row['total'];
            }
        }

        if (in_groups('user')) {
            $disetujui = $this->permohonanModels->where('status_verif', 'Disetujui')->where('nik_pemohon', user()->username)->countAllResults();
            $ditangguhkan = $this->permohonanModels->where('status_verif', 'Ditangguhkan')->where('nik_pemohon', user()->username)->countAllResults();
            $ditolak = $this->permohonanModels->where('status_verif', 'Ditolak')->where('nik_pemohon', user()->username)->countAllResults();
            $total = $this->permohonanModels->where('nik_pemohon', user()->username)->countAllResults();
        }

        $data['disetujui'] = $disetujui ?? 0;
        $data['ditangguhkan'] = $ditangguhkan ?? 0;
        $data['ditolak'] = $ditolak ?? 0;
        $data['total'] = $total ?? 0;
        $data['favoritUmum'] = $favoritUmum ?? 0;
        $data['favoritLainnya'] = $favoritLainnya ?? 0;
        $data['notifPermohonan'] = $notifPermohonan ?? 0;

        return view('home/index', $data);
    }
}
