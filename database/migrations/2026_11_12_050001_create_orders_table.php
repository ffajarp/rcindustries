<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemesan');
            $table->string('telepon');
            $table->string('brand')->nullable();
            $table->foreignId('jenis_order_id')->constrained('jenis_orders')->onDelete('cascade');
            $table->integer('jumlah');
            $table->decimal('harga_jual', 15, 2);
            $table->date('estimasi_selesai')->nullable();
            $table->json('makloon_items')->nullable(); // Array of harga_hpp_id yang dicentang
            $table->decimal('total_harga', 15, 2);
            $table->decimal('total_hpp', 15, 2);
            $table->decimal('laba_bersih', 15, 2);
            $table->tinyInteger('status')->default(0); // 0=berjalan, 1=selesai
            $table->timestamp('tanggal_selesai')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
