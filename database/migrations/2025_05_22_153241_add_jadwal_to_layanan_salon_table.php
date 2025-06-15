<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('layanan_salons', function (Blueprint $table) {
            $table->json('hari_tersedia')->nullable();
            $table->json('jam_tersedia')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('layanan_salons', function (Blueprint $table) {
            //
        });
    }
};
