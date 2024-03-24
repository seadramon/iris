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
        Schema::create('iris_setup_cetakans', function (Blueprint $table) {
            $table->id();
            $table->string('kd_jalur', 10)->nullable();
            $table->string('kd_pat', 10)->nullable();
            $table->string('kd_cetakan', 30)->nullable();
            $table->string('type', 200)->nullable();
            $table->string('ra', 10)->nullable();
            $table->string('ri', 10)->nullable();
            $table->string('sisa', 10)->nullable();
            $table->date('tgl_pemakaian')->nullable();
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
        Schema::dropIfExists('iris_setup_cetakans');
    }
};
