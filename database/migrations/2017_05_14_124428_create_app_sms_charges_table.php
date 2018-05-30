<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppSmsChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_sms_charges', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->double('charge_per_inbound_sms', 15, 5);
            $table->decimal('profit_per_outbound_sms', 5, 0);
            $table->decimal('profit_per_outbound_call', 5, 0);
            $table->decimal('profit_per_extended_number_validation', 5, 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_sms_charges');
    }
}
