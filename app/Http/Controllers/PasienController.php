<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        return view('pasien.dashboard');
    }

    public function dashboard()
    {
        return view('pasien.dashboard');
    }
}