<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTaxAmountAndTotalAmountToQuotations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotations', function($table) {
            $table->decimal('tax_amount',15,2)->default(0.00);
            $table->decimal('total_amount',15,2)->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('quotations', 'tax_amount'))
        {
            Schema::table('quotations', function($table) {
                $table->dropColumn('tax_amount');
            });
        }
        if (Schema::hasColumn('quotations', 'total_amount'))
        {
            Schema::table('quotations', function($table) {
                $table->dropColumn('total_amount');
            });
        }
    }
}
