<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTokenExpiryDaysToSystemNotificationBuilders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('system_notification_builders', function($table) {
            $table->string('token_expiry_days', 50)->default('1,10')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('system_notification_builders', 'token_expiry_days'))
        {
            Schema::table('system_notification_builders', function($table) {
                $table->dropColumn('token_expiry_days');
            });
        }
    }
}
