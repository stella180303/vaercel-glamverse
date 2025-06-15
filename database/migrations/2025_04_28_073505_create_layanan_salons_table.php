<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    //  'nama_layanan',
    //     'deskripsi_layanan',
    //     'harga'
    public function up(): void
    {
        Schema::create('layanan_salons', function (Blueprint $table) {
            $table->id();            
            $table->string('nama_layanan')->nullable();
            $table->longtext('deskripsi_layanan')->nullable();
            $table->string('harga')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan_salons');
    }
};
