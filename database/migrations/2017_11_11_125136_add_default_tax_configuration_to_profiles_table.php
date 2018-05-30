<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultTaxConfigurationToProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function($table) {
            $table->unsignedInteger('tax_configuration_id')->default(1); // == ZERO TAX percent of system
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('profiles', 'tax_configuration_id'))
        {
            Schema::table('profiles', function($table) {
                $table->dropColumn('tax_configuration_id');
            });
        }
    }
}
