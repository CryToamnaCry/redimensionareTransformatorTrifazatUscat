<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMiezFeromagneticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('miez_feromagnetics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nominale_id')->references('id')->on('date_nominales')->onDelete('cascade');
            $table->string('PjT_W');
            $table->string('TrepteColoana_a_mm');
            $table->string('TrepteJug_b_mm');
            $table->string('Bc_T');
            $table->string('Bjug_T');
            $table->string('H_mm');
            $table->string('L_mm');
            $table->string('Mcol_kg');
            $table->string('Mjug_kg');
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
        Schema::dropIfExists('miez_feromagnetics');
    }
}
