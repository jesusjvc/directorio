<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->unsignedInteger('profile_id')->index(); // created by
            $table->unsignedInteger('customer_id')->index()->default(0);
            $table->unsignedInteger('profile_customer_id')->index()->default(0); // admin customers (profiles) only
            $table->unsignedInteger('tax_configuration_id')->default(0);
            $table->date('quotation_date');
            $table->date('expiry_date');
            $table->integer('quotation_no')->unsigned();
            $table->enum('status', [0, 1, 2, 3, 4])->default(0); // 0=draft  1=awaiting_signature 2=signed 3=invoiced  4=expired
            $table->string('thumbprint')->unique();
            $table->string('currency',3)->default('USD');
            $table->decimal('exchange_rate',15,7)->default(1.0000000);
            $table->string('optional_reference',150)->nullable();
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
        Schema::dropIfExists('quotations');
    }
}
