<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultDaysForContractsToExpireToAppSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_settings', function($table) {
            $table->smallInteger('default_days_contracts_to_expire')->default(30)->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('app_settings', 'default_days_contracts_to_expire'))
        {
            Schema::table('app_settings', function($table) {
                $table->dropColumn('default_days_contracts_to_expire');
            });
        }
    }
}
