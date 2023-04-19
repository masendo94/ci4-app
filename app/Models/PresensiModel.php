<?php

namespace App\Models;

use CodeIgniter\Model;

class PresensiModel extends Model
{
    protected $table            = 'tbl_presensi';
    protected $primaryKey       = 'id';
    protected $allowedFields = ['nik','jam_masuk','jam_pulang','lokasi_masuk','lokasi_pulang','foto_masuk','foto_pulang','status','terlambat','jml_terlambat','sift','tgl_presensi'];

    

}
