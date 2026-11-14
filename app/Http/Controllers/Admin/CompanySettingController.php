<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanySettingController extends Controller
{
    /**
     * Menampilkan form setting informasi perusahaan
     */
    public function index()
    {
        $setting = CompanySetting::getSettings();
        return view('admin.company-settings.index', compact('setting'));
    }

    /**
     * Update atau create setting informasi perusahaan
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:100',
            'telepon.*' => 'required|string|max:20',
            'alamat' => 'required|string',
            'rekening_bank.*' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,jpg,png,svg|max:2048',
            'template_wa' => 'nullable|string',
        ], [
            'nama_perusahaan.required' => 'Nama perusahaan harus diisi',
            'telepon.*.required' => 'Telepon harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'rekening_bank.*.required' => 'Rekening bank harus diisi',
            'logo.image' => 'File harus berupa gambar',
            'logo.mimes' => 'Format logo harus jpeg, jpg, png, atau svg',
            'logo.max' => 'Ukuran logo maksimal 2MB',
        ]);

        // Cek apakah sudah ada setting
        $setting = CompanySetting::first();

        // Proses upload logo jika ada
        $logoPath = $setting ? $setting->logo : null;
        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($logoPath && Storage::disk('public')->exists($logoPath)) {
                Storage::disk('public')->delete($logoPath);
            }
            
            // Upload logo baru
            $logoPath = $request->file('logo')->store('company-logo', 'public');
        }

        // Data yang akan disimpan
        $data = [
            'nama_perusahaan' => $validated['nama_perusahaan'],
            'telepon' => array_filter($request->telepon), // Hapus array kosong
            'alamat' => $validated['alamat'],
            'rekening_bank' => array_filter($request->rekening_bank), // Hapus array kosong
            'logo' => $logoPath,
        ];

        // Tambahkan template_wa jika ada di request (untuk backward compatibility)
        if ($request->has('template_wa')) {
            $data['template_wa'] = $request->template_wa;
        }

        if ($setting) {
            // Update existing
            $setting->update($data);
            $message = 'Setting perusahaan berhasil diupdate';
        } else {
            // Create new
            CompanySetting::create($data);
            $message = 'Setting perusahaan berhasil disimpan';
        }

        return redirect()->route('admin.company-settings.index')
            ->with('success', $message);
    }
}
