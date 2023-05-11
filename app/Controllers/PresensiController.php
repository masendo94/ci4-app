<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PresensiModel;

class PresensiController extends BaseController
{
    protected $presensiModel;

    public function __construct(){
        $this->presensiModel = new PresensiModel();
    }

    public function index()
    {
        $data = [
            'user' => $this->presensiModel->cekAbsen( session()->get('nik'), 'date' ),
        ];
        return view('presensi/home', $data);
    }

    public function presensi()
    {
        $data = [
            'user' => $this->presensiModel->cekAbsen( session()->get('nik'), 'status' )
        ];
        return view('presensi/proses', $data);
    }

    public function create()
    {
        $nik = session()->get('nik');
        $image = $this->request->getVar('image');
        $lokasi = $this->request->getVar('lokasi');

        $cekStatusAbsen = $this->presensiModel->cekAbsen( session()->get('nik'), 'status' );

		$img = str_replace('data:image/png;base64,', '', $image);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
        $fileName = $nik .'-'.date('Y-m-d');
        $fileName .= (!$cekStatusAbsen) ? '-M.png' : '-P.png';
		$file = 'public/assets/img/presensi/'. $fileName;
		$success = file_put_contents($file, $data);

        if(!$cekStatusAbsen){

        $data = [
            'tgl_presensi' => date('Y-m-d'),
            'nik' => $nik,
            'foto_masuk' => $fileName,
            'foto_pulang' => 'avatar.jpg',
            'jam_masuk' => date('H:i:s'),
            'lokasi_masuk' => $lokasi,
            'status' => 0,
            'terlambat' => 0,
            'jml_terlambat' => 0,
            'sift' => 1
        ];

        $this->presensiModel->save($data);
        echo json_encode(['pesan' => 'Selamat bekerja', 'status' => 'Berhasil', 'icon' => 'success','jenis' => 'masuk']);
        }else{

            $data = [
            'foto_pulang' => $fileName,
            'jam_pulang' => date('H:i:s'),
            'lokasi_pulang' => $lokasi,
            'status' => 1
        ];

        $this->presensiModel->update(['id' => $cekStatusAbsen['id'] ], $data );
        echo json_encode(['pesan' => 'Selamat beristirahat', 'status' => 'Berhasil', 'icon' => 'success','jenis' => 'pulang']);

        }

        

    }

} // end class
