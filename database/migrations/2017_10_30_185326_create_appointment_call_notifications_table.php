<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentCallNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_call_notifications', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->unsignedInteger('branch_id')->index();
            $table->boolean('schedule_pending')->default(0);
            $table->boolean('schedule')->default(0);
            $table->boolean('reschedule')->default(0);
            $table->text('notification_message');
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
        Schema::dropIfExists('appointment_call_notifications');
    }
}
