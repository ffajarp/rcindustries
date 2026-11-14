<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel company_settings untuk menyimpan informasi perusahaan
     */
    public function up(): void
    {
        Schema::create('company_settings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan', 100); // Nama perusahaan
            $table->json('telepon'); // Array telepon/wa (bisa lebih dari 1)
            $table->text('alamat'); // Alamat perusahaan
            $table->json('rekening_bank'); // Array no rekening (bisa lebih dari 1)
            $table->string('logo')->nullable(); // Path logo perusahaan
            $table->timestamps();
        });
    }

    /**
     * Menghapus tabel company_settings
     */
    public function down(): void
    {
        Schema::dropIfExists('company_settings');
    }
};
