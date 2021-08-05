<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePredeterminareSectiuneConductorJTSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('predeterminare_sectiune_conductor_j_t_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nominale_id')->references('id')->on('date_nominales')->onDelete('cascade');
            $table->string('PjT_W');
            $table->string('RjT_ohm');
            $table->string('Dmj_mm');
            $table->string('Lmed_mm');
            $table->string('scond_mm2');
            $table->string('dc_calc_mm');
            $table->string('aj_mm');
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
        Schema::dropIfExists('predeterminare_sectiune_conductor_j_t_s');
    }
}
