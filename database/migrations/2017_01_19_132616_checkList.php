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
      Schema::create('CheckListTables', function (Blueprint $table) {
        $table->increments('id')->index();
        $table->string('name', 45);
      });

      Schema::create('CheckListTypes', function(Blueprint $table){
        $table->increments('id')->index();
        $table->string('name',45);
      });

      Schema::create('CheckListLinkedTo', function(Blueprint $table){
        $table->increments('id')->index();
        $table->integer('recordId');
        $table->integer('fkTable')->unsigned();
        $table->integer('fkType')->unsigned();
      });

      Schema::create('CheckListItems', function(Blueprint $table){
        $table->increments('id')->index();
        $table->string('title', 45);
        $table->longText('description')->nullable();
        $table->boolean('done');
        $table->integer('fkLinkedTo')->unsigned();
      });

      Schema::table('CheckListLinkedTo', function($table){
        $table->foreign('fkTable')->references('id')->on('CheckListTables');
        $table->foreign('fkType')->references('id')->on('CheckListTypes');
      });

      Schema::table('CheckListItems', function($table){
        $table->foreign('fkLinkedTo')->references('id')->on('CheckListLinkedTo');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('CheckListItems');
        Schema::drop('CheckListLinkedTo');
        Schema::drop('CheckListTypes');
        Schema::drop('CheckListTables');
    }
}
