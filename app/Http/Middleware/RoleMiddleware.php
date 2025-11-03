<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = Auth::user();

        if ($user->role !== $role) {
            // Redirect to appropriate dashboard instead of showing 403
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
                case 'dokter':
                    return redirect()->route('dokter.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
                case 'pasien':
                    return redirect()->route('pasien.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
                default:
                    Auth::logout();
                    return redirect()->route('home')->with('error', 'Role pengguna tidak valid. Silakan login kembali.');
            }
        }

        return $next($request);
    }
}
