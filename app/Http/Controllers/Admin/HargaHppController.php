<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HargaHpp;
use Illuminate\Http\Request;

class HargaHppController extends Controller
{
    /**
     * Menampilkan daftar semua harga HPP
     */
    public function index()
    {
        $hargaHpps = HargaHpp::orderBy('created_at', 'desc')->get();
        return view('admin.master-data.harga-hpp.index', compact('hargaHpps'));
    }

    /**
     * Menampilkan form tambah harga HPP baru
     */
    public function create()
    {
        return view('admin.master-data.harga-hpp.create');
    }

    /**
     * Menyimpan harga HPP baru ke database
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_hpp' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
        ], [
            'nama_hpp.required' => 'Nama HPP harus diisi',
            'nama_hpp.max' => 'Nama HPP maksimal 100 karakter',
            'harga.required' => 'Harga harus diisi',
            'harga.numeric' => 'Harga harus berupa angka',
            'harga.min' => 'Harga tidak boleh kurang dari 0',
        ]);

        // Simpan harga HPP baru
        HargaHpp::create($validated);

        return redirect()->route('admin.harga-hpp.index')
            ->with('success', 'Harga HPP berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit harga HPP
     */
    public function edit($id)
    {
        $hargaHpp = HargaHpp::findOrFail($id);
        return view('admin.master-data.harga-hpp.edit', compact('hargaHpp'));
    }

    /**
     * Update data harga HPP
     */
    public function update(Request $request, $id)
    {
        $hargaHpp = HargaHpp::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'nama_hpp' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
        ], [
            'nama_hpp.required' => 'Nama HPP harus diisi',
            'nama_hpp.max' => 'Nama HPP maksimal 100 karakter',
            'harga.required' => 'Harga harus diisi',
            'harga.numeric' => 'Harga harus berupa angka',
            'harga.min' => 'Harga tidak boleh kurang dari 0',
        ]);

        // Update data
        $hargaHpp->update($validated);

        return redirect()->route('admin.harga-hpp.index')
            ->with('success', 'Harga HPP berhasil diupdate');
    }

    /**
     * Hapus harga HPP
     */
    public function destroy($id)
    {
        $hargaHpp = HargaHpp::findOrFail($id);

        // Hapus harga HPP
        $hargaHpp->delete();

        return redirect()->route('admin.harga-hpp.index')
            ->with('success', 'Harga HPP berhasil dihapus');
    }
}
