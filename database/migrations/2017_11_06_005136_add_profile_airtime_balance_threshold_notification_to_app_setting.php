<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfileAirtimeBalanceThresholdNotificationToAppSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_settings', function($table) {
            $table->double('profile_airtime_balance_threshold_notification', 15, 1)->default(5, 00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('app_settings', 'profile_airtime_balance_threshold_notification'))
        {
            Schema::table('app_settings', function($table) {
                $table->dropColumn('profile_airtime_balance_threshold_notification');
            });
        }
    }
}
