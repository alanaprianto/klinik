<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number_medical_record')->nullable();
            $table->string('full_name')->nullable();
            $table->string('place')->nullable();
            $table->timestamp('birth')->nullable();
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->text('address')->nullable();
            $table->string('religion')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('sub_district')->nullable();
            $table->text('rt_rw')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('last_education')->nullable();
            $table->string('job')->nullable();
            $table->string('responsible_person')->nullable();
            $table->string('responsible_person_state')->nullable();
            $table->string('askes_number')->nullable();
            $table->text('cause_pain')->nullable();
            $table->string('how_visit')->nullable();
            $table->time('time_attend')->nullable();
            $table->string('service_type')->nullable();
            $table->text('first_diagnose')->nullable();
            $table->integer('hospital_id')->unsigned()->nullable();
            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
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
        Schema::dropIfExists('patients');
    }
}
