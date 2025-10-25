<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obats = Obat::orderBy('nama_obat', 'asc')->get();
        return view('admin.obats.index', compact('obats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.obats.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
        ]);

        Obat::create($request->all());

        return redirect()->route('admin.obat.index')
            ->with('message', 'Data Obat berhasil ditambahkan')
            ->with('type', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Obat $obat)
    {
        return view('admin.obats.edit', compact('obat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Obat $obat)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
        ]);

        $obat->update($request->all());

        return redirect()->route('admin.obat.index')
            ->with('message', 'Data Obat berhasil diperbarui')
            ->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Obat $obat)
    {
        try {
            $obat->delete();

            return redirect()->route('admin.obat.index')
                ->with('message', 'Data Obat berhasil dihapus')
                ->with('type', 'success');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('message', 'Gagal menghapus data obat')
                ->with('type', 'error');
        }
    }
}
