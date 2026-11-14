<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_po',
        'nama_pemesan',
        'telepon',
        'brand',
        'gambar_design',
        'jenis_order_id',
        'jumlah',
        'harga_jual',
        'estimasi_selesai',
        'notes',
        'makloon_items',
        'total_harga',
        'total_hpp',
        'laba_bersih',
        'status',
        'status_pembayaran',
        'jumlah_dp',
        'sisa_pembayaran',
        'tanggal_selesai'
    ];

    protected $casts = [
        'makloon_items' => 'array',
        'harga_jual' => 'decimal:2',
        'total_harga' => 'decimal:2',
        'total_hpp' => 'decimal:2',
        'laba_bersih' => 'decimal:2',
        'jumlah_dp' => 'decimal:2',
        'sisa_pembayaran' => 'decimal:2',
        'estimasi_selesai' => 'date',
        'tanggal_selesai' => 'datetime'
    ];

    public function jenisOrder()
    {
        return $this->belongsTo(JenisOrder::class, 'jenis_order_id');
    }

    public function revisions()
    {
        return $this->hasMany(OrderRevision::class);
    }

    public function getMakloonNamesAttribute()
    {
        if (empty($this->makloon_items)) {
            return '-';
        }
        
        $hpps = HargaHpp::whereIn('id', $this->makloon_items)->pluck('nama_hpp');
        return $hpps->implode(', ');
    }

    public function isNearDeadline()
    {
        if (!$this->estimasi_selesai || $this->status == 1) {
            return false;
        }
        
        $today = now()->startOfDay();
        $deadline = $this->estimasi_selesai->startOfDay();
        $diffInDays = $today->diffInDays($deadline, false);
        
        return $diffInDays <= 1 && $diffInDays >= 0;
    }

    /**
     * Generate nomor PO otomatis
     * Format: DMYY/RC/PO/00001
     */
    public static function generateNoPO()
    {
        $date = now();
        $prefix = $date->format('dmy') . '/RC/PO/';
        
        // Cari nomor PO terakhir dengan prefix hari ini
        $lastOrder = self::where('no_po', 'like', $prefix . '%')
            ->orderBy('no_po', 'desc')
            ->first();
        
        if ($lastOrder) {
            // Ambil 5 digit terakhir dan tambah 1
            $lastNumber = (int) substr($lastOrder->no_po, -5);
            $newNumber = $lastNumber + 1;
        } else {
            // Mulai dari 1
            $newNumber = 1;
        }
        
        return $prefix . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
    }
}
