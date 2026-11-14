<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HargaHpp extends Model
{
    /**
     * Nama tabel yang digunakan oleh model ini
     */
    protected $table = 'harga_hpps';

    /**
     * Field yang boleh diisi secara mass assignment
     */
    protected $fillable = [
        'nama_hpp',
        'harga',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'harga' => 'decimal:2',
    ];
}
