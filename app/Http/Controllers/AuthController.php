<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * AuthController - Handles user authentication
 * 
 * This controller manages login, registration, and logout functionality
 * for the Poliklinik application with role-based redirections.
 */
class AuthController extends Controller
{
    /**
     * Show the login form
     * 
     * @return View
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Handle user login with role-based redirection
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        // Validate login credentials
        $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string']
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.'
        ]);

        $credentials = $request->only('email', 'password');

        // Attempt authentication
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Security: prevent session fixation

            $user = Auth::user();

            // Role-based redirection
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard')
                        ->with('success', 'Selamat datang, Admin!');
                case 'dokter':
                    return redirect()->route('dokter.dashboard')
                        ->with('success', 'Selamat datang, Dr. ' . $user->nama);
                case 'pasien':
                    return redirect()->route('pasien.dashboard')
                        ->with('success', 'Selamat datang, ' . $user->nama);
                default:
                    // Handle unknown role
                    Auth::logout();
                    return redirect()->route('login')
                        ->withErrors(['email' => 'Role pengguna tidak valid.']);
            }
        }

        return back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->withInput($request->except('password'));
    }

    /**
     * Show the registration form
     * 
     * @return View
     */
    public function showRegister(): View
    {
        return view('auth.register');
    }

    /**
     * Handle user registration (patients only)
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function register(Request $request): RedirectResponse
    {
        // Validate registration data
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:500'],
            'no_ktp' => ['required', 'string', 'size:16', 'unique:users,no_ktp', 'regex:/^[0-9]+$/'],
            'no_hp' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'no_ktp.required' => 'Nomor KTP wajib diisi.',
            'no_ktp.size' => 'Nomor KTP harus 16 digit.',
            'no_ktp.regex' => 'Nomor KTP hanya boleh berisi angka.',
            'no_ktp.unique' => 'Nomor KTP sudah terdaftar.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.'
        ]);

        // Generate unique medical record number (No. RM)
        $prefix = date('Ym'); // Format: YYYYMM
        $count = User::where('no_rm', 'like', $prefix . '-%')->count();
        $no_rm = $prefix . '-' . str_pad($count + 1, 3, '0', STR_PAD_LEFT);

        // Create new patient user
        try {
            User::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_ktp' => $request->no_ktp,
                'no_hp' => $request->no_hp,
                'no_rm' => $no_rm,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'pasien', // New registrations are always patients
            ]);

            return redirect()->route('login')
                ->with('success', 'Pendaftaran berhasil! Silakan login dengan akun Anda.');

        } catch (\Exception $e) {
            return back()
                ->withErrors(['general' => 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.'])
                ->withInput($request->except('password', 'password_confirmation'));
        }
    }

    /**
     * Handle user logout
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        // Invalidate session and regenerate token for security
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'Anda telah berhasil keluar dari sistem.');
    }
}