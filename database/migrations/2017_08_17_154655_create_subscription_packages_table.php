<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_packages', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->boolean('adminonly')->default(0);
            $table->string('name',100);
            $table->string('description',150);
            $table->double('monthly_charge_per_profile', 9, 2)->default(0.00);
            $table->unsignedInteger('expire_in_x_days')->default(0);
            $table->string('limit_customer_accounts')->default(0);
            $table->string('limit_professionals')->default(0);
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
        Schema::dropIfExists('subscription_packages');
    }
}
