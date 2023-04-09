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
        return view('login/index');
    }

    public function login()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $karyawan = $this->karyawanModel->where(['username' => $username, 'password' => $password])->first();
        
        if($karyawan){
            // login berhasil
            return redirect()->to('/home');
        }else{
            //login gagal
            return redirect()->to('/');
        }
        
    }
}
