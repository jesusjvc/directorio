<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_items', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->unsignedInteger('quotation_id')->index();
            $table->unsignedInteger('service_item_id')->index();
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
        Schema::dropIfExists('quotation_items');
    }
}
