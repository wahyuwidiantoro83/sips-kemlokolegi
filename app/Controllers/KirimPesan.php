<?php

namespace App\Controllers;

class KirimPesan extends BaseController
{
    protected $token = 'LSQISrdI4ouxS45BpTJj'; //token api

    public function send_success($telp, $nama, $nama_srt, $no_srt, $keperluan, $tgl_verif, $filename)
    {
        $urlfile = base_url() . '/riwayat/download/' . $filename;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $telp . '|' . $nama . '|' . $nama_srt . '|' . $no_srt . '|' . $keperluan . '|' . $tgl_verif,
                'message' => "Halo Bapak/Ibu/Saudara {name},\nPermohonan surat yang Anda buat telah disetujui oleh desa.\n\nNama Surat: {var1}\nNomor Surat: {var2}\nKeperluan: {var3}\nTanggal Verifikasi: {var4}\n\nSurat asli dapat diambil langsung di kantor desa atau Anda dapat mengunduh file scan surat melalui tautan web berikut:\n$urlfile",
                'delay' => '5',
                'countryCode' => '62', //optional
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: " . $this->token //change TOKEN to your actual token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
    }

    public function send_fail($telp, $nama, $nama_srt, $keperluan, $tgl_pengajuan, $tgl_verif, $alasan)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $telp . '|' . $nama . '|' . $nama_srt .  '|' . $keperluan . '|' . $tgl_pengajuan . '|' . $tgl_verif . '|' . $alasan,
                'message' => "Halo Bapak/Ibu/Saudara {name},\nPermohonan surat yang Anda buat tidak disetujui oleh desa.\n\nNama Surat: {var1}\nKeperluan: {var2}\nTanggal Pengajuan: {var3}\nTanggal Verifikasi: {var4}\nAlasan: {var5}\n",
                'delay' => '5',
                'countryCode' => '62', //optional
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: " . $this->token //change TOKEN to your actual token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
    }

    public function send_addUser($telp, $nama, $username, $password)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $telp . '|' . $nama . '|' . $username .  '|' . $password,
                'message' => "Halo Bapak/Ibu/Saudara {name},\nBerikut adalah akun untuk mengakses website SIPS Kemlokolegi, mohon segera lakukan pergantian password melalui website.\n\nUsername: {var1}\nPassword: {var2}\n",
                'delay' => '5',
                'countryCode' => '62', //optional
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: " . $this->token //change TOKEN to your actual token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
    }
}
