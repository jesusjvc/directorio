<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->integer('profile_id')->index()->unsigned();
            $table->boolean('status')->default(1);
            $table->integer('static_payment_gateway_id')->index()->unsigned();
            $table->string('payment_method_name', 100);
            $table->mediumText('variable_values')->nullable();
            $table->mediumText('instructions')->nullable();
            $table->boolean('include_instructions_in_notification')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_gateways');
    }
}
