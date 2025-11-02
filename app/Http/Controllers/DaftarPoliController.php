<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\Poli;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DaftarPoliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $daftars = DaftarPoli::with('jadwalPeriksa.dokter', 'periksa')
            ->where('id_pasien', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pasien.riwayat', compact('daftars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $polis = Poli::all();
        $jadwals = JadwalPeriksa::with('dokter', 'dokter.poli')->get();

        return view('pasien.daftar', compact('user', 'polis', 'jadwals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_jadwal' => 'required|exists:jadwal_periksas,id',
            'keluhan' => 'required|string',
        ]);

        $id_jadwal = $request->id_jadwal;

        $count = DaftarPoli::where('id_jadwal', $id_jadwal)->count();
        $no_antrian = $count + 1;

        DaftarPoli::create([
            'id_pasien' => Auth::id(),
            'id_jadwal' => $id_jadwal,
            'keluhan' => $request->keluhan,
            'no_antrian' => $no_antrian,
        ]);

        return redirect()->back()->with('message', 'Pendaftaran poli berhasil')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(DaftarPoli $daftarPoli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DaftarPoli $daftarPoli)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DaftarPoli $daftarPoli)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DaftarPoli $daftarPoli)
    {
        //
    }
}
