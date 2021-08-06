<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDimensionareITSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dimensionare_i_t_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nominale_id')->references('id')->on('date_nominales')->onDelete('cascade');
            $table->string('RiT_ohm');
            $table->string('Dmi_mm');
            $table->string('Lmed_mm');
            $table->string('PiT_W');
            $table->string('qiT_Wperm2');
            $table->string('HBi_m');
            $table->string('wi');
            $table->string('E');
            $table->string('wiTotal');
            $table->string('nrSpire');
            $table->string('nrStraturi');
            $table->string('ai_mm');
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
        Schema::dropIfExists('dimensionare_i_t_s');
    }
}
