<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultDaysForSignatureTokensToExpireToAppSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_settings', function($table) {
            $table->smallInteger('default_days_signature_tokens_to_expire')->default(5)->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('app_settings', 'default_days_signature_tokens_to_expire'))
        {
            Schema::table('app_settings', function($table) {
                $table->dropColumn('default_days_signature_tokens_to_expire');
            });
        }
    }
}
