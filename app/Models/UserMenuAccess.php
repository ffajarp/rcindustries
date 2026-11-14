<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserMenuAccess extends Model
{
    /**
     * Nama tabel yang digunakan oleh model ini
     */
    protected $table = 'user_menu_access';

    /**
     * Field yang boleh diisi secara mass assignment
     */
    protected $fillable = [
        'user_id',
        'menu_name',
    ];

    /**
     * Relasi many-to-one ke tabel users
     * Setiap menu access dimiliki oleh satu user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
