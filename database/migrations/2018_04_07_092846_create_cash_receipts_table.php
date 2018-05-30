<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_receipts', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->unsignedInteger('profile_id')->index();
            $table->unsignedInteger('invoice_id')->index();
            $table->unsignedInteger('payment_id')->index();
            $table->date('cash_receipt_date');
            $table->integer('cash_receipt_no')->unsigned();
            $table->decimal('total_amount',15,2)->default(0.00);
            $table->string('thumbprint')->unique();
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
        Schema::dropIfExists('cash_receipts');
    }
}
