<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisOrder;
use Illuminate\Http\Request;

class JenisOrderController extends Controller
{
    /**
     * Menampilkan daftar semua jenis order
     */
    public function index()
    {
        $jenisOrders = JenisOrder::orderBy('created_at', 'desc')->get();
        return view('admin.master-data.jenis-order.index', compact('jenisOrders'));
    }

    /**
     * Menampilkan form tambah jenis order baru
     */
    public function create()
    {
        return view('admin.master-data.jenis-order.create');
    }

    /**
     * Menyimpan jenis order baru ke database
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_jenis' => 'required|string|max:100|unique:jenis_orders,nama_jenis',
        ], [
            'nama_jenis.required' => 'Nama jenis order harus diisi',
            'nama_jenis.unique' => 'Nama jenis order sudah digunakan',
            'nama_jenis.max' => 'Nama jenis order maksimal 100 karakter',
        ]);

        // Simpan jenis order baru
        JenisOrder::create($validated);

        return redirect()->route('admin.jenis-order.index')
            ->with('success', 'Jenis order berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit jenis order
     */
    public function edit($id)
    {
        $jenisOrder = JenisOrder::findOrFail($id);
        return view('admin.master-data.jenis-order.edit', compact('jenisOrder'));
    }

    /**
     * Update data jenis order
     */
    public function update(Request $request, $id)
    {
        $jenisOrder = JenisOrder::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'nama_jenis' => 'required|string|max:100|unique:jenis_orders,nama_jenis,' . $id,
        ], [
            'nama_jenis.required' => 'Nama jenis order harus diisi',
            'nama_jenis.unique' => 'Nama jenis order sudah digunakan',
            'nama_jenis.max' => 'Nama jenis order maksimal 100 karakter',
        ]);

        // Update data
        $jenisOrder->update($validated);

        return redirect()->route('admin.jenis-order.index')
            ->with('success', 'Jenis order berhasil diupdate');
    }

    /**
     * Hapus jenis order
     */
    public function destroy($id)
    {
        $jenisOrder = JenisOrder::findOrFail($id);

        // Hapus jenis order
        $jenisOrder->delete();

        return redirect()->route('admin.jenis-order.index')
            ->with('success', 'Jenis order berhasil dihapus');
    }
}
