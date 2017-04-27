<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesDeposPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories_depos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inventories_id')->unsigned();
            $table->integer('depos_id')->unsigned();
            $table->foreign('inventories_id')->references('id')->on('inventories')->onDelete('cascade');
            $table->foreign('depos_id')->references('id')->on('depos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories_depos');
    }
}
