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

    function getKaryawanByNIK($nik)
    {
        $db      = \Config\Database::connect();

        $data = $db->table('tbl_karyawan')
        ->select('tbl_karyawan.*, nama_cabang, alamat_cabang, lokasi_cabang,radius_absensi')
        ->join('tbl_cabang', 'tbl_cabang.id = tbl_karyawan.id_cabang')
        ->where('tbl_karyawan.nik', $nik)->get()->getRow();
        $lokasi_kantor = explode(',', $data->lokasi_cabang);
        $data = [
            'data_karyawan' => $data,
            'latitude_kantor' => $lokasi_kantor[0],
            'longitude_kantor' => $lokasi_kantor[1],
            'radius' => $data->radius_absensi

        ];
        return $data;
    }

}
