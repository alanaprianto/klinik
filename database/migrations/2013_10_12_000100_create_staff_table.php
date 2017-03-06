<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {

            $table->increments('id');
            $table->string('nik')->nullable();
            $table->string('full_name')->nullable();
            $table->string('place')->nullable();
            $table->timestamp('birth')->nullable();
            $table->string('age')->nullable();
            $table->text('address')->nullable();
            $table->string('religion')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('sub_district')->nullable();
            $table->text('rt_rw')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('last_education')->nullable();
            $table->enum('gender', ['male','female']);
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('hospital_id')->unsigned()->nullable();
            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
            $table->integer('staff_job_id')->unsigned()->nullable();
            $table->foreign('staff_job_id')->references('id')->on('staff_jobs')->onDelete('cascade');
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
        Schema::dropIfExists('staff');
    }
}
