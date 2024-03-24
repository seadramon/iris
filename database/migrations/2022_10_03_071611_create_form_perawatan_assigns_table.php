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
        Schema::create('iris_c_perawatan_assigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('c_perawatan_id')->constrained('iris_c_perawatans');
            $table->string('kd_pat', 10);
            $table->date('periode_awal')->nullable();
            $table->date('periode_akhir')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('iris_checklists', function (Blueprint $table) {
            $table->foreignId('assign_id')->nullable()->constrained('iris_c_perawatan_assigns');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iris_checklists', function (Blueprint $table) {
            $table->dropColumn(['assign_id']);
        });

        Schema::dropIfExists('iris_c_perawatan_assigns');

    }
};
