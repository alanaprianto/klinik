<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depos', function (Blueprint $table) {
            $table->increments('id');
            $table->double('amount')->nullable();
            $table->integer('total')->nullable();
            $table->double('stock_minimal')->nullable();
            $table->double('stock_maximal')->nullable();
            $table->string('unit')->nullable();
            $table->double('stock_on_hold')->nullable();
            $table->integer('poly_id')->nullable()->unsigned();
            $table->foreign('poly_id')->references('id')->on('polies')->onDelete('cascade');
            $table->integer('parent_id')->nullable()->unsigned();
            $table->foreign('parent_id')->references('id')->on('depos')->onDelete('cascade');
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
        Schema::dropIfExists('depos');
    }
}
