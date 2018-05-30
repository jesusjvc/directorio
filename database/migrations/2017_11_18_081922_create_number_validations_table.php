<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNumberValidationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('number_validations', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', ["validated", "dne"]);
            $table->string('section'); // eg Profile / Contact Number / Profile Name
            $table->string('country_code');
            $table->string('msisdn');
            $table->string('national_format');
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
        Schema::dropIfExists('number_validations');
    }
}
