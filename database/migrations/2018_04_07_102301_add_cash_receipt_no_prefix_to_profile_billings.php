<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCashReceiptNoPrefixToProfileBillings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile_billings', function($table) {
            $table->string('cash_receipt_number_prefix', 10)->default('CAS');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('profile_billings', 'cash_receipt_number_prefix'))
        {
            Schema::table('profile_billings', function($table) {
                $table->dropColumn('cash_receipt_number_prefix');
            });
        }
    }
}