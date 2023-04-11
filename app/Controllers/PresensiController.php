<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PresensiController extends BaseController
{
    public function index()
    {
        return view('presensi/home');
    }

    public function presensi()
    {
        return view('presensi/proses');
    }
}
