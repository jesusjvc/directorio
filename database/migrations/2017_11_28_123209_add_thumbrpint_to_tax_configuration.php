<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddThumbrpintToTaxConfiguration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tax_configurations', function($table) {
            $table->string('thumbprint')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('tax_configurations', 'thumbprint'))
        {
            Schema::table('tax_configurations', function($table) {
                $table->dropColumn('thumbprint');
            });
        }
    }
}
