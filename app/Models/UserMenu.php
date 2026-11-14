<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMenu extends Model
{
    use HasFactory;

    /**
     * Kolom yang bisa diisi mass assignment
     */
    protected $fillable = [
        'user_id',
        'menu_name',
    ];

    /**
     * Relasi ke tabel users
     * Setiap menu permission dimiliki oleh satu user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
