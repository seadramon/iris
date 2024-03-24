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
        Schema::create('iris_alat_details', function (Blueprint $table) {
            $table->id();
            $table->string('no_inventaris', 30);
            $table->string('sertifikat_no', 50)->nullable();
            $table->string('sertifikat_tahun', 6)->nullable();
            $table->string('sertifikat_path')->nullable();
            $table->string('foto1_path')->nullable();
            $table->string('foto2_path')->nullable();
            $table->string('foto3_path')->nullable();
            $table->string('foto4_path')->nullable();
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
        Schema::dropIfExists('iris_alat_details');
    }
};

