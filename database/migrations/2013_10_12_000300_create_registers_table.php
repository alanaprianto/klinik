<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('register_number')->nullable();
            $table->integer('status')->nullable();
            $table->text('notes')->nullable();
            $table->string('responsible_person')->nullable();
            $table->string('responsible_person_state')->nullable();
            $table->text('cause_pain')->nullable();
            $table->string('how_visit')->nullable();
            $table->time('time_attend')->nullable();
            $table->string('service_type')->nullable();
            $table->text('first_diagnose')->nullable();
            $table->integer('payment_status')->nullable();
            $table->integer('patient_id')->unsigned()->nullable();
            $table->integer('staff_id')->unsigned()->nullable();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
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
        Schema::dropIfExists('registers');
    }
}
