<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iris_f_perbaikans', function (Blueprint $table) {
            $table->id();
            $table->string('no_inventaris', 10);
            $table->string('kerusakan', 255)->nullable();
            $table->string('penyebab', 255)->nullable();
            $table->string('penanganan', 255)->nullable();
            $table->date('waktu_kerusakan')->nullable();
            $table->string('kerusakan_path', 255)->nullable();
            $table->string('prediksi_teknisi', 50)->nullable();
            $table->string('estimasi_teknisi', 10)->nullable();
            $table->string('perbaikan', 255)->nullable();
            $table->string('suku_cadang', 400)->nullable();
            $table->string('catatan', 400)->nullable();
            $table->date('perbaikan_mulai')->nullable();
            $table->date('perbaikan_selesai')->nullable();
            $table->string('mengganggu', 10)->nullable();
            $table->string('perbaikan_path', 255)->nullable();
            $table->string('status', 30)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('iris_f_perbaikans');
    }
};
