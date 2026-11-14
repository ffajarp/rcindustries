<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Menampilkan daftar semua role
     */
    public function index()
    {
        $roles = Role::withCount('users')->orderBy('created_at', 'desc')->get();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Menampilkan form tambah role baru
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Menyimpan role baru ke database
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_role' => 'required|string|max:50|unique:roles,nama_role',
            'deskripsi' => 'nullable|string',
        ], [
            'nama_role.required' => 'Nama role harus diisi',
            'nama_role.unique' => 'Nama role sudah digunakan',
            'nama_role.max' => 'Nama role maksimal 50 karakter',
        ]);

        // Simpan role baru
        Role::create($validated);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit role
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update data role
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'nama_role' => 'required|string|max:50|unique:roles,nama_role,' . $id,
            'deskripsi' => 'nullable|string',
        ], [
            'nama_role.required' => 'Nama role harus diisi',
            'nama_role.unique' => 'Nama role sudah digunakan',
            'nama_role.max' => 'Nama role maksimal 50 karakter',
        ]);

        // Update data
        $role->update($validated);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role berhasil diupdate');
    }

    /**
     * Hapus role (hanya jika tidak ada user yang menggunakan)
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        // Cek apakah ada user yang menggunakan role ini
        if ($role->users()->count() > 0) {
            return redirect()->route('admin.roles.index')
                ->with('error', 'Role tidak dapat dihapus karena masih digunakan oleh user');
        }

        // Hapus role
        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role berhasil dihapus');
    }
}
