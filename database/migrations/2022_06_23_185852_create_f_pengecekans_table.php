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
        Schema::create('iris_f_pengecekans', function (Blueprint $table) {
            $table->id();
            $table->string('no_inventaris', 10);
            $table->string('jenis', 50)->nullable();
            $table->string('tahun', 4)->nullable();
            $table->string('periode', 50)->nullable();
            $table->integer('periode_counter')->nullable();
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
        Schema::dropIfExists('iris_f_pengecekans');
    }
};
