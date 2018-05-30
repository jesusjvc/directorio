<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticSmsProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_sms_providers', function (Blueprint $table) {
            $table->increments('id')->unsigned()->index();
            $table->string('sms_gateway_provider');
            $table->string('sms_gateway_api_variables');
        });

        DB::table('static_sms_providers')->insert(
            [
                [
                    'sms_gateway_provider' => 'nexmo',
                    'sms_gateway_api_variables' => 'api_key|api_secret',
                ],
                [
                    'sms_gateway_provider' => 'twilio',
                    'sms_gateway_api_variables' => 'accountsid|authtoken',
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('static_sms_providers');
    }
}
