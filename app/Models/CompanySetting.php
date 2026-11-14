<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    /**
     * Nama tabel yang digunakan oleh model ini
     */
    protected $table = 'company_settings';

    /**
     * Field yang boleh diisi secara mass assignment
     */
    protected $fillable = [
        'nama_perusahaan',
        'telepon',
        'alamat',
        'rekening_bank',
        'logo',
        'template_wa',
    ];

    /**
     * Casting tipe data untuk field JSON
     */
    protected $casts = [
        'telepon' => 'array',
        'rekening_bank' => 'array',
    ];

    /**
     * Helper method untuk mendapatkan setting perusahaan
     * Jika belum ada, return default
     */
    public static function getSettings()
    {
        $settings = self::first();
        
        if (!$settings) {
            // Return default jika belum ada setting
            return (object) [
                'nama_perusahaan' => 'RC Cloth',
                'telepon' => ['08123456789'],
                'alamat' => 'Alamat Perusahaan',
                'rekening_bank' => ['BCA - 1234567890 - RC Cloth'],
                'logo' => null,
                'template_wa' => 'Halo {nama_pemesan}, terima kasih telah memesan di {nama_perusahaan}. Berikut invoice order Anda: {link_invoice}',
            ];
        }
        
        return $settings;
    }
}
