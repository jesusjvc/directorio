<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStripeDataToStaticPaymentGateways extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::table('static_payment_gateways')->insert(
            [
                [
                    'gateway_name' => 'Stripe',
                    'process_method' => 1,
                    'required_variables' => 'PublishableKey|SecretKey',
                    'allowed_currencies' => 'USD,AUD,CAD,CZK,DKK,EUR,HKD,ILS,MXN,NOK,NZD,PHP,PLN,GBP,SGD,SEK,CHF,THB',
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
