<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasienController extends Controller
{
    // Dashboard untuk pasien yang login
    public function dashboard()
    {
        return view('pasien.dashboard');
    }

    // CRUD untuk admin mengelola pasien
    public function index()
    {
        $pasiens = User::where('role', 'pasien')->get();
        return view('admin.pasiens.index', compact('pasiens'));
    }

    public function create()
    {
        return view('admin.pasiens.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_ktp' => 'required|string|size:16|unique:users,no_ktp',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Generate nomor RM otomatis
        $lastPasien = User::where('role', 'pasien')->whereNotNull('no_rm')->orderBy('id', 'desc')->first();
        $lastNumber = $lastPasien ? intval(substr($lastPasien->no_rm, 6)) : 0;
        $newNumber = $lastNumber + 1;
        $no_rm = 'RM' . date('Ym') . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        User::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
            'no_rm' => $no_rm,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pasien',
        ]);

        return redirect()->route('admin.pasien.index')->with('success', 'Data pasien berhasil ditambahkan.');
    }

    public function edit(User $pasien)
    {
        return view('admin.pasiens.edit', compact('pasien'));
    }

    public function update(Request $request, User $pasien)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_ktp' => 'required|string|size:16|unique:users,no_ktp,' . $pasien->id,
            'no_hp' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users,email,' . $pasien->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $updateData = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_ktp' => $request->no_ktp,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ];

        // Update password jika diisi
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $pasien->update($updateData);

        return redirect()->route('admin.pasien.index')->with('success', 'Data pasien berhasil diubah.');
    }

    public function destroy(User $pasien)
    {
        $pasien->delete();
        return redirect()->route('admin.pasien.index')->with('success', 'Data pasien berhasil dihapus.');
    }
}