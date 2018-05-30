<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCashPaymentsToStaticPaymentGateways extends Migration
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
                    'gateway_name' => 'Cash',
                    'process_method' => 0,
                    'required_variables' => 'offline',
                    'allowed_currencies' => '*',
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
