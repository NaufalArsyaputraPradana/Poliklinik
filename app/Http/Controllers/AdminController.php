<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use App\Models\User;
use App\Models\Obat;

class AdminController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.dashboard');
    }

    public function dashboard()
    {
        $totalPoli = Poli::count();
        $totalDokter = User::where('role', 'dokter')->count();
        $totalPasien = User::where('role', 'pasien')->count();
        $totalObat = Obat::count();

        return view('admin.dashboard', compact('totalPoli', 'totalDokter', 'totalPasien', 'totalObat'));
    }
}