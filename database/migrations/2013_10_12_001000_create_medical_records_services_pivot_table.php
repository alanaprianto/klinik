<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalRecordsServicesPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_records_services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('services_id')->unsigned();
            $table->integer('medical_records_id')->unsigned();
            $table->foreign('services_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('medical_records_id')->references('id')->on('medical_records')->onDelete('cascade');
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
        Schema::dropIfExists('medical_records_services');
    }
}
