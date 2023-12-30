<?php

namespace App\Models;

use CodeIgniter\Model;

class Usermodels extends Model
{
    protected $table      = 'users';
    // protected $primaryKey = 'id';

    // protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['email', 'username', 'nama', 'tempat', 'tgllhr', 'jk', 'alamat', 'telp', 'agama', 'kawin', 'pekerjaan', 'password_hash', 'active'];

    // // Dates
    protected $useTimestamps = true;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
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

    public function get_users($id = false)
    {
        if ($id == false) {
            $builder = $this->db->table('users');
            $builder->select('users.id as userid, username, email, name, nama, alamat');
            $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $query = $builder->get();
            return $query->getResult();
        }
        return $this->where(['id' => $id])->first();
    }
}
