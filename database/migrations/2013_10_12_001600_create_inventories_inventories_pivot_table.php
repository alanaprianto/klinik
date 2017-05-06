<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesInventoriesPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories_inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tuslahs_id')->unsigned();
            $table->integer('inventories_id')->unsigned();
            $table->foreign('tuslahs_id')->references('id')->on('inventories')->onDelete('cascade');
            $table->foreign('inventories_id')->references('id')->on('inventories')->onDelete('cascade');
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
        Schema::dropIfExists('inventories_inventories');
    }
}
