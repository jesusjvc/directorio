<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAirtimeToInvoiceItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice_items', function($table) {
            $table->boolean('airtime')->default(0); // 1=yes 0=no
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('invoice_items', 'airtime'))
        {
            Schema::table('invoice_items', function($table) {
                $table->dropColumn('airtime');
            });
        }
    }
}
