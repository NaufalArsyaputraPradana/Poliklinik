<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application home page.
     * Redirect authenticated users to their respective dashboards.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        // Redirect authenticated users to their respective dashboards
        if (Auth::check()) {
            $user = Auth::user();

            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'dokter':
                    return redirect()->route('dokter.dashboard');
                case 'pasien':
                    return redirect()->route('pasien.dashboard');
                default:
                    // If role is undefined, logout and return to home
                    Auth::logout();
                    return redirect()->route('home')->with('error', 'Role pengguna tidak valid. Silakan login kembali.');
            }
        }

        return view('home');
    }
}