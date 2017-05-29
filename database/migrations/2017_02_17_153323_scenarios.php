<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Scenarios extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('mockups', function (Blueprint $table) {
      $table->increments('id')->index();
      $table->integer('project_id')->unsigned();
      $table->string('url', 500);
    });

    Schema::create('scenarios', function (Blueprint $table) {
      $table->increments('id')->index();
      $table->string('description', 500)->nullable();
      $table->string('name', 200);
      $table->boolean('actif')->default(0);
      $table->integer('checkList_item_id')->unsigned();
    });

    Schema::create('steps', function (Blueprint $table) {
      $table->increments('id')->index();
      $table->string('action', 1000);
      $table->string('result', 1000);
      $table->integer('order');
      $table->integer('scenario_id')->unsigned();
      $table->integer('mockup_id')->unsigned()->nullable();
    });

    Schema::create('scenario_tests', function (Blueprint $table) {
      $table->increments('id')->index();
      $table->dateTime('date');
      $table->string('resume', 500)->nullable();
      $table->boolean('done')->nullable();
      $table->integer('user_id')->unsigned();
    });

    Schema::create('step_test_results', function (Blueprint $table) {
      $table->increments('id')->index();
      $table->integer('step_id')->unsigned();
      $table->integer('test_id')->unsigned();
      $table->string('result', 1000);
      $table->integer('succes')->default(-1);
    });

    Schema::table('scenarios', function($table){
      $table->foreign('checkList_item_id')->references('id')->on('checkList_Items');
    });
    Schema::table('steps', function($table){
      $table->foreign('scenario_id')->references('id')->on('scenarios');
      $table->foreign('mockup_id')->references('id')->on('mockups');
    });
    Schema::table('mockups', function($table){
      $table->foreign('project_id')->references('id')->on('projects');
    });
    Schema::table('step_test_results', function($table){
      $table->foreign('step_id')->references('id')->on('steps');
      $table->foreign('test_id')->references('id')->on('scenario_tests');
    });
    Schema::table('scenario_tests', function($table){
      $table->foreign('user_id')->references('id')->on('users');
    });

  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('step_test_results');
        Schema::drop('scenario_tests');
        Schema::drop('steps');
        Schema::drop('mockups');
        Schema::drop('scenarios');
    }
}
