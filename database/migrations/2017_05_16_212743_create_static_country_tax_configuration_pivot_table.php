<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticCountryTaxConfigurationPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_country_tax_configuration', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->integer('static_country_id')->unsigned();
            $table->integer('tax_configuration_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('static_country_tax_configuration');
    }
}
