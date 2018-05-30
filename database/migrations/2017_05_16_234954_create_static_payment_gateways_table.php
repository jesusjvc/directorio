<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticPaymentGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_payment_gateways', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->string('gateway_name', 100);
            $table->boolean('process_method')->default(1); // 1 = GET 0 = POST
            $table->mediumText('required_variables')->nullable();
            $table->mediumText('allowed_currencies', 250);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('static_payment_gateways')->insert(
            [
                [
                    'gateway_name' => 'PayPal',
                    'process_method' => 1,
                    'required_variables' => 'ClientId|ClientSecret',
                    'allowed_currencies' => 'USD,AUD,CAD,CZK,DKK,EUR,HKD,ILS,MXN,NOK,NZD,PHP,PLN,GBP,SGD,SEK,CHF,THB',
                ],
                [
                    'gateway_name' => 'Bank Payment',
                    'process_method' => 0,
                    'required_variables' => 'offline',
                    'allowed_currencies' => '*',
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
        Schema::dropIfExists('static_payment_gateways');
    }
}
