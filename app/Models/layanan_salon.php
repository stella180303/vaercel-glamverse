<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\profil_salon;

class layanan_salon extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'nama_layanan',
        'deskripsi_layanan',
        'harga',
        'gambar',
        'hari_tersedia',
        'jam_tersedia',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profil_salon()
    {
        return $this->belongsTo(profil_salon::class, 'user_id', 'user_id');
    }
}

