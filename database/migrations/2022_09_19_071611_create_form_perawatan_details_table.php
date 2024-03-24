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
        Schema::create('iris_c_perawatan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('c_perawatan_id')->constrained('iris_c_perawatans');
            $table->string('nama', 200);
            $table->string('parameter', 100);
            $table->string('jenis', 30);
            $table->string('pilihan', 100)->nullable();
            $table->string('foto_needed', 1)->default('0');
            $table->string('keterangan_needed', 1)->default('0');
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
        Schema::dropIfExists('iris_c_perawatan_details');
    }
};
