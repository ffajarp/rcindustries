<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function showLogin()
    {
        // Jika sudah login, redirect sesuai role
        if (Auth::check()) {
            $role = Auth::user()->role->nama_role;
            if ($role === 'Admin' || $role === 'Owner') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('orders.index');
            }
        }
        
        return view('admin.login');
    }

    /**
     * Proses login user
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username harus diisi',
            'password.required' => 'Password harus diisi',
        ]);

        // Cek kredensial
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->remember)) {
            // Regenerate session untuk keamanan
            $request->session()->regenerate();
            
            // Redirect berdasarkan role
            $user = Auth::user();
            $role = $user->role->nama_role;
            
            if ($role === 'Admin' || $role === 'Owner') {
                return redirect()->intended(route('admin.dashboard'))
                    ->with('success', 'Selamat datang, ' . $user->nama);
            } else {
                // Untuk Pegawai atau role lain, redirect ke Order
                return redirect()->intended(route('orders.index'))
                    ->with('success', 'Selamat datang, ' . $user->nama);
            }
        }

        // Login gagal
        return back()->withErrors([
            'username' => 'Username atau password salah',
        ])->withInput($request->only('username'));
    }

    /**
     * Proses logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        // Invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('admin.login')
            ->with('success', 'Berhasil logout');
    }
}
