<?php

namespace App\Controllers;

use App\Models\Permohonanmodels;
use PhpOffice\PhpWord\TemplateProcessor as PhpWordTemplateProcessor;

class Cetak extends BaseController
{
    protected $permohonanModels;
    protected $db;
    public function __construct()
    {
        $this->permohonanModels = new Permohonanmodels();
        $this->db = \Config\Database::connect();
    }
    public function print_1($id)
    {
        $perangkat = $this->db->table('perangkat')->select('*')->get()->getRowArray();

        $surat = $this->permohonanModels->select('*')->find($id);

        $tanggal_baru = date("d-m-Y", strtotime($surat['tgl_verif']));
        $nama_pemohon_ttd = strtoupper($surat['nama_pemohon']);

        $nomor_surat = $surat['no_instansi'] . '/' . $surat['no_srt'] . '/' . $surat['no_ref'] . '/' . $surat['tahun_srt'];

        $template = new PhpWordTemplateProcessor(APPPATH . 'Views/template_surat/sktm(umum).docx');

        // Mengisi placeholder pada template dengan data surat
        $template->setValue('no_srt', $nomor_surat);
        $template->setValue('tgl_verif', $tanggal_baru);
        $template->setValue('nik_pemohon', $surat['nik_pemohon']);
        $template->setValue('nama_pemohon', $surat['nama_pemohon']);
        $template->setValue('nama_pemohon_ttd', $nama_pemohon_ttd);
        $template->setValue('kades', $perangkat['kades']);
        $template->setValue('ttl_pemohon', $surat['ttl_pemohon']);
        $template->setValue('jk_pemohon', $surat['jk_pemohon']);
        $template->setValue('status_pemohon', $surat['status_pemohon']);
        $template->setValue('kerja_pemohon', $surat['kerja_pemohon']);
        $template->setValue('alamat_pemohon', $surat['alamat_pemohon']);

        // Menyimpan file surat ke dalam stream output
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment;filename="surat_' . $nomor_surat . '.docx"');
        $template->saveAs('php://output');
    }

    public function print_2($id)
    {
        $perangkat = $this->db->table('perangkat')->select('*')->get()->getRowArray();

        $surat = $this->permohonanModels->select('*')->find($id);

        $tanggal_baru = date("d-m-Y", strtotime($surat['tgl_verif']));
        $nama_pemohon_ttd = strtoupper($surat['nama_pemohon']);

        $nomor_surat = $surat['no_instansi'] . '/' . $surat['no_srt'] . '/' . $surat['no_ref'] . '/' . $surat['tahun_srt'];

        $template = new PhpWordTemplateProcessor(APPPATH . 'Views/template_surat/penghasilan.docx');

        // Mengisi placeholder pada template dengan data surat
        $template->setValue('no_srt', $nomor_surat);
        $template->setValue('tgl_verif', $tanggal_baru);
        $template->setValue('nik_pemohon', $surat['nik_pemohon']);
        $template->setValue('nama_pemohon', $surat['nama_pemohon']);
        $template->setValue('nama_pemohon_ttd', $nama_pemohon_ttd);
        $template->setValue('kades', $perangkat['kades']);
        $template->setValue('ttl_pemohon', $surat['ttl_pemohon']);
        $template->setValue('jk_pemohon', $surat['jk_pemohon']);
        $template->setValue('penghasilan', $surat['penghasilan']);
        $template->setValue('status_pemohon', $surat['status_pemohon']);
        $template->setValue('kerja_pemohon', $surat['kerja_pemohon']);
        $template->setValue('alamat_pemohon', $surat['alamat_pemohon']);

        // Menyimpan file surat ke dalam stream output
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment;filename="surat_' . $nomor_surat . '.docx"');
        $template->saveAs('php://output');
    }

    public function print_3($id)
    {
        $perangkat = $this->db->table('perangkat')->select('*')->get()->getRowArray();

        $surat = $this->permohonanModels->select('*')->find($id);

        $tanggal_baru = date("d-m-Y", strtotime($surat['tgl_verif']));
        $nama_pemohon_ttd = strtoupper($surat['nama_pemohon']);

        $nomor_surat = $surat['no_instansi'] . '/' . $surat['no_srt'] . '/' . $surat['no_ref'] . '/' . $surat['tahun_srt'];

        $template = new PhpWordTemplateProcessor(APPPATH . 'Views/template_surat/sktm(beasiswa).docx');

        // Mengisi placeholder pada template dengan data surat
        $template->setValue('no_srt', $nomor_surat);
        $template->setValue('tgl_verif', $tanggal_baru);
        $template->setValue('nik_pemohon', $surat['nik_pemohon']);
        $template->setValue('nama_pemohon', $surat['nama_pemohon']);
        $template->setValue('kades', $perangkat['kades']);
        $template->setValue('ttl_pemohon', $surat['ttl_pemohon']);
        $template->setValue('jk_pemohon', $surat['jk_pemohon']);
        $template->setValue('penghasilan', $surat['penghasilan']);
        $template->setValue('status_pemohon', $surat['status_pemohon']);
        $template->setValue('kerja_pemohon', $surat['kerja_pemohon']);
        $template->setValue('alamat_pemohon', $surat['alamat_pemohon']);
        $template->setValue('nama_dimohon', $surat['nama_dimohon']);
        $template->setValue('nik_dimohon', $surat['nik_dimohon']);
        $template->setValue('jk_dimohon', $surat['jk_dimohon']);
        $template->setValue('ttl_dimohon', $surat['ttl_dimohon']);
        $template->setValue('alamat_dimohon', $surat['alamat_dimohon']);
        $template->setValue('pendidikan', $surat['pendidikan']);
        $template->setValue('kelas', $surat['kelas']);

        // Menyimpan file surat ke dalam stream output
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment;filename="surat_' . $nomor_surat . '.docx"');
        $template->saveAs('php://output');
    }

    public function print_4($id)
    {
        $perangkat = $this->db->table('perangkat')->select('*')->get()->getRowArray();

        $surat = $this->permohonanModels->select('*')->find($id);

        $tanggal_baru = date("d-m-Y", strtotime($surat['tgl_verif']));
        $nama_pemohon_ttd = strtoupper($surat['nama_pemohon']);

        $nomor_surat = $surat['no_instansi'] . '/' . $surat['no_srt'] . '/' . $surat['no_ref'] . '/' . $surat['tahun_srt'];

        $template = new PhpWordTemplateProcessor(APPPATH . 'Views/template_surat/izinhiburan.docx');

        // Mengisi placeholder pada template dengan data surat
        $template->setValue('no_srt', $nomor_surat);
        $template->setValue('tgl_verif', $tanggal_baru);
        $template->setValue('nik_pemohon', $surat['nik_pemohon']);
        $template->setValue('nama_pemohon', $surat['nama_pemohon']);
        $template->setValue('nama_pemohon_ttd', $nama_pemohon_ttd);
        $template->setValue('kades', $perangkat['kades']);
        $template->setValue('babinsa', $perangkat['babinsa']);
        $template->setValue('nrp_babinsa', $perangkat['nrp_babinsa']);
        $template->setValue('bhabinkamtibmas', $perangkat['bhabinkamtibmas']);
        $template->setValue('nrp_bhabin', $perangkat['nrp_bhabin']);
        $template->setValue('ttl_pemohon', $surat['ttl_pemohon']);
        $template->setValue('jk_pemohon', $surat['jk_pemohon']);
        $template->setValue('keperluan', $surat['keperluan']);
        $template->setValue('tglacara', $surat['tglacara']);
        $template->setValue('waktuacara', $surat['waktuacara']);
        $template->setValue('status_pemohon', $surat['status_pemohon']);
        $template->setValue('kerja_pemohon', $surat['kerja_pemohon']);
        $template->setValue('alamat_pemohon', $surat['alamat_pemohon']);

        // Menyimpan file surat ke dalam stream output
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment;filename="surat_' . $nomor_surat . '.docx"');
        $template->saveAs('php://output');
    }

    public function print_5($id)
    {
        $perangkat = $this->db->table('perangkat')->select('*')->get()->getRowArray();

        $surat = $this->permohonanModels->select('*')->find($id);

        $tanggal_baru = date("d-m-Y", strtotime($surat['tgl_verif']));
        $nama_pemohon_ttd = strtoupper($surat['nama_pemohon']);

        $nomor_surat = $surat['no_instansi'] . '/' . $surat['no_srt'] . '/' . $surat['no_ref'] . '/' . $surat['tahun_srt'];

        $template = new PhpWordTemplateProcessor(APPPATH . 'Views/template_surat/keteranganusaha.docx');

        // Mengisi placeholder pada template dengan data surat
        $template->setValue('no_srt', $nomor_surat);
        $template->setValue('tgl_verif', $tanggal_baru);
        $template->setValue('nik_pemohon', $surat['nik_pemohon']);
        $template->setValue('nama_pemohon', $surat['nama_pemohon']);
        $template->setValue('nama_pemohon_ttd', $nama_pemohon_ttd);
        $template->setValue('kades', $perangkat['kades']);
        $template->setValue('ttl_pemohon', $surat['ttl_pemohon']);
        $template->setValue('jk_pemohon', $surat['jk_pemohon']);
        $template->setValue('keperluan', $surat['keperluan']);
        $template->setValue('tglacara', $surat['tglacara']);
        $template->setValue('waktuacara', $surat['waktuacara']);
        $template->setValue('status_pemohon', $surat['status_pemohon']);
        $template->setValue('kerja_pemohon', $surat['kerja_pemohon']);
        $template->setValue('alamat_pemohon', $surat['alamat_pemohon']);
        $template->setValue('nama_usaha', $surat['nama_usaha']);
        $template->setValue('alamat_usaha', $surat['alamat_usaha']);

        // Menyimpan file surat ke dalam stream output
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment;filename="surat_' . $nomor_surat . '.docx"');
        $template->saveAs('php://output');
    }

    public function print_6($id)
    {
        $perangkat = $this->db->table('perangkat')->select('*')->get()->getRowArray();

        $surat = $this->permohonanModels->select('*')->find($id);

        $tanggal_baru = date("d-m-Y", strtotime($surat['tgl_verif']));
        $nama_pemohon_ttd = strtoupper($surat['nama_pemohon']);

        $nomor_surat = $surat['no_instansi'] . '/' . $surat['no_srt'] . '/' . $surat['no_ref'] . '/' . $surat['tahun_srt'];

        $template = new PhpWordTemplateProcessor(APPPATH . 'Views/template_surat/kelakuanbaik.docx');

        // Mengisi placeholder pada template dengan data surat
        $template->setValue('no_srt', $nomor_surat);
        $template->setValue('tgl_verif', $tanggal_baru);
        $template->setValue('nik_pemohon', $surat['nik_pemohon']);
        $template->setValue('nama_pemohon', $surat['nama_pemohon']);
        $template->setValue('nama_pemohon_ttd', $nama_pemohon_ttd);
        $template->setValue('kades', $perangkat['kades']);
        $template->setValue('ttl_pemohon', $surat['ttl_pemohon']);
        $template->setValue('jk_pemohon', $surat['jk_pemohon']);
        $template->setValue('keperluan', $surat['keperluan']);
        $template->setValue('status_pemohon', $surat['status_pemohon']);
        $template->setValue('kerja_pemohon', $surat['kerja_pemohon']);
        $template->setValue('alamat_pemohon', $surat['alamat_pemohon']);
        $template->setValue('nama_usaha', $surat['nama_usaha']);
        $template->setValue('alamat_usaha', $surat['alamat_usaha']);

        // Menyimpan file surat ke dalam stream output
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment;filename="surat_' . $nomor_surat . '.docx"');
        $template->saveAs('php://output');
    }

    public function print_7($id)
    {
        $perangkat = $this->db->table('perangkat')->select('*')->get()->getRowArray();

        $surat = $this->permohonanModels->select('*')->find($id);

        $tanggal_baru = date("d-m-Y", strtotime($surat['tgl_verif']));
        $nama_pemohon_ttd = strtoupper($surat['nama_pemohon']);

        $nomor_surat = $surat['no_instansi'] . '/' . $surat['no_srt'] . '/' . $surat['no_ref'] . '/' . $surat['tahun_srt'];

        $template = new PhpWordTemplateProcessor(APPPATH . 'Views/template_surat/domisili.docx');

        // Mengisi placeholder pada template dengan data surat
        $template->setValue('no_srt', $nomor_surat);
        $template->setValue('tgl_verif', $tanggal_baru);
        $template->setValue('nik_pemohon', $surat['nik_pemohon']);
        $template->setValue('nama_pemohon', $surat['nama_pemohon']);
        $template->setValue('nama_pemohon_ttd', $nama_pemohon_ttd);
        $template->setValue('kades', $perangkat['kades']);
        $template->setValue('ttl_pemohon', $surat['ttl_pemohon']);
        $template->setValue('jk_pemohon', $surat['jk_pemohon']);
        $template->setValue('keperluan', $surat['keperluan']);
        $template->setValue('domisili', $surat['domisili']);
        $template->setValue('status_pemohon', $surat['status_pemohon']);
        $template->setValue('kerja_pemohon', $surat['kerja_pemohon']);
        $template->setValue('alamat_pemohon', $surat['alamat_pemohon']);
        $template->setValue('nama_usaha', $surat['nama_usaha']);
        $template->setValue('alamat_usaha', $surat['alamat_usaha']);

        // Menyimpan file surat ke dalam stream output
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment;filename="surat_' . $nomor_surat . '.docx"');
        $template->saveAs('php://output');
    }

    public function print_9($id)
    {
        $perangkat = $this->db->table('perangkat')->select('*')->get()->getRowArray();

        $surat = $this->permohonanModels->select('*')->find($id);

        $tanggal_baru = date("d-m-Y", strtotime($surat['tgl_verif']));
        $nama_pemohon_ttd = strtoupper($surat['nama_pemohon']);

        $nomor_surat = $surat['no_instansi'] . '/' . $surat['no_srt'] . '/' . $surat['no_ref'] . '/' . $surat['tahun_srt'];

        $template = new PhpWordTemplateProcessor(APPPATH . 'Views/template_surat/ktp.docx');

        // Mengisi placeholder pada template dengan data surat
        $template->setValue('no_srt', $nomor_surat);
        $template->setValue('tgl_verif', $tanggal_baru);
        $template->setValue('nik_pemohon', $surat['nik_pemohon']);
        $template->setValue('nama_pemohon', $surat['nama_pemohon']);
        $template->setValue('nama_pemohon_ttd', $nama_pemohon_ttd);
        $template->setValue('kades', $perangkat['kades']);
        $template->setValue('ttl_pemohon', $surat['ttl_pemohon']);
        $template->setValue('jk_pemohon', $surat['jk_pemohon']);
        $template->setValue('status_pemohon', $surat['status_pemohon']);
        $template->setValue('kerja_pemohon', $surat['kerja_pemohon']);
        $template->setValue('alamat_pemohon', $surat['alamat_pemohon']);

        // Menyimpan file surat ke dalam stream output
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment;filename="surat_' . $nomor_surat . '.docx"');
        $template->saveAs('php://output');
    }

    public function print_8($id)
    {
        $perangkat = $this->db->table('perangkat')->select('*')->get()->getRowArray();

        $surat = $this->permohonanModels->select('*')->find($id);

        $tanggal_baru = date("d-m-Y", strtotime($surat['tgl_verif']));
        $nama_pemohon_ttd = strtoupper($surat['nama_pemohon']);

        $nomor_surat = $surat['no_instansi'] . '/' . $surat['no_srt'] . '/' . $surat['no_ref'] . '/' . $surat['tahun_srt'];

        $template = new PhpWordTemplateProcessor(APPPATH . 'Views/template_surat/lainnya.docx');

        // Mengisi placeholder pada template dengan data surat
        $template->setValue('no_srt', $nomor_surat);
        $template->setValue('tgl_verif', $tanggal_baru);
        $template->setValue('nik_pemohon', $surat['nik_pemohon']);
        $template->setValue('nama_surat', $surat['nama_surat_lain']);
        $template->setValue('keperluan', $surat['keperluan']);
        $template->setValue('nama_pemohon', $surat['nama_pemohon']);
        $template->setValue('nama_pemohon_ttd', $nama_pemohon_ttd);
        $template->setValue('kades', $perangkat['kades']);
        $template->setValue('ttl_pemohon', $surat['ttl_pemohon']);
        $template->setValue('jk_pemohon', $surat['jk_pemohon']);
        $template->setValue('status_pemohon', $surat['status_pemohon']);
        $template->setValue('kerja_pemohon', $surat['kerja_pemohon']);
        $template->setValue('alamat_pemohon', $surat['alamat_pemohon']);

        // Menyimpan file surat ke dalam stream output
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment;filename="surat_' . $nomor_surat . '.docx"');
        $template->saveAs('php://output');
    }
}
