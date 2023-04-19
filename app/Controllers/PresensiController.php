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
            'user' => $this->presensiModel->where(['nik' => session()->get('nik'), 'tgl_presensi' => date('Y-m-d')])->first(),
        ];
        return view('presensi/home', $data);
    }

    public function presensi()
    {
        return view('presensi/proses');
    }

    public function create()
    {
        $nik = session()->get('nik');
        $image = $this->request->getVar('image');
        $lokasi = $this->request->getVar('lokasi');

		$img = str_replace('data:image/png;base64,', '', $image);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
        $fileName = $nik .'-'.date('Y-m-d').'-M.png';
		$file = APPPATH .'/image/'. $fileName;
		$success = file_put_contents($file, $data);

        $data = [
            'tgl_presensi' => date('Y-m-d'),
            'nik' => $nik,
            'foto_masuk' => $fileName,
            'jam_masuk' => date('H:i:s'),
            'lokasi_masuk' => $lokasi,
            'status' => 0,
            'terlambat' => 0,
            'jml_terlambat' => 0,
            'sift' => 1
        ];

        if($this->presensiModel->save($data)){
            echo json_encode(['pesan' => $success]);
        }

        

    }

} // end class
