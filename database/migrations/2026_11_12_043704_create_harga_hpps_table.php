<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel harga_hpps untuk master data harga HPP
     */
    public function up(): void
    {
        Schema::create('harga_hpps', function (Blueprint $table) {
            $table->id();
            $table->string('nama_hpp', 100); // Nama HPP (contoh: Kain Cotton, Benang, dll)
            $table->decimal('harga', 15, 2); // Harga HPP (dalam rupiah per pcs)
            $table->timestamps();
        });
    }

    /**
     * Menghapus tabel harga_hpps
     */
    public function down(): void
    {
        Schema::dropIfExists('harga_hpps');
    }
};
