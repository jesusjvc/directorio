<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomFinancialFooter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile_billings', function($table) {
            $table->string('custom_financial_footer', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('profile_billings', 'custom_financial_footer'))
        {
            Schema::table('profile_billings', function($table) {
                $table->dropColumn('custom_financial_footer');
            });
        }
    }
}
