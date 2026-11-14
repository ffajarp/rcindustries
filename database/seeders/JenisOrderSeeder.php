<?php

namespace Database\Seeders;

use App\Models\JenisOrder;
use Illuminate\Database\Seeder;

class JenisOrderSeeder extends Seeder
{
    /**
     * Seed data default jenis order konveksi
     */
    public function run(): void
    {
        $jenisOrders = [
            ['nama_jenis' => 'Full Order'],
            ['nama_jenis' => 'Makloon Jahit'],
            ['nama_jenis' => 'Makloon Sablon'],
            ['nama_jenis' => 'Sublime'],
            ['nama_jenis' => 'Sublime + Bahan'],
        ];

        foreach ($jenisOrders as $jenis) {
            JenisOrder::create($jenis);
        }
    }
}
