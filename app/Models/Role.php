<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    /**
     * Nama tabel yang digunakan oleh model ini
     */
    protected $table = 'roles';

    /**
     * Field yang boleh diisi secara mass assignment
     */
    protected $fillable = [
        'nama_role',
        'deskripsi',
    ];

    /**
     * Relasi one-to-many ke tabel users
     * Satu role bisa dimiliki banyak user
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
