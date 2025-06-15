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
            Schema::create('profil_salons', function (Blueprint $table) {
                $table->id();
                $table->string('nama_salon')->nullable();
                $table->string('gambar')->nullable();
                $table->longtext('alamat')->nullable();
                $table->string('jam_buka')->nullable();
                $table->string('jam_tutup')->nullable();
                $table->string('hijab_room')->default('yes');
                $table->string('produk')->nullable();
                $table->string('aksesibilitas')->nullable();
                $table->string('pembayaran')->nullable();
                $table->string('makanan_dan_minuman')->nullable();
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('profil_salons');
        }
    };
