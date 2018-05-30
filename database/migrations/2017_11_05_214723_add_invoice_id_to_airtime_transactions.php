<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInvoiceIdToAirtimeTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('airtime_transactions', function($table) {
            $table->integer('invoice_id')->index()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('airtime_transactions', 'invoice_id'))
        {
            Schema::table('airtime_transactions', function($table) {
                $table->dropColumn('invoice_id');
            });
        }
    }
}
