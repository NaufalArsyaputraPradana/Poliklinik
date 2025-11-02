<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dokter = Auth::user();
        $jadwalPeriksas = JadwalPeriksa::where('id_dokter', $dokter->id)
            ->orderBy('hari')
            ->get();

        return view('dokter.jadwal-periksa.index', compact('jadwalPeriksas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dokter.jadwal-periksa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required|string|max:20',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai'
        ]);

        JadwalPeriksa::create([
            'id_dokter' => Auth::id(),
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'aktif' => 'Y'
        ]);

        return redirect()->route('dokter.jadwal-periksa.index')
            ->with('message', 'Jadwal periksa berhasil ditambahkan')
            ->with('type', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalPeriksa $jadwalPeriksa)
    {
        // Ensure only the owner can edit
        if ($jadwalPeriksa->id_dokter !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('dokter.jadwal-periksa.edit', compact('jadwalPeriksa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalPeriksa $jadwalPeriksa)
    {
        // Ensure only the owner can update
        if ($jadwalPeriksa->id_dokter !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'hari' => 'required|string|max:20',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai'
        ]);

        $jadwalPeriksa->update([
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai
        ]);

        return redirect()->route('dokter.jadwal-periksa.index')
            ->with('message', 'Jadwal periksa berhasil diperbarui')
            ->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalPeriksa $jadwalPeriksa)
    {
        // Ensure only the owner can delete
        if ($jadwalPeriksa->id_dokter !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $jadwalPeriksa->delete();

        return redirect()->route('dokter.jadwal-periksa.index')
            ->with('message', 'Jadwal periksa berhasil dihapus')
            ->with('type', 'success');
    }
}