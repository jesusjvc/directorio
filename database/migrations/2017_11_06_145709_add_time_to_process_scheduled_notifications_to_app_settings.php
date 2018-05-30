<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimeToProcessScheduledNotificationsToAppSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_settings', function($table) {
            $table->time('time_to_process_scheduled_notifications')->default('07:00');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('app_settings', 'time_to_process_scheduled_notifications'))
        {
            Schema::table('app_settings', function($table) {
                $table->dropColumn('time_to_process_scheduled_notifications');
            });
        }
    }
}
