<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->unsignedInteger('appointment_id')->default(0);
            $table->unsignedInteger('quotation_id')->default(0);
            $table->unsignedInteger('invoice_id')->default(0);
            $table->unsignedInteger('credit_note_id')->default(0);
            $table->unsignedInteger('payment_id')->default(0);
            $table->unsignedInteger('customer_id')->default(0);
            $table->unsignedInteger('profile_customer_id')->default(0);
            $table->mediumText('note');
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
        Schema::dropIfExists('notes');
    }
}
