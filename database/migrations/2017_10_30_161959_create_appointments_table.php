<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->unsignedInteger('profile_id')->index();
            $table->integer('branch_id')->index()->unsigned();
            $table->integer('agenda_id')->index()->unsigned();
            $table->integer('customer_id')->index()->unsigned();
            $table->string('reference')->unique();
            $table->enum('status', ['active','pending','confirmed','attended','billed','nsu','cancelled','rescheduled'])->default('active');
            $table->dateTime('date');
            $table->dateTime('date_to');
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
        Schema::dropIfExists('appointments');
    }
}
