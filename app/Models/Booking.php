<?php

namespace App\Models;
use App\Models\layanan_salon;
use App\Models\User;
use App\Models\profil_salon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Booking extends Model
{
    protected $fillable = [
        'layanan_id',
        'user_id',
        'nama',
        'nomor_whatsapp',
        'tanggal',
        'jam',
        'metode_pembayaran',
        'transaction_id',
        'order_id',
        'gross_amount',
        'status_layanan',
        'alasan_pembatalan',
        'status_pembatalan',
    ];

    public function layanan()
    {
        return $this->belongsTo(layanan_salon::class, 'layanan_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke salon melalui layanan
    public function salon()
    {
        return $this->hasOneThrough(
            profil_salon::class,
            layanan_salon::class,
            'id',              // Foreign key on layanan_salon table
            'user_id',         // Foreign key on profil_salon table
            'layanan_id',      // Local key on Booking
            'user_id'          // Local key on layanan_salon table
        );
    }   
}
