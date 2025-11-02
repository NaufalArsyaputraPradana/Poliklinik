<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $polis = Poli::orderBy('nama_poli', 'asc')->get();
        return view('admin.polis.index', compact('polis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.polis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:25|unique:polis,nama_poli',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Poli::create([
            'nama_poli' => $request->nama_poli,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.polis.index')->with('message', 'Poli berhasil ditambahkan')->with('type', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Poli $poli)
    {
        return view('admin.polis.edit', compact('poli'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Poli $poli)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:25|unique:polis,nama_poli,' . $poli->id,
            'keterangan' => 'nullable|string|max:255',
        ]);

        $poli->update([
            'nama_poli' => $request->nama_poli,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.polis.index')->with('message', 'Poli berhasil diperbarui')->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Poli $poli)
    {
        $poli->delete();
        return redirect()->route('admin.polis.index')->with('message', 'Poli berhasil dihapus')->with('type', 'success');
    }
}