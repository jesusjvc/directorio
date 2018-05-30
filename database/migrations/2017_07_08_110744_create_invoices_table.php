<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->unsignedInteger('profile_id')->index(); // created by
            $table->unsignedInteger('customer_id')->index()->default(0);
            $table->unsignedInteger('profile_customer_id')->index()->default(0); // admin customers (profiles) only
            $table->unsignedInteger('quotation_id')->index()->default(0);
            $table->unsignedInteger('tax_configuration_id')->default(0);
            $table->date('invoice_date');
            $table->date('due_date');
            $table->integer('invoice_no')->unsigned();
            $table->enum('status', [0, 1])->default(0); // 0=draft  1=locked
            $table->string('purchase_order_no')->nullable();
            $table->string('optional_reference',150)->nullable();
            $table->string('thumbprint')->unique();
            $table->string('currency',3)->default('USD');
            $table->decimal('exchange_rate',15,7)->default(1.0000000);
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
        Schema::dropIfExists('invoices');
    }
}
