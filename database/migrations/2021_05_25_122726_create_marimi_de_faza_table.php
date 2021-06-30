<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarimiDeFazaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marimi_de_fazas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('nominale_id');
            $table->string('i1f');
            $table->string('i2f');
            $table->string('u1f');
            $table->string('u2f');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marimi_de_fazas');
    }
}
