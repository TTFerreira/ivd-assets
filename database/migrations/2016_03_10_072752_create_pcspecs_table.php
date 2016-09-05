<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePcspecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcspecs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cpu', 100);
            $table->string('ram', 10);
            $table->string('hdd', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pcspecs');
    }
}
