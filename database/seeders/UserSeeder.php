<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed user admin default
     * Username: admin
     * Password: admin123
     */
    public function run(): void
    {
        // Ambil role Admin
        $adminRole = Role::where('nama_role', 'Admin')->first();

        // Buat user admin default dengan flag super admin
        User::create([
            'username' => 'admin',
            'password' => 'admin123', // Akan otomatis di-hash karena cast 'hashed'
            'nama' => 'Administrator',
            'telp' => '08123456789',
            'alamat' => 'Kantor Pusat',
            'role_id' => $adminRole->id,
            'is_super_admin' => true, // Flag ini mencegah user dihapus
        ]);
    }
}
