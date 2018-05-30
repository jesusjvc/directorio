<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->unsignedInteger('profile_id')->index(); // created by
            $table->unsignedInteger('customer_id')->index()->default(0);
            $table->unsignedInteger('profile_customer_id')->index()->default(0); // admin customers (profiles) only
            $table->unsignedInteger('tax_configuration_id')->default(0);
            $table->enum('status', ["inactive", "active", "expired", "cancelled"])->default("inactive");
            $table->enum('interval', ["daily", "weekly", "bimonthly", "monthly", "quarterly", "biannually", "annually"])->default("monthly");
            $table->integer('subscription_no')->unsigned();
            $table->date('start_date');
            $table->date('next_bill_date');
            $table->date('end_date')->nullable();
            $table->string('thumbprint')->unique();
            $table->string('currency',3)->default('USD');
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
        Schema::dropIfExists('subscriptions');
    }
}
