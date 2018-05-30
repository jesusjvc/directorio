<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->unsignedInteger('profile_id')->index();
            $table->unsignedInteger('customer_id')->index()->default(0);
            $table->unsignedInteger('profile_customer_id')->index()->default(0); // admin customers (profiles) only
            $table->unsignedInteger('payment_id')->index()->default(0);
            $table->unsignedInteger('payment_gateway_id')->index()->default(0);
            $table->enum('status', [0, 1, 2, 3])->default(0); // 0=failed  1=3dsecure  2=authorised  3=complete
            $table->text('description')->nullable();
            $table->string('ip_address');
            $table->decimal('total_amount',15,2)->default(0.00);
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
        Schema::dropIfExists('payment_transactions');
    }
}
