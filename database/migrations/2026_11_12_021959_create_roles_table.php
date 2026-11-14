<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel roles untuk menyimpan data master role user
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('nama_role', 50)->unique(); // Nama role (Admin Super, Admin, Pegawai)
            $table->text('deskripsi')->nullable(); // Deskripsi role
            $table->timestamps(); // created_at & updated_at otomatis
        });
    }

    /**
     * Menghapus tabel roles
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
