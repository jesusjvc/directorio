<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduledTextNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheduled_text_notifications', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->unsignedInteger('branch_id')->index();
            $table->boolean('bydefault')->default(0);
            $table->unsignedInteger('days_before')->default(0);
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
        Schema::dropIfExists('scheduled_text_notifications');
    }
}
