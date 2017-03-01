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
            $table->integer('status')->nullable();
            $table->text('notes')->nullable();
            $table->integer('register_id')->unsigned()->nullable();
            $table->foreign('register_id')->references('id')->on('registers')->onDelete('cascade');
            $table->integer('poly_id')->unsigned()->nullable();
            $table->foreign('poly_id')->references('id')->on('polies')->onDelete('cascade');
            $table->integer('staff_id')->unsigned()->nullable();
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
        Schema::dropIfExists('references');
    }
}
