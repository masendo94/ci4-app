<?php

namespace App\Models;

use CodeIgniter\Model;

class PresensiModel extends Model
{
    protected $table            = 'tbl_presensi';
    protected $primaryKey       = 'id';
    protected $allowedFields = ['nik','jam_masuk','jam_pulang','lokasi_masuk','lokasi_pulang','foto_masuk','foto_pulang','status','terlambat','jml_terlambat','sift','tgl_presensi'];

    public function cekAbsen($nik, $jenis){
        if($jenis == 'status'){
            return $this->where(['nik' => $nik, 'status' => 0 ])->first();
        }

        return $this->where(['nik' => $nik, 'tgl_presensi' => date('Y-m-d') ])->first();
    }

    public function getAbsenHarian($id_cabang)
    {
        $db      = \Config\Database::connect();

        $data = $db->table('tbl_karyawan')
        ->select('username, foto_masuk, jam_masuk, terlambat')
        ->join('tbl_presensi', 'tbl_karyawan.nik = tbl_presensi.nik')
        ->where('tgl_presensi', date('Y-m-d'))
        ->where('tbl_presensi.status', 0)
        ->where('tbl_karyawan.id_cabang', $id_cabang)
        ->orderBy('jam_masuk', 'DESC')
        ->get()->getResult();
        
        return $data;
    }

    

}
