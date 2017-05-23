<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('references', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number_reference')->nullable()->unique();
            $table->integer('status')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_checked')->default(0);
            $table->integer('payment_status')->nullable();
            $table->double('reference_total_payment')->nullable();
            $table->timestamp('check_in')->nullable();
            $table->timestamp('check_out')->nullable();
            $table->integer('register_id')->unsigned()->nullable();
            $table->foreign('register_id')->references('id')->on('registers')->onDelete('cascade');
            $table->integer('poly_id')->unsigned()->nullable();
            $table->foreign('poly_id')->references('id')->on('polies')->onDelete('cascade');
            $table->integer('staff_id')->unsigned()->nullable();
            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
            $table->integer('room_id')->unsigned()->nullable();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->integer('class_room_id')->unsigned()->nullable();
            $table->foreign('class_room_id')->references('id')->on('class_rooms')->onDelete('cascade');
            $table->integer('bed_id')->unsigned()->nullable();
            $table->foreign('bed_id')->references('id')->on('beds')->onDelete('cascade');
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
        Schema::dropIfExists('references');
    }
}
