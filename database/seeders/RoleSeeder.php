<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Seed data master role
     * Membuat 3 role: Admin, Pegawai, dan Owner
     */
    public function run(): void
    {
        $roles = [
            [
                'nama_role' => 'Admin',
                'deskripsi' => 'Administrator dengan akses penuh untuk mengelola sistem',
            ],
            [
                'nama_role' => 'Pegawai',
                'deskripsi' => 'Pegawai dengan akses terbatas sesuai menu yang diberikan',
            ],
            [
                'nama_role' => 'Owner',
                'deskripsi' => 'Pemilik usaha dengan akses untuk melihat laporan dan data penting',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
