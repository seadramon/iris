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
        Schema::create('iris_f_kehandalans', function (Blueprint $table) {
            $table->id();
            $table->string('no_inventaris', 10);
            $table->date('periode_mulai')->nullable();
            $table->date('periode_selesai')->nullable();
            $table->integer('kehandalan');
            $table->integer('kemudahan_perbaikan');
            $table->integer('kemudahan_sukucadang');
            $table->integer('penggunaan');
            $table->integer('jumlah');
            $table->string('rekomendasi', 100);
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
        Schema::dropIfExists('iris_f_kehandalans');
    }
};
