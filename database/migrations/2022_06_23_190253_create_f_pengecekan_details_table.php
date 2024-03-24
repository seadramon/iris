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
        Schema::create('iris_f_pengecekan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengecekan_id')->constrained('iris_f_pengecekans');
            $table->string('item', 100)->nullable();
            $table->string('parameter', 100)->nullable();
            $table->string('nilai', 30)->nullable();
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
        Schema::dropIfExists('iris_f_pengecekan_details');
    }
};
