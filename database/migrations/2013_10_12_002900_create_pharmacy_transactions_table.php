<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePharmacyTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacy_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amount')->nullable();
            $table->double('total_payment')->nullable();
            $table->integer('status')->nullable();
            $table->integer('type')->nullable();
            $table->float('discount')->nullable();
            $table->float('subsidy')->nullable();
            $table->float('tax')->nullable();
            $table->integer('staff_id')->nullable()->unsigned();
            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
            $table->integer('pharmacy_id')->nullable()->unsigned();
            $table->foreign('pharmacy_id')->references('id')->on('pharmacies')->onDelete('cascade');
            $table->integer('distributor_id')->nullable()->unsigned();
            $table->foreign('distributor_id')->references('id')->on('distributors')->onDelete('cascade');
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
        Schema::dropIfExists('pharmacy_transactions');
    }
}
