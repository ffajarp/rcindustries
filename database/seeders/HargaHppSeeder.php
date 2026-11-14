<?php

namespace Database\Seeders;

use App\Models\HargaHpp;
use Illuminate\Database\Seeder;

class HargaHppSeeder extends Seeder
{
    /**
     * Seed data default harga HPP
     * Semua harga dalam satuan /pcs (per pieces)
     */
    public function run(): void
    {
        $hargaHpps = [
            ['nama_hpp' => 'Kain Cotton Combed 20s', 'harga' => 15000],
            ['nama_hpp' => 'Kain Cotton Combed 30s', 'harga' => 18000],
            ['nama_hpp' => 'Kain Polyester', 'harga' => 12000],
            ['nama_hpp' => 'Benang Jahit', 'harga' => 500],
            ['nama_hpp' => 'Kancing Plastik', 'harga' => 200],
            ['nama_hpp' => 'Kancing Kayu', 'harga' => 500],
            ['nama_hpp' => 'Label Merk (Woven)', 'harga' => 1000],
            ['nama_hpp' => 'Label Ukuran', 'harga' => 300],
            ['nama_hpp' => 'Biaya Jahit Kaos', 'harga' => 5000],
            ['nama_hpp' => 'Biaya Jahit Kemeja', 'harga' => 8000],
            ['nama_hpp' => 'Biaya Sablon 1 Warna', 'harga' => 3000],
            ['nama_hpp' => 'Biaya Sablon 2 Warna', 'harga' => 5000],
            ['nama_hpp' => 'Biaya Bordir Kecil', 'harga' => 5000],
            ['nama_hpp' => 'Biaya Bordir Sedang', 'harga' => 8000],
            ['nama_hpp' => 'Plastik Kemasan OPP', 'harga' => 500],
        ];

        foreach ($hargaHpps as $hpp) {
            HargaHpp::create($hpp);
        }
    }
}
