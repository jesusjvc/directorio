<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHablameToStaticSmsProviders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('static_sms_providers')->insert(
            [
                [
                    'sms_gateway_provider' => 'hablame',
                    'sms_gateway_api_variables' => 'cliente|api',
                    'mono' => 1,
                ]
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
       //
    }
}
