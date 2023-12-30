<?php

namespace App\Controllers;

use App\Models\Permohonanmodels;

class Download extends BaseController
{
    protected $arsip;
    public function __construct()
    {
        $this->arsip = new Permohonanmodels();
    }
    public function download($file)
    {
        $no_srt = $this->arsip->select('no_srt')->where('scan_surat', $file)->first();
        $formatfile = explode('.', $file)[1];
        $path = APPPATH . 'dokumen/scan/' . $file; // tentukan path file yang akan didownload
        $filename = date('Ymd') . '_' . $no_srt['no_srt'] . '.' . $formatfile; // tentukan nama file yang akan didownload
        if (file_exists($path)) {
            // Generate download
            return $this->response->download($path, null)->setFileName($filename);
        } else {
            // File not found
            throw new \CodeIgniter\Exceptions\PageNotFoundException('File not found: ' . $filename);
        }
    }
}
