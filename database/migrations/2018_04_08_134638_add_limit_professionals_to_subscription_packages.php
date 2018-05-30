<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLimitProfessionalsToSubscriptionPackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscription_packages', function($table) {
            $table->string('limit_professional_accounts')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('subscription_packages', 'limit_professional_accounts'))
        {
            Schema::table('subscription_packages', function($table) {
                $table->dropColumn('limit_professional_accounts');
            });
        }
    }
}