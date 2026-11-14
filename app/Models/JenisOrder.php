<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisOrder extends Model
{
    /**
     * Nama tabel yang digunakan oleh model ini
     */
    protected $table = 'jenis_orders';

    /**
     * Field yang boleh diisi secara mass assignment
     */
    protected $fillable = [
        'nama_jenis',
    ];
}
