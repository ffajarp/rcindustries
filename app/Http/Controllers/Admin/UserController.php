<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua user
     */
    public function index()
    {
        $users = User::with('role')->orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Menampilkan form tambah user baru (hanya admin super)
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Menyimpan user baru ke database (hanya admin super)
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:6',
            'nama' => 'required|string|max:100',
            'telp' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'role_id' => 'required|exists:roles,id',
        ], [
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah digunakan',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'nama.required' => 'Nama harus diisi',
            'telp.required' => 'Telepon harus diisi',
            'role_id.required' => 'Role harus dipilih',
            'role_id.exists' => 'Role tidak valid',
        ]);

        // Simpan user baru
        User::create([
            'username' => $validated['username'],
            'password' => $validated['password'],
            'nama' => $validated['nama'],
            'telp' => $validated['telp'],
            'alamat' => $validated['alamat'],
            'role_id' => $validated['role_id'],
            'is_super_admin' => false,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit user
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update data user
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'username' => 'required|string|max:50|unique:users,username,' . $id,
            'password' => 'nullable|string|min:6',
            'nama' => 'required|string|max:100',
            'telp' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'role_id' => 'required|exists:roles,id',
        ], [
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username sudah digunakan',
            'password.min' => 'Password minimal 6 karakter',
            'nama.required' => 'Nama harus diisi',
            'telp.required' => 'Telepon harus diisi',
            'role_id.required' => 'Role harus dipilih',
        ]);

        // Update data
        $user->username = $validated['username'];
        $user->nama = $validated['nama'];
        $user->telp = $validated['telp'];
        $user->alamat = $validated['alamat'];
        $user->role_id = $validated['role_id'];
        
        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $user->password = $validated['password'];
        }
        
        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diupdate');
    }

    /**
     * Hapus user (tidak bisa hapus admin super)
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Cek apakah user adalah admin super
        if ($user->is_super_admin) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Admin Super tidak dapat dihapus');
        }

        // Hapus user
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus');
    }

    /**
     * Menampilkan halaman setting menu untuk user tertentu
     */
    public function menuSetting($id)
    {
        $user = User::with('menuAccess')->findOrFail($id);
        
        // Daftar menu yang tersedia di sistem
        $availableMenus = [
            'Dashboard Penjualan',
            'Order',
            'Jenis Order',
            'Harga HPP',
            'User Management',
            'Role Management',
            'Company Settings',
        ];
        
        // Ambil menu yang sudah di-assign ke user ini
        $userMenus = $user->menuAccess->pluck('menu_name')->toArray();

        return view('admin.users.menu-setting', compact('user', 'availableMenus', 'userMenus'));
    }

    /**
     * Simpan setting menu untuk user
     */
    public function updateMenuSetting(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'menus' => 'nullable|array',
            'menus.*' => 'string',
        ]);

        // Hapus semua menu access lama
        $user->menuAccess()->delete();

        // Simpan menu access baru
        if (isset($validated['menus'])) {
            foreach ($validated['menus'] as $menuName) {
                $user->menuAccess()->create([
                    'menu_name' => $menuName,
                ]);
            }
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'Setting menu user berhasil diupdate');
    }
}
