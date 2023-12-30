<?php

namespace App\Models;

use CodeIgniter\Model;

class Permohonanmodels extends Model
{
    protected $table      = 'permohonan';
    // protected $primaryKey = 'id';

    // protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = [
        'no_srt', 'no_instansi', 'no_ref', 'tahun_srt', 'id_surat', 'nama_surat_lain', 'nik_pemohon', 'nama_pemohon', 'ttl_pemohon',
        'jk_pemohon', 'status_pemohon', 'kerja_pemohon', 'alamat_pemohon', 'penghasilan', 'nama_usaha', 'alamat_usaha', 'telp_pemohon', 'nik_dimohon',
        'nama_dimohon', 'ttl_dimohon', 'jk_dimohon', 'alamat_dimohon', 'tglacara', 'waktuacara', 'pendidikan', 'kelas', 'domisili',
        'keperluan', 'dokumen', 'scan_surat', 'status_verif', 'tgl_pengajuan', 'tgl_verif'
    ];

    // Dates
    protected $useTimestamps = true;
    // protected $dateFormat    = 'datetime';
    protected $createdField  = 'tgl_pengajuan';
    protected $updatedField  = false;
    // protected $deletedField  = 'deleted_at';

    // // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];
}
