<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_models', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('manufacturer_id')->unsigned()->index();
            $table->integer('asset_type_id')->unsigned()->index();
            $table->integer('pcspec_id')->nullable();
            $table->string('asset_model');
            $table->string('part_number')->nullable();
            $table->timestamps();

            $table->foreign('manufacturer_id')->references('id')->on('manufacturers');
            $table->foreign('asset_type_id')->references('id')->on('asset_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('asset_models');
    }
}
