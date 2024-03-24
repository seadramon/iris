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
        Schema::create('iris_f_perawatans', function (Blueprint $table) {
            $table->id();
            $table->string('no_inventaris', 10);
            $table->string('pemeriksaan', 255)->nullable();
            $table->string('pemeriksaan_hasil', 255)->nullable();
            $table->string('penanganan', 255)->nullable();
            $table->string('suku_cadang', 400)->nullable();
            $table->string('catatan', 400)->nullable();
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
        Schema::dropIfExists('iris_f_perawatans');
    }
};
