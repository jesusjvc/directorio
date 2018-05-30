<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTaxPersonalNameToProfileBillings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile_billings', function($table) {
            $table->string('tax_personal_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('profile_billings', 'tax_personal_name'))
        {
            Schema::table('profile_billings', function($table) {
                $table->dropColumn('tax_personal_name');
            });
        }
    }
}
