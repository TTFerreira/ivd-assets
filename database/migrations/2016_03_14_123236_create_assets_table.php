<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('asset_tag')->unique()->index();
            $table->string('serial_number')->nullable();
            $table->integer('model_id')->unsigned()->index();
            $table->integer('division_id')->unsigned()->index();
            $table->integer('supplier_id')->unsigned()->index();
            $table->integer('movement_id')->nullable()->index();
            $table->date('purchase_date')->nullable();
            $table->integer('warranty_months')->nullable();
            $table->integer('warranty_type_id')->nullable();
            $table->integer('invoice_id')->nullable();
            $table->timestamps();

            $table->foreign('model_id')->references('id')->on('asset_models');
            $table->foreign('division_id')->references('id')->on('divisions');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('assets');
    }
}
