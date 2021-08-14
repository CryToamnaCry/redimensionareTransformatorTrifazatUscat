<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDimensionareJTSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dimensionare_j_t_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nominale_id')->references('id')->on('date_nominales')->onDelete('cascade');
            $table->string('PjT_W');
            $table->string('Dmj_mm');
            $table->string('Lmed_m');
            $table->string('aj_mm');
            $table->string('Rjt_ohm');
            $table->string('qjT_Wperm2');
            $table->string('spireStrat');
            $table->string('nrStraturi');
            $table->string('HBj_m');
            $table->string('wj');
            $table->string('msg');
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
        Schema::dropIfExists('dimensionare_j_t_s');
    }
}
