<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed database dengan data awal
     * Jalankan: php artisan db:seed
     */
    public function run(): void
    {
        // Jalankan seeder berurutan
        $this->call([
            RoleSeeder::class,  // Seed role terlebih dahulu
            UserSeeder::class,  // Kemudian seed user admin super
            CompanySettingSeeder::class, // Seed company settings default
            JenisOrderSeeder::class, // Seed jenis order default
            HargaHppSeeder::class, // Seed harga HPP default
        ]);
    }
}

