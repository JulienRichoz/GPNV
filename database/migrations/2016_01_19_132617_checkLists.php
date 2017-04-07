<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class checkLists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('checkList_Tables', function (Blueprint $table) {
        $table->increments('id')->index();
        $table->string('name', 45);
      });

      Schema::create('checkList_Types', function(Blueprint $table){
        $table->increments('id')->index();
        $table->string('name',45);
      });

      Schema::create('checkLists', function(Blueprint $table){
        $table->increments('id')->index();
        $table->integer('recordId');
        $table->integer('checkListTable_id')->unsigned();
        $table->integer('checkListType_id')->unsigned();
      });

      Schema::create('checkList_Items', function(Blueprint $table){
        $table->increments('id')->index();
        $table->string('title', 45);
        $table->longText('description')->nullable();
        $table->boolean('done');
        $table->integer('checkList_id')->unsigned();
      });

      Schema::table('checkLists', function($table){
        $table->foreign('checkListTable_id')->references('id')->on('checkList_Tables');
        $table->foreign('checkListType_id')->references('id')->on('checkList_Types');
      });

      Schema::table('checkList_Items', function($table){
        $table->foreign('checkList_id')->references('id')->on('checkLists');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('checkList_Items');
        Schema::drop('checkLists');
        Schema::drop('checkList_Types');
        Schema::drop('checkList_Tables');
    }
}
