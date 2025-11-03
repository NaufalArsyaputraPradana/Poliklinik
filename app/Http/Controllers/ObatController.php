<?php

namespace App\Http\Controllers;

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
 * their names, packaging, and pricing information.
 */
class ObatController extends Controller
{
    /**
     * Display list of all medicines (Admin function)
     * 
     * Shows all medicines with their names, packaging,
     * prices, and usage statistics.
     *
     * @return View
     */
    public function index(): View
    {
        try {
            $obats = Obat::orderBy('nama_obat', 'asc')
                ->withCount('detailPeriksa')
                ->get();

            return view('admin.obats.index', compact('obats'));

        } catch (Exception $e) {
            Log::error('Failed to load medicines list: ' . $e->getMessage());

            return view('admin.obats.index', ['obats' => collect()])
                ->with('error', 'Gagal memuat daftar obat.');
        }
    }

    /**
     * Show form to create new medicine (Admin function)
     * 
     * Displays form for creating a new medicine
     * with name, packaging, and price fields.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.obats.create');
    }

    /**
     * Store new medicine data (Admin function)
     * 
     * Validates input and creates new medicine
     * with proper formatting and price validation.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            // Validate input data
            $validatedData = $request->validate([
                'nama_obat' => 'required|string|max:255|min:3|regex:/^[a-zA-Z\s\-\.0-9]+$/',
                'kemasan' => 'required|string|max:100|min:2|regex:/^[a-zA-Z0-9\s\-\.\/]+$/',
                'harga' => 'required|numeric|min:100|max:1000000',
            ], [
                'nama_obat.required' => 'Nama obat wajib diisi.',
                'nama_obat.min' => 'Nama obat minimal 3 karakter.',
                'nama_obat.max' => 'Nama obat maksimal 255 karakter.',
                'nama_obat.regex' => 'Nama obat hanya boleh berisi huruf, angka, spasi, titik, dan strip.',
                'kemasan.required' => 'Kemasan obat wajib diisi.',
                'kemasan.min' => 'Kemasan minimal 2 karakter.',
                'kemasan.max' => 'Kemasan maksimal 100 karakter.',
                'kemasan.regex' => 'Kemasan hanya boleh berisi huruf, angka, spasi, strip, titik, dan garis miring.',
                'harga.required' => 'Harga obat wajib diisi.',
                'harga.numeric' => 'Harga harus berupa angka.',
                'harga.min' => 'Harga minimal Rp 100.',
                'harga.max' => 'Harga maksimal Rp 1.000.000.',
            ]);

            // Create new medicine
            $obat = Obat::create([
                'nama_obat' => trim($validatedData['nama_obat']),
                'kemasan' => trim($validatedData['kemasan']),
                'harga' => round($validatedData['harga']),
            ]);

            Log::info('New medicine created successfully', [
                'obat_id' => $obat->id,
                'obat_name' => $obat->nama_obat,
                'price' => $obat->harga
            ]);

            return redirect()->route('admin.obat.index')
                ->with('message', 'Data obat berhasil ditambahkan')
                ->with('type', 'success');

        } catch (ValidationException $e) {
            Log::warning('Medicine creation validation failed', [
                'errors' => $e->errors()
            ]);

            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();

        } catch (Exception $e) {
            Log::error('Failed to create medicine: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Gagal menambahkan obat. Silakan coba lagi.')
                ->withInput();
        }
    }

    /**
     * Show form to edit medicine data (Admin function)
     * 
     * Displays edit form with current medicine data
     * for administrative updates.
     *
     * @param Obat $obat
     * @return View|RedirectResponse
     */
    public function edit(Obat $obat): View|RedirectResponse
    {
        try {
            return view('admin.obats.edit', compact('obat'));

        } catch (Exception $e) {
            Log::error('Failed to load edit medicine form: ' . $e->getMessage(), [
                'obat_id' => $obat->id
            ]);

            return redirect()->route('admin.obat.index')
                ->with('error', 'Gagal memuat form edit obat.');
        }
    }

    /**
     * Update medicine data (Admin function)
     * 
     * Validates and updates medicine information
     * including name, packaging, and price.
     *
     * @param Request $request
     * @param Obat $obat
     * @return RedirectResponse
     */
    public function update(Request $request, Obat $obat): RedirectResponse
    {
        try {
            // Validate input data
            $validatedData = $request->validate([
                'nama_obat' => 'required|string|max:255|min:3|regex:/^[a-zA-Z\s\-\.0-9]+$/',
                'kemasan' => 'required|string|max:100|min:2|regex:/^[a-zA-Z0-9\s\-\.\/]+$/',
                'harga' => 'required|numeric|min:100|max:1000000',
            ], [
                'nama_obat.required' => 'Nama obat wajib diisi.',
                'nama_obat.min' => 'Nama obat minimal 3 karakter.',
                'nama_obat.max' => 'Nama obat maksimal 255 karakter.',
                'nama_obat.regex' => 'Nama obat hanya boleh berisi huruf, angka, spasi, titik, dan strip.',
                'kemasan.required' => 'Kemasan obat wajib diisi.',
                'kemasan.min' => 'Kemasan minimal 2 karakter.',
                'kemasan.max' => 'Kemasan maksimal 100 karakter.',
                'kemasan.regex' => 'Kemasan hanya boleh berisi huruf, angka, spasi, strip, titik, dan garis miring.',
                'harga.required' => 'Harga obat wajib diisi.',
                'harga.numeric' => 'Harga harus berupa angka.',
                'harga.min' => 'Harga minimal Rp 100.',
                'harga.max' => 'Harga maksimal Rp 1.000.000.',
            ]);

            // Update medicine
            $obat->update([
                'nama_obat' => trim($validatedData['nama_obat']),
                'kemasan' => trim($validatedData['kemasan']),
                'harga' => round($validatedData['harga']),
            ]);

            Log::info('Medicine updated successfully', [
                'obat_id' => $obat->id,
                'obat_name' => $obat->nama_obat,
                'price' => $obat->harga
            ]);

            return redirect()->route('admin.obat.index')
                ->with('message', 'Data obat berhasil diperbarui')
                ->with('type', 'success');

        } catch (ValidationException $e) {
            Log::warning('Medicine update validation failed', [
                'obat_id' => $obat->id,
                'errors' => $e->errors()
            ]);

            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();

        } catch (Exception $e) {
            Log::error('Failed to update medicine: ' . $e->getMessage(), [
                'obat_id' => $obat->id,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Gagal mengubah data obat. Silakan coba lagi.')
                ->withInput();
        }
    }

    /**
     * Delete medicine data (Admin function)
     * 
     * Safely removes medicine after checking
     * for usage in prescriptions.
     *
     * @param Obat $obat
     * @return RedirectResponse
     */
    public function destroy(Obat $obat): RedirectResponse
    {
        try {
            // Check if medicine is used in prescriptions
            $isUsed = $obat->detailPeriksa()->exists();

            if ($isUsed) {
                return redirect()->route('admin.obat.index')
                    ->with('warning', 'Obat tidak dapat dihapus karena sudah digunakan dalam resep.');
            }

            $obatName = $obat->nama_obat;
            $obatId = $obat->id;

            // Delete medicine
            $obat->delete();

            Log::info('Medicine deleted successfully', [
                'obat_id' => $obatId,
                'obat_name' => $obatName
            ]);

            return redirect()->route('admin.obat.index')
                ->with('message', 'Data obat berhasil dihapus')
                ->with('type', 'success');

        } catch (Exception $e) {
            Log::error('Failed to delete medicine: ' . $e->getMessage(), [
                'obat_id' => $obat->id,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('admin.obat.index')
                ->with('error', 'Gagal menghapus data obat. Silakan coba lagi.');
        }
    }
}
