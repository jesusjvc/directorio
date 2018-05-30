<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropStaticCurrencyIdFromCallLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('call_logs', 'static_currency_id'))
        {
            Schema::table('call_logs', function($table) {
                $table->dropColumn('static_currency_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('call_logs', function($table) {
            $table->integer('static_currency_id')->index()->unsigned(); // just for extra clarity and possible relation indexing
        });
    }
}
