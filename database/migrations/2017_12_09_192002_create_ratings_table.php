<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('token')->unique();
            $table->enum('status', ["request", "rated"])->default("request");
            $table->unsignedInteger('user_id')->default(0);
            $table->unsignedInteger('appointment_id')->default(0);
            $table->unsignedInteger('attention')->default(0);
            $table->unsignedInteger('on_time')->default(0);
            $table->unsignedInteger('price')->default(0);
            $table->unsignedInteger('facilities')->default(0);
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
        Schema::dropIfExists('ratings');
    }
}
