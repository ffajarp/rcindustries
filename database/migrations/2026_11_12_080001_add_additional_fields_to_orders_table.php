<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('no_po', 50)->nullable()->after('id')->unique();
            $table->string('gambar_design')->nullable()->after('brand');
            $table->text('notes')->nullable()->after('estimasi_selesai');
            $table->enum('status_pembayaran', ['lunas', 'dp'])->default('lunas')->after('status');
            $table->decimal('jumlah_dp', 15, 2)->nullable()->after('status_pembayaran');
            $table->decimal('sisa_pembayaran', 15, 2)->nullable()->after('jumlah_dp');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'no_po',
                'gambar_design',
                'notes',
                'status_pembayaran',
                'jumlah_dp',
                'sisa_pembayaran'
            ]);
        });
    }
};
