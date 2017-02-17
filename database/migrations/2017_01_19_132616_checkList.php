<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CheckList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('checkListTables', function (Blueprint $table) {
        $table->increments('id')->index();
        $table->string('name', 45);
      });

      Schema::create('checkListTypes', function(Blueprint $table){
        $table->increments('id')->index();
        $table->string('name',45);
      });

      Schema::create('checkLists', function(Blueprint $table){
        $table->increments('id')->index();
        $table->integer('recordId');
        $table->integer('checkListTable_id')->unsigned();
        $table->integer('checkListType_id')->unsigned();
      });

      Schema::create('checkListItems', function(Blueprint $table){
        $table->increments('id')->index();
        $table->string('title', 45);
        $table->longText('description')->nullable();
        $table->boolean('done');
        $table->integer('checkList_id')->unsigned();
      });

      Schema::table('checkLists', function($table){
        $table->foreign('checkListTable_id')->references('id')->on('checkListTables');
        $table->foreign('checkListType_id')->references('id')->on('checkListTypes');
      });

      Schema::table('checkListItems', function($table){
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
        Schema::drop('checkListItems');
        Schema::drop('checkLists');
        Schema::drop('checkListTypes');
        Schema::drop('checkListTables');
    }
}
