<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel user_menu_access untuk menyimpan setting menu per user
     */
    public function up(): void
    {
        Schema::create('user_menu_access', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key ke tabel users
            $table->string('menu_name', 50); // Nama menu yang bisa diakses
            $table->timestamps(); // created_at & updated_at otomatis
            
            // Kombinasi user_id dan menu_name harus unik
            $table->unique(['user_id', 'menu_name']);
        });
    }

    /**
     * Menghapus tabel user_menu_access
     */
    public function down(): void
    {
        Schema::dropIfExists('user_menu_access');
    }
};
