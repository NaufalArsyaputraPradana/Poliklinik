<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PoliController extends Controller
{
    /**
     * Display the patient registration form with poli and jadwal data.
     */
    public function get()
    {
        $user = Auth::user();
        $polis = Poli::all();
        $jadwals = JadwalPeriksa::with('dokter', 'dokter.poli')->get();

        return view('pasien.daftar', [
            'user' => $user,
            'polis' => $polis,
            'jadwals' => $jadwals,
        ]);
    }

    /**
     * Handle the patient registration to poli.
     */
    public function submit(Request $request)
    {
        $request->validate([
            'id_jadwal' => 'required|exists:jadwal_periksas,id',
            'keluhan' => 'nullable|string',
            'id_pasien' => 'required|exists:users,id',
        ]);

        // Hitung jumlah pendaftar pada jadwal tersebut untuk menentukan nomor antrian
        $jumlahSudahDaftar = DaftarPoli::where('id_jadwal', $request->id_jadwal)->count();

        // Buat data pendaftaran baru
        $daftar = DaftarPoli::create([
            'id_pasien' => $request->id_pasien,
            'id_jadwal' => $request->id_jadwal,
            'keluhan' => $request->keluhan,
            'no_antrian' => $jumlahSudahDaftar + 1,
        ]);

        return redirect()->back()->with('message', 'Berhasil Mendaftar ke Poli')->with('type', 'success');
    }
}