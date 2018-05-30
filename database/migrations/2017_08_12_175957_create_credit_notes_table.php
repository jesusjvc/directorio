<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_notes', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->unsignedInteger('profile_id')->index(); // created by
            $table->unsignedInteger('customer_id')->index()->default(0);
            $table->unsignedInteger('profile_customer_id')->index()->default(0); // admin customers (profiles) only
            $table->unsignedInteger('invoice_id')->index()->default(0);
            $table->unsignedInteger('tax_configuration_id')->default(0);
            $table->string('thumbprint')->unique();
            $table->date('credit_note_date');
            $table->integer('credit_note_no')->unsigned();
            $table->enum('status', [0, 1])->default(0); // 0=draft  1=locked
            $table->text('description');
            $table->decimal('tax_amount',15,7)->default(0.0000000);
            $table->decimal('total_amount',15,2)->default(0.00);
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
        Schema::dropIfExists('credit_notes');
    }
}
