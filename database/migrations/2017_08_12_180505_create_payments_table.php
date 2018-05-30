<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->unsignedInteger('profile_id')->index(); // created by
            $table->unsignedInteger('customer_id')->index()->default(0);
            $table->unsignedInteger('profile_customer_id')->index()->default(0); // admin customers (profiles) only
            $table->unsignedInteger('payment_gateway_id')->index()->default(0);
            $table->string('thumbprint')->unique();
            $table->date('payment_date');
            $table->enum('status', [0, 1])->default(0); // 0=draft  1=locked
            $table->integer('payment_no')->unsigned();
            $table->decimal('total_amount',15,2)->default(0.00);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
