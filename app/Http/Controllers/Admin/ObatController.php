<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Exception;

/**
 * ObatController - Manages medicine/drug operations
 * 
 * Handles CRUD operations for managing medicines including
 * stock management.
 */
class ObatController extends Controller
{
    /**
     * Display list of all medicines
     *
     * @return View
     */
    public function index(): View
    {
        try {
            $obats = Obat::orderBy('nama_obat', 'asc')->get();
            return view('admin.obats.index', compact('obats'));

        } catch (Exception $e) {
            Log::error('Failed to load medicines list: ' . $e->getMessage());
            return view('admin.obats.index', ['obats' => collect()])
                ->with('error', 'Gagal memuat daftar obat.');
        }
    }

    /**
     * Show form to create new medicine
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.obats.create');
    }

    /**
     * Store new medicine data
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $validatedData = $request->validate([
                'nama_obat' => 'required|string|max:255',
                'kemasan' => 'required|string|max:100',
                'harga' => 'required|numeric|min:100',
                'stok' => 'nullable|integer|min:0|max:100000',
                'stok_minimum' => 'nullable|integer|min:1|max:1000',
            ], [
                'nama_obat.required' => 'Nama obat wajib diisi.',
                'kemasan.required' => 'Kemasan obat wajib diisi.',
                'harga.required' => 'Harga obat wajib diisi.',
                'harga.min' => 'Harga minimal Rp 100.',
                'stok.min' => 'Stok tidak boleh negatif.',
                'stok.max' => 'Stok maksimal 100,000 unit.',
                'stok_minimum.max' => 'Stok minimum maksimal 1,000 unit.',
            ]);

            Obat::create([
                'nama_obat' => $validatedData['nama_obat'],
                'kemasan' => $validatedData['kemasan'],
                'harga' => $validatedData['harga'],
                'stok' => $validatedData['stok'] ?? 0,
                'stok_minimum' => $validatedData['stok_minimum'] ?? 10,
            ]);

            return redirect()->route('admin.obat.index')
                ->with('message', 'Data obat berhasil ditambahkan')
                ->with('type', 'success');

        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();

        } catch (Exception $e) {
            Log::error('Failed to create medicine: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal menambahkan obat.')
                ->withInput();
        }
    }

    /**
     * Show form to edit medicine data
     *
     * @param Obat $obat
     * @return View
     */
    public function edit(Obat $obat): View
    {
        return view('admin.obats.edit', compact('obat'));
    }

    /**
     * Update medicine data
     *
     * @param Request $request
     * @param Obat $obat
     * @return RedirectResponse
     */
    public function update(Request $request, Obat $obat): RedirectResponse
    {
        try {
            $validatedData = $request->validate([
                'nama_obat' => 'required|string|max:255',
                'kemasan' => 'required|string|max:100',
                'harga' => 'required|numeric|min:100',
                'stok' => 'nullable|integer|min:0|max:100000',
                'stok_minimum' => 'nullable|integer|min:1|max:1000',
            ], [
                'nama_obat.required' => 'Nama obat wajib diisi.',
                'kemasan.required' => 'Kemasan obat wajib diisi.',
                'harga.required' => 'Harga obat wajib diisi.',
                'harga.min' => 'Harga minimal Rp 100.',
                'stok.min' => 'Stok tidak boleh negatif.',
                'stok.max' => 'Stok maksimal 100,000 unit.',
                'stok_minimum.max' => 'Stok minimum maksimal 1,000 unit.',
            ]);

            $obat->update([
                'nama_obat' => $validatedData['nama_obat'],
                'kemasan' => $validatedData['kemasan'],
                'harga' => $validatedData['harga'],
                'stok' => $validatedData['stok'] ?? $obat->stok,
                'stok_minimum' => $validatedData['stok_minimum'] ?? $obat->stok_minimum,
            ]);

            return redirect()->route('admin.obat.index')
                ->with('message', 'Data obat berhasil diperbarui')
                ->with('type', 'success');

        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();

        } catch (Exception $e) {
            Log::error('Failed to update medicine: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Gagal mengubah data obat.')
                ->withInput();
        }
    }

    /**
     * Delete medicine data
     *
     * @param Obat $obat
     * @return RedirectResponse
     */
    public function destroy(Obat $obat): RedirectResponse
    {
        try {
            // Check if medicine is used in prescriptions
            if ($obat->detailPeriksa()->exists()) {
                return redirect()->route('admin.obat.index')
                    ->with('warning', 'Obat tidak dapat dihapus karena sudah digunakan dalam resep.');
            }

            $obat->delete();

            return redirect()->route('admin.obat.index')
                ->with('message', 'Data obat berhasil dihapus')
                ->with('type', 'success');

        } catch (Exception $e) {
            Log::error('Failed to delete medicine: ' . $e->getMessage());
            return redirect()->route('admin.obat.index')
                ->with('error', 'Gagal menghapus data obat.');
        }
    }
}
