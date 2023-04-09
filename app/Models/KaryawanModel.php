<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table            = 'tbl_karyawan';
    protected $primaryKey       = 'nik';

    public function getLogin($username,$password)
    {
        return $this->where(['username' => $username, 'password' => $password])->first();
    }

}
