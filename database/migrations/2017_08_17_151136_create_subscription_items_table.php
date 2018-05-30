<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_items', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->unsignedInteger('subscription_id')->index();
            $table->unsignedInteger('service_item_id')->index()->default(0);
            $table->unsignedInteger('app_sms_did_number_id')->index()->default(0);
            $table->unsignedInteger('subscription_package_id')->index()->default(0);
            $table->string('description',250);
            $table->unsignedSmallInteger('quantity')->default(1);
            $table->decimal('item_amount',15,2)->nullable();
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
        Schema::dropIfExists('subscription_items');
    }
}
