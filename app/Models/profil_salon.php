<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class profil_salon extends Model
{
    use HasFactory;
    // $table->id();
    // $table->string('nama_salon')->nullable();
    // $table->string('gambar')->nullable();
    // $table->longtext('alamat')->nullable();
    // $table->string('jam_buka')->nullable();
    // $table->string('jam_tutup')->nullable();
    // $table->string('hijab_room')->default('yes');
    // $table->string('produk')->nullable();
    // $table->string('aksesibilitas')->nullable();
    // $table->string('pembayaran')->nullable();
    // $table->string('makanan_dan_minuman')->nullable();
    // $table->timestamps();
    protected $fillable = [
        'nama_salon',
        'gambar',
        'alamat',
        'jam_buka',
        'jam_tutup',
        'hijab_room',
        'produk',
        'aksesibilitas',
        'pembayaran',
        'makanan_dan_minuman'
    ];

    public function layanan()
    {
        return $this->hasMany(layanan_salon::class, 'user_id', 'user_id');
    }
}
