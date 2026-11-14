<?php

namespace Database\Seeders;

use App\Models\CompanySetting;
use Illuminate\Database\Seeder;

class CompanySettingSeeder extends Seeder
{
    /**
     * Seed default company settings
     */
    public function run(): void
    {
        CompanySetting::create([
            'nama_perusahaan' => 'RC Cloth',
            'telepon' => ['08123456789', '08234567890'],
            'alamat' => 'Jl. Contoh No. 123, Jakarta Selatan, DKI Jakarta 12345',
            'rekening_bank' => [
                'BCA - 1234567890 - RC Cloth',
                'Mandiri - 9876543210 - RC Cloth',
            ],
            'logo' => null, // Bisa diisi manual lewat form
            'template_wa' => 'Halo {nama_pemesan}, terima kasih telah memesan di {nama_perusahaan}. Berikut invoice order Anda: {link_invoice}',
        ]);
    }
}
