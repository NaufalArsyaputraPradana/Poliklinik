<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    // Dashboard untuk dokter yang login
    public function dashboard()
    {
        return view('dokter.dashboard');
    }

    // CRUD untuk admin mengelola dokter
    public function index()
    {
        $dokters = User::where('role', 'dokter')->with('poli')->get();
        return view('admin.dokters.index', compact('dokters'));
    }

    public function create()
    {
        $polis = Poli::all();
        return view('admin.dokters.create', compact('polis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'no_ktp' => 'required|string|max:16|regex:/^[0-9]{16}$/',
            'id_poli' => 'required|exists:polis,id',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'no_ktp' => $request->no_ktp,
            'id_poli' => $request->id_poli,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'dokter',
        ]);

        return redirect()->route('admin.dokter.index')
            ->with('message', 'Data dokter berhasil ditambahkan')
            ->with('type', 'success');
    }

    public function edit(User $dokter)
    {
        $polis = Poli::all();
        return view('admin.dokters.edit', compact('dokter', 'polis'));
    }

    public function update(Request $request, User $dokter)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'no_ktp' => 'required|string|max:16|regex:/^[0-9]{16}$/',
            'id_poli' => 'required|exists:polis,id',
            'email' => 'required|string|email|max:255|unique:users,email,' . $dokter->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $updateData = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'no_ktp' => $request->no_ktp,
            'id_poli' => $request->id_poli,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $dokter->update($updateData);

        return redirect()->route('admin.dokter.index')
            ->with('message', 'Data dokter berhasil diubah')
            ->with('type', 'success');
    }

    public function destroy(User $dokter)
    {
        try {
            $dokter->delete();

            return redirect()->route('admin.dokter.index')
                ->with('message', 'Data dokter berhasil dihapus')
                ->with('type', 'success');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('message', 'Gagal menghapus data dokter')
                ->with('type', 'error');
        }
    }
}