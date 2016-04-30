<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('location_id')->unsigned()->index();
            $table->integer('ticket_status_id')->unsigned()->index();
            $table->integer('ticket_type_id')->unsigned()->index();
            $table->integer('ticket_priority_id')->unsigned()->index();
            $table->string('subject');
            $table->text('description');
            $table->dateTime('closed')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('ticket_status_id')->references('id')->on('tickets_statuses');
            $table->foreign('ticket_type_id')->references('id')->on('tickets_types');
            $table->foreign('ticket_priority_id')->references('id')->on('tickets_priorities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tickets');
    }
}
