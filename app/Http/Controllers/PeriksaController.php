<?php

namespace App\Http\Controllers;

use App\Models\Periksa;
use App\Models\DaftarPoli;
use App\Models\Obat;
use App\Models\DetailPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Exception;

/**
 * PeriksaController - Manages patient examination process
 * 
 * Handles doctor's patient examination workflow including
 * viewing patient queue, conducting examinations, and prescribing medicines.
 */
class PeriksaController extends Controller
{
    /**
     * Display list of patients waiting for examination
     * 
     * Shows queue of registered patients for today based on
     * logged-in doctor's active schedule.
     *
     * @return View
     */
    public function index(): View
    {
        try {
            $dokter = Auth::user();

            // Get today's active schedule for this doctor
            $jadwalAktif = \App\Models\JadwalPeriksa::where('id_dokter', $dokter->id)
                ->where('aktif', true)
                ->first();

            if (!$jadwalAktif) {
                return view('dokter.periksa.index', [
                    'daftars' => collect(),
                    'hasActiveSchedule' => false
                ])->with('warning', 'Anda belum memiliki jadwal aktif hari ini.');
            }

            // Get patient registrations for today
            $daftars = DaftarPoli::with(['pasien', 'periksa'])
                ->where('id_jadwal', $jadwalAktif->id)
                ->whereDate('created_at', today())
                ->orderBy('no_antrian')
                ->get();

            return view('dokter.periksa.index', [
                'daftars' => $daftars,
                'hasActiveSchedule' => true
            ]);

        } catch (Exception $e) {
            Log::error('Failed to load examination queue: ' . $e->getMessage(), [
                'doctor_id' => Auth::id()
            ]);

            return view('dokter.periksa.index', [
                'daftars' => collect(),
                'hasActiveSchedule' => false
            ])->with('error', 'Gagal memuat daftar pasien.');
        }
    }

    /**
     * Display examination form for specific patient
     * 
     * Shows patient details and form to input examination
     * results and prescribe medicines.
     *
     * @param string $id DaftarPoli ID
     * @return View|RedirectResponse
     */
    public function show(string $id): View|RedirectResponse
    {
        try {
            $daftar = DaftarPoli::with([
                'pasien',
                'jadwalPeriksa.dokter',
                'periksa.detailPeriksa.obat'
            ])->findOrFail($id);

            // Verify this patient is for logged-in doctor
            if ($daftar->jadwalPeriksa->id_dokter !== Auth::id()) {
                return redirect()->route('dokter.periksa-pasien.index')
                    ->with('error', 'Akses tidak diizinkan.');
            }

            $obats = Obat::orderBy('nama_obat')->get();

            return view('dokter.periksa.form', compact('daftar', 'obats'));

        } catch (Exception $e) {
            Log::error('Failed to load examination form: ' . $e->getMessage(), [
                'daftar_id' => $id,
                'doctor_id' => Auth::id()
            ]);

            return redirect()->route('dokter.periksa-pasien.index')
                ->with('error', 'Gagal memuat form pemeriksaan.');
        }
    }

    /**
     * Store examination results and prescription
     * 
     * Saves examination data including diagnosis, medicines,
     * and calculates total cost automatically.
     *
     * @param Request $request
     * @param string $id DaftarPoli ID
     * @return RedirectResponse
     */
    public function store(Request $request, string $id): RedirectResponse
    {
        try {
            $daftar = DaftarPoli::with('jadwalPeriksa')->findOrFail($id);

            // Verify this patient is for logged-in doctor
            if ($daftar->jadwalPeriksa->id_dokter !== Auth::id()) {
                return redirect()->route('dokter.periksa-pasien.index')
                    ->with('error', 'Akses tidak diizinkan.');
            }

            // Check if already examined
            if ($daftar->periksa()->exists()) {
                return redirect()->route('dokter.periksa-pasien.index')
                    ->with('warning', 'Pasien sudah diperiksa sebelumnya.');
            }

            // Validate input
            $validatedData = $request->validate([
                'tgl_periksa' => 'required|date',
                'catatan' => 'required|string|min:10|max:1000',
                'obat' => 'required|array|min:1',
                'obat.*' => 'required|exists:obats,id',
            ], [
                'tgl_periksa.required' => 'Tanggal periksa wajib diisi.',
                'catatan.required' => 'Catatan pemeriksaan wajib diisi.',
                'catatan.min' => 'Catatan minimal 10 karakter.',
                'catatan.max' => 'Catatan maksimal 1000 karakter.',
                'obat.required' => 'Minimal 1 obat harus dipilih.',
                'obat.min' => 'Minimal 1 obat harus dipilih.',
                'obat.*.exists' => 'Obat yang dipilih tidak valid.',
            ]);

            DB::beginTransaction();

            // Calculate total cost (150,000 base + medicines)
            $biayaPeriksa = 150000;
            $obats = Obat::whereIn('id', $validatedData['obat'])->get();
            $totalBiayaObat = $obats->sum('harga');
            $totalBiaya = $biayaPeriksa + $totalBiayaObat;

            // Create examination record
            $periksa = Periksa::create([
                'id_daftar_poli' => $daftar->id,
                'tgl_periksa' => $validatedData['tgl_periksa'],
                'catatan' => trim($validatedData['catatan']),
                'biaya_periksa' => $totalBiaya,
            ]);

            // Create prescription details
            foreach ($validatedData['obat'] as $obatId) {
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $obatId,
                ]);
            }

            DB::commit();

            Log::info('Patient examination completed', [
                'periksa_id' => $periksa->id,
                'daftar_id' => $daftar->id,
                'doctor_id' => Auth::id(),
                'patient_id' => $daftar->id_pasien,
                'total_cost' => $totalBiaya,
                'medicine_count' => count($validatedData['obat'])
            ]);

            return redirect()->route('dokter.periksa-pasien.index')
                ->with('success', 'Pemeriksaan berhasil disimpan.');

        } catch (ValidationException $e) {
            Log::warning('Examination validation failed', [
                'daftar_id' => $id,
                'errors' => $e->errors()
            ]);

            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();

        } catch (Exception $e) {
            DB::rollBack();

            Log::error('Failed to store examination: ' . $e->getMessage(), [
                'daftar_id' => $id,
                'doctor_id' => Auth::id(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Gagal menyimpan hasil pemeriksaan. Silakan coba lagi.')
                ->withInput();
        }
    }

    /**
     * Display examination history for doctor
     * 
     * Shows complete list of all patients examined by
     * the logged-in doctor with examination details.
     *
     * @return View
     */
    public function riwayat(): View
    {
        try {
            $dokter = Auth::user();

            $periksas = Periksa::with([
                'daftarPoli.pasien',
                'daftarPoli.jadwalPeriksa',
                'detailPeriksa.obat'
            ])
                ->whereHas('daftarPoli.jadwalPeriksa', function ($query) use ($dokter) {
                    $query->where('id_dokter', $dokter->id);
                })
                ->orderBy('tgl_periksa', 'desc')
                ->get();

            return view('dokter.riwayat-pasien.index', compact('periksas'));

        } catch (Exception $e) {
            Log::error('Failed to load examination history: ' . $e->getMessage(), [
                'doctor_id' => Auth::id()
            ]);

            return view('dokter.riwayat-pasien.index', ['periksas' => collect()])
                ->with('error', 'Gagal memuat riwayat pemeriksaan.');
        }
    }

    /**
     * Update examination results
     * 
     * Allows doctor to update examination data within
     * 24 hours of the examination date.
     *
     * @param Request $request
     * @param Periksa $periksa
     * @return RedirectResponse
     */
    public function update(Request $request, Periksa $periksa): RedirectResponse
    {
        try {
            $periksa->load('daftarPoli.jadwalPeriksa');

            // Verify this examination belongs to logged-in doctor
            if ($periksa->daftarPoli->jadwalPeriksa->id_dokter !== Auth::id()) {
                return redirect()->route('dokter.riwayat-pasien.index')
                    ->with('error', 'Akses tidak diizinkan.');
            }

            // Check if update is allowed (within 24 hours)
            if ($periksa->created_at->diffInHours(now()) > 24) {
                return redirect()->route('dokter.riwayat-pasien.index')
                    ->with('warning', 'Pemeriksaan hanya dapat diubah dalam 24 jam setelah dibuat.');
            }

            // Validate input
            $validatedData = $request->validate([
                'catatan' => 'required|string|min:10|max:1000',
                'obat' => 'required|array|min:1',
                'obat.*' => 'required|exists:obats,id',
            ], [
                'catatan.required' => 'Catatan pemeriksaan wajib diisi.',
                'catatan.min' => 'Catatan minimal 10 karakter.',
                'catatan.max' => 'Catatan maksimal 1000 karakter.',
                'obat.required' => 'Minimal 1 obat harus dipilih.',
                'obat.*.exists' => 'Obat yang dipilih tidak valid.',
            ]);

            DB::beginTransaction();

            // Recalculate total cost
            $biayaPeriksa = 150000;
            $obats = Obat::whereIn('id', $validatedData['obat'])->get();
            $totalBiayaObat = $obats->sum('harga');
            $totalBiaya = $biayaPeriksa + $totalBiayaObat;

            // Update examination
            $periksa->update([
                'catatan' => trim($validatedData['catatan']),
                'biaya_periksa' => $totalBiaya,
            ]);

            // Delete old prescription details and create new ones
            $periksa->detailPeriksa()->delete();
            foreach ($validatedData['obat'] as $obatId) {
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $obatId,
                ]);
            }

            DB::commit();

            Log::info('Patient examination updated', [
                'periksa_id' => $periksa->id,
                'doctor_id' => Auth::id(),
                'updated_fields' => ['catatan', 'biaya_periksa', 'medicines']
            ]);

            return redirect()->route('dokter.riwayat-pasien.index')
                ->with('success', 'Hasil pemeriksaan berhasil diperbarui.');

        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();

        } catch (Exception $e) {
            DB::rollBack();

            Log::error('Failed to update examination: ' . $e->getMessage(), [
                'periksa_id' => $periksa->id,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Gagal mengubah hasil pemeriksaan. Silakan coba lagi.')
                ->withInput();
        }
    }
}
