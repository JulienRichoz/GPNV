<?php

/*
  Last update : 2017.01.19
  Last Update by : Thomas Marcoup
*/

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Classes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('classes', function (Blueprint $table) {
        $table->increments('id')->index();
        $table->string('name', 20);
        $table->string('friendlyId', 20);
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
        Schema::drop('classes');
    }
}
