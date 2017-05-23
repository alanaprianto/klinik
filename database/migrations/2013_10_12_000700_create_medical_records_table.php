<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity')->nullable();
            $table->text('notes')->nullable();
            $table->string('type')->nullable();
            $table->text('anamnesa')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('explain')->nullable();
            $table->text('therapy')->nullable();
            $table->longText('icd10')->nullable();
            $table->integer('reference_id')->unsigned()->nullable();
            $table->foreign('reference_id')->references('id')->on('references')->onDelete('cascade');
            $table->integer('patient_id')->unsigned()->nullable();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->integer('service_id')->unsigned()->nullable();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->integer('inventory_id')->unsigned()->nullable();
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
        Schema::dropIfExists('medical_records');
    }
}
