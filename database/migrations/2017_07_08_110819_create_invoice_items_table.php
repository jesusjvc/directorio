<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->unsignedInteger('invoice_id')->index();
            $table->unsignedInteger('service_item_id')->index()->nullable();
            $table->string('description',250);
            $table->unsignedSmallInteger('quantity');
            $table->decimal('item_amount',15,7)->default(0.0000000);
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
        Schema::dropIfExists('invoice_items');
    }
}
