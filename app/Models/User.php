<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Nama tabel yang digunakan oleh model ini
     */
    protected $table = 'users';

    /**
     * Field yang boleh diisi secara mass assignment
     */
    protected $fillable = [
        'username',
        'password',
        'nama',
        'telp',
        'alamat',
        'role_id',
        'is_super_admin',
    ];

    /**
     * Field yang harus disembunyikan saat serialisasi
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Casting tipe data untuk field tertentu
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed', // Otomatis hash password saat disimpan
            'is_super_admin' => 'boolean',
        ];
    }

    /**
     * Relasi many-to-one ke tabel roles
     * Setiap user memiliki satu role
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Relasi one-to-many ke tabel user_menu_access
     * Satu user bisa punya banyak menu access
     */
    public function menuAccess(): HasMany
    {
        return $this->hasMany(UserMenuAccess::class, 'user_id');
    }

    /**
     * Helper method untuk cek apakah user punya akses ke menu tertentu
     * 
     * @param string $menuName Nama menu yang ingin dicek
     * @return bool True jika user punya akses
     */
    public function hasMenuAccess(string $menuName): bool
    {
        // Admin super punya akses ke semua menu
        if ($this->is_super_admin) {
            return true;
        }

        // Cek di tabel user_menu_access
        return $this->menuAccess()->where('menu_name', $menuName)->exists();
    }
}
