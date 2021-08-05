<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePredimensionareColoanasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('predimensionare_coloanas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nominale_id')->references('id')->on('date_nominales')->onDelete('cascade');
            $table->string('sc_VA');
            $table->string('usca');
            $table->string('uscr');
            $table->string('km');
            $table->string('al_cm');
            $table->string('sum_ajai_cm');
            $table->string('BC');
            $table->string('D_m');
            $table->string('AC_mp');           
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
        Schema::dropIfExists('predimensionare_coloanas');
    }
}
