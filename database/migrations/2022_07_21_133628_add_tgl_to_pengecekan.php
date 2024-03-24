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
        Schema::table('iris_f_pengecekans', function (Blueprint $table) {
            $table->date('periode_mulai')->nullable();
            $table->date('periode_selesai')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iris_f_pengecekans', function (Blueprint $table) {
            $table->dropColumn(['periode_mulai', 'periode_selesai']);
        });
    }
};
