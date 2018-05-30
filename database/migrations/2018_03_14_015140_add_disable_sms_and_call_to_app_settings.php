<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDisableSmsAndCallToAppSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_settings', function($table) {
            $table->boolean('disable_sms')->default(0); // 1=yes 0=no
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('app_settings', 'disable_sms'))
        {
            Schema::table('app_settings', function($table) {
                $table->dropColumn('disable_sms');
            });
        }
    }
}
