<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\karyawanModel;

class LoginController extends BaseController
{
    protected $karyawanModel;

    public function __construct(){
        $this->karyawanModel = new karyawanModel();
    }

    public function index()
    {
        session();
        $data = [
            'validation' => \Config\Services::validation()
        ];
        return view('login/index', $data);
    }

    public function login()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        if(!$this->validate([
            'username' => 'required',
            'password' => 'required'
        ])){
            $validation = \Config\Services::validation();
            // dd($validation->listErrors());
            return redirect()->to('/')->withInput()->with('validation', $validation);
        }

        $karyawan = $this->karyawanModel->where(['username' => $username, 'password' => $password])->first();
        
        if($karyawan){
            // login berhasil
            // buat data di sessian
            $sesionData = [
                'username'  => $karyawan['username'] ,
                'nik'     => $karyawan['nik'],
                'logged_in' => true,
            ];
            session()->set($sesionData);
            return redirect()->to('/home');
        }else{
            //login gagal
            session()->setFlashdata('pesan', 'LOGIN GAGAL');
            return redirect()->to('/');
        }
        
    }
}
