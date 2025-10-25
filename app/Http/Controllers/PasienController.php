<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pasiens = User::pasiens()
            ->orderBy('nama', 'asc')
            ->get();
        return view('admin.pasiens.index', compact('pasiens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pasiens.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_ktp' => 'required|string|max:16|unique:users',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Generate no_rm otomatis
        $lastPasien = User::pasiens()
            ->whereNotNull('no_rm')
            ->orderBy('no_rm', 'desc')
            ->first();

        $lastNumber = $lastPasien ? (int) substr($lastPasien->no_rm, -6) : 0;
        $newNumber = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
        $no_rm = date('Ym') . $newNumber;

        User::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_rm' => $no_rm,
            'role' => 'pasien',
        ]);

        return redirect()->route('admin.pasien.index')
            ->with('message', 'Data Pasien berhasil ditambahkan')
            ->with('type', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pasien = User::findOrFail($id);
        return view('admin.pasiens.edit', compact('pasien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pasien = User::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_ktp' => 'required|string|max:16|unique:users,no_ktp,' . $pasien->id,
            'no_hp' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:users,email,' . $pasien->id,
            'password' => 'nullable|string|min:6',
        ]);

        $data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $pasien->update($data);

        return redirect()->route('admin.pasien.index')
            ->with('message', 'Data Pasien berhasil diperbarui')
            ->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $pasien = User::findOrFail($id);
            $pasien->delete();

            return redirect()->route('admin.pasien.index')
                ->with('message', 'Data Pasien berhasil dihapus')
                ->with('type', 'success');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('message', 'Gagal menghapus data pasien')
                ->with('type', 'error');
        }
    }
}
