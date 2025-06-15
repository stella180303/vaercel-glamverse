<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Listsalon extends Model
{
    // $table->string('nama_salon')->nullable();
    // $table->string('gambar')->nullable();
    // $table->longtext('alamat')->nullable();
    // $table->string('jam_buka')->nullable();
    // $table->string('jam_tutup')->nullable();
    // $table->string('hijab_room')->default('yes');
    // $table->string('layanan')->nullable();
    // $table->string('harga')->nullable();
    // $table->string('produk')->nullable();
    // $table->string('aksesibilitas')->nullable();
    // $table->string('pembayaran')->nullable();
    // $table->string('makanan_dan_minuman')->nullable();
    
    use HasFactory;
    
    protected $fillable = [
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
}
