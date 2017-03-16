<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospitals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('address');
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->text('footer_kwitansi')->nullable();
            $table->string('unit_state')->nullable();
            $table->string('unit_number')->nullable();
            $table->string('province_code')->nullable();
            $table->string('province_name')->nullable();
            $table->string('signature_sign')->nullable();
            $table->string('image_header')->nullable();
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
        Schema::dropIfExists('hospitals');
    }
}
