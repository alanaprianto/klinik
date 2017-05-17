<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->double('stock')->nullable();
            $table->double('total_stock')->nullable();
            $table->double('stock_minimal')->nullable();
            $table->double('stock_maximal')->nullable();
            $table->string('unit')->nullable();
            $table->double('price')->nullable();
            $table->double('stock_on_hold')->nullable();
            $table->integer('depo_id')->nullable()->unsigned();
            $table->foreign('depo_id')->references('id')->on('depos')->onDelete('cascade');
            $table->integer('inventory_id')->nullable()->unsigned();
            $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');
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
        Schema::dropIfExists('stocks');
    }
}
