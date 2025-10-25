<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    public function index()
    {
        $polis = Poli::all();
        return view('admin.polis.index', compact('polis'));
    }

    public function create()
    {
        return view('admin.polis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        Poli::create([
            'nama_poli' => $request->nama_poli,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.polis.index')
            ->with('message', 'Poli berhasil ditambahkan')
            ->with('type', 'success');
    }

    public function edit($id)
    {
        $poli = Poli::findOrFail($id);
        return view('admin.polis.edit', compact('poli'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $poli = Poli::findOrFail($id);
        $poli->update([
            'nama_poli' => $request->nama_poli,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.polis.index')
            ->with('message', 'Poli berhasil diperbarui')
            ->with('type', 'success');
    }

    public function destroy($id)
    {
        try {
            $poli = Poli::findOrFail($id);
            $poli->delete();

            return redirect()->route('admin.polis.index')
                ->with('message', 'Poli berhasil dihapus')
                ->with('type', 'success');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('message', 'Gagal menghapus poli')
                ->with('type', 'error');
        }
    }
}