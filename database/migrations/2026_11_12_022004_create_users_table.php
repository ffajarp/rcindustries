<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel users untuk menyimpan data user login
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 50)->unique(); // Username untuk login (required)
            $table->string('password'); // Password (required, akan di-hash)
            $table->string('nama', 100); // Nama lengkap user (required)
            $table->string('telp', 20); // Nomor telepon (required)
            $table->text('alamat')->nullable(); // Alamat user (optional)
            $table->foreignId('role_id')->constrained('roles')->onDelete('restrict'); // Foreign key ke tabel roles
            $table->boolean('is_super_admin')->default(false); // Flag untuk admin super (tidak bisa dihapus)
            $table->timestamps(); // created_at & updated_at otomatis
        });
    }

    /**
     * Menghapus tabel users
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
