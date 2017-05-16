<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type')->nullable();
            $table->string('number_transaction')->nullable();
            $table->double('amount')->nullable();
            $table->integer('status')->nullable();
            $table->double('price')->nullable();
            $table->longText('other')->nullable();
            $table->double('sub_total')->nullable();
            $table->float('tax')->nullable();
            $table->text('shipping')->nullable();
            $table->text('shipping_terms')->nullable();
            $table->integer('from_depo_id')->nullable()->unsigned();
            $table->integer('to_depo_id')->nullable()->unsigned();
            $table->integer('staff_id')->nullable()->unsigned();
            $table->integer('distributor_id')->nullable()->unsigned();
            $table->integer('patient_id')->nullable()->unsigned();
            $table->foreign('from_depo_id')->references('id')->on('depos')->onDelete('cascade');
            $table->foreign('to_depo_id')->references('id')->on('depos')->onDelete('cascade');
            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
            $table->foreign('distributor_id')->references('id')->on('distributors')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
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
        Schema::dropIfExists('transactions');
    }
}
