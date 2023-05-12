<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PresensiModel;
use App\Models\KaryawanModel;

class PresensiController extends BaseController
{
    protected $presensiModel;

    public function __construct(){
        $this->presensiModel = new PresensiModel();
        $this->KaryawanModel = new KaryawanModel();
    }

    public function index()
    {
        $data = [
            'user' => $this->presensiModel->cekAbsen( session()->get('nik'), 'date' ),
            'absensi' => $this->presensiModel->getAbsenHarian( session()->get('id_cabang')),
        ];
        
        return view('presensi/home', $data);
    }

    public function presensi()
    {
        $data = [
            'user' => $this->presensiModel->cekAbsen( session()->get('nik'), 'status' ),
            'kantor' => $this->KaryawanModel->getKaryawanByNIK(session()->get('nik'))

        ];

        // var_dump($data['kantor']['latitude_kantor']);die;

        return view('presensi/proses', $data);
    }

    public function create()
    {
        $nik = session()->get('nik');
        $image = $this->request->getVar('image');
        $lokasi = $this->request->getVar('lokasi');
        $lokasiKaryawan = explode(',',$lokasi);
        $latKaryawan = $lokasiKaryawan[0];
        $longKaryawan = $lokasiKaryawan[1];

        $lokasiKantor = $this->KaryawanModel->getKaryawanByNIK($nik);
        $latKantor = $lokasiKantor['latitude_kantor'];
        $longKantor = $lokasiKantor['longitude_kantor'];
        $radiusKantor = $lokasiKantor['radius'];

        // cek radius lokasi user 
        $radius = $this->jarak($latKaryawan,$longKaryawan,$latKantor,$longKantor);

        if($radius > $radiusKantor){
            echo json_encode(['pesan' => 'Kamu belum dikantor', 'status' => 'Gagal', 'icon' => 'warning','jenis' => 'radius']);
            return;
        }


        $cekStatusAbsen = $this->presensiModel->cekAbsen( $nik, 'status' );

		$img = str_replace('data:image/png;base64,', '', $image);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
        $fileName = $nik .'-'.date('Y-m-d');
        $fileName .= (!$cekStatusAbsen) ? '-M.png' : '-P.png';
		$file = 'public/assets/img/presensi/'. $fileName;
		$success = file_put_contents($file, $data);

        if(!$cekStatusAbsen){

            // menghitung keterlambatan
            $jam_masuk = strtotime('07:00'); // jam masuk kantor
            $jam_absen = strtotime(date('H:i')); // jam absen karyawan

            // hitung selisih waktu dalam menit
            $selisih_menit = round(abs($jam_absen - $jam_masuk) / 60);
            $terlambat = ($selisih_menit > 0 ) ? 1 : 0;


        $data = [
            'tgl_presensi' => date('Y-m-d'),
            'nik' => $nik,
            'foto_masuk' => $fileName,
            'foto_pulang' => 'avatar.jpg',
            'jam_masuk' => date('H:i:s'),
            'lokasi_masuk' => $lokasi,
            'status' => 0,
            'terlambat' => $terlambat,
            'jml_terlambat' => $selisih_menit,
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

    function jarak($lat1, $lon1, $lat2, $lon2) {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $kilometer = ($miles * 1.609344); // mengonversi hasil ke 
        return $kilometer * 1000; // mengubah jadi meter
    }

   

} // end class
