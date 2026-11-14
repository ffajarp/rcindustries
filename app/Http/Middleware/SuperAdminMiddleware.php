<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    /**
     * Middleware untuk memastikan user adalah Admin Super
     * Hanya Admin Super yang bisa register user baru
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user adalah admin super
        if (!Auth::check() || !Auth::user()->is_super_admin) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Akses ditolak. Hanya Admin Super yang dapat mengakses halaman ini');
        }

        return $next($request);
    }
}
