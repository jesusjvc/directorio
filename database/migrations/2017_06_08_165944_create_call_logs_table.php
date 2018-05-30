<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_logs', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->integer('profile_id')->index()->unsigned(); // though we get this from the parent method, having the profile_id allow us to eliminate DB queries in some cases
            $table->integer('app_sms_did_number_id')->index()->unsigned(); // just for extra clarity and possible relation indexing
            $table->integer('static_currency_id')->index()->unsigned(); // just for extra clarity and possible relation indexing
            $table->integer('static_sms_provider_id')->index()->unsigned(); // just for extra clarity and possible relation indexing
            $table->integer('app_sms_configuration_id')->index()->unsigned(); // just for extra clarity and possible relation indexing
            $table->string('direction', 50); // inbound / outbound
            $table->string('from_number', 250);
            $table->string('to_number', 250);
            $table->double('amount_charged', 15, 8)->default(0.00);
            $table->double('amount_cost', 15, 8)->default(0.00);
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
        Schema::dropIfExists('call_logs');
    }
}
