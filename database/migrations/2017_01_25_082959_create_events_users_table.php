<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_users', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->integer('user_id')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('events_users', function($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('event_id')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events_users');
    }
}
