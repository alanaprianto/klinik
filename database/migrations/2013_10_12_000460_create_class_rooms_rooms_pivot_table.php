<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassRoomsRoomsPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_rooms_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rooms_id')->unsigned();
            $table->integer('class_rooms_id')->unsigned();
            $table->foreign('rooms_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreign('class_rooms_id')->references('id')->on('class_rooms')->onDelete('cascade');
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
        Schema::dropIfExists('class_rooms_rooms');
    }
}
