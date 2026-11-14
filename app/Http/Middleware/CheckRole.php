<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Middleware untuk memastikan user memiliki role tertentu
     * 
     * @param array $roles - Array nama role yang diizinkan
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('admin.login')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        // Ambil role user yang login
        $userRole = Auth::user()->role->nama_role;

        // Cek apakah role user ada di dalam daftar role yang diizinkan
        if (!in_array($userRole, $roles)) {
            // Redirect ke halaman yang sesuai berdasarkan role
            if ($userRole === 'Pegawai') {
                return redirect()->route('orders.index')
                    ->with('error', 'Anda tidak memiliki akses ke halaman ini');
            }
            
            return redirect()->route('admin.dashboard')
                ->with('error', 'Anda tidak memiliki akses ke halaman ini');
        }

        return $next($request);
    }
}
