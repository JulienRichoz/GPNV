<?php

/*
  Last update : 2017.01.19
  Last Update by : Thomas Marcoup
*/


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class States extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::create('states', function (Blueprint $table) {
           $table->increments('id')->index();
           $table->string('name', 20);
       });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::drop('states');
     }
}
