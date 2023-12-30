<?php

namespace App\Controllers;

class Gambar extends BaseController
{
    public function getImage($filename)
    {
        if (file_exists(APPPATH . 'dokumen/uploads/' . $filename)) {
            $path = APPPATH . 'dokumen/uploads/' . $filename;
            $mime = mime_content_type($path);
            header('Content-Type: ' . $mime);
            readfile($path);
        } else {
            if (file_exists(APPPATH . 'dokumen/scan/' . $filename)) {
                $path = APPPATH . 'dokumen/scan/' . $filename;
                $mime = mime_content_type($path);
                header('Content-Type: ' . $mime);
                readfile($path);
            }
        }
    }

    public function getScan($filename)
    {
        $path = APPPATH . 'dokumen/scan/' . $filename;
        $mime = mime_content_type($path);
        header('Content-Type: ' . $mime);
        readfile($path);
    }
}
