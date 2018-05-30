<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpcomingNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upcoming_notifications', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->unsignedInteger('appointment_id');
            $table->integer('branch_id')->index()->default(0)->unsigned();
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('scheduled_text_notification_id')->nullable();
            $table->unsignedInteger('scheduled_call_notification_id')->nullable();
            $table->date('date_to_send');
            $table->boolean('sms')->default(0);
            $table->boolean('email')->default(0);
            $table->boolean('call')->default(0);
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
        Schema::dropIfExists('upcoming_notifications');
    }
}
