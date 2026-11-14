<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel jenis_orders untuk master data jenis order konveksi
     */
    public function up(): void
    {
        Schema::create('jenis_orders', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jenis', 100)->unique(); // Nama jenis order (unique)
            $table->timestamps();
        });
    }

    /**
     * Menghapus tabel jenis_orders
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_orders');
    }
};
