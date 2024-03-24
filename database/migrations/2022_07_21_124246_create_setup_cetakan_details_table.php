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
        Schema::create('iris_setup_cetakan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('setup_id')->constrained('iris_setup_cetakans');
            $table->string('no_inventaris', 100)->nullable();
            $table->date('tgl_selesai')->nullable();
            $table->string('qa', 50)->nullable();
            $table->string('keterangan', 200)->nullable();
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
        Schema::dropIfExists('iris_setup_cetakan_details');
    }
};
