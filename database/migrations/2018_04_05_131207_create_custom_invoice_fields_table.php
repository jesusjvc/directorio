<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomInvoiceFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_invoice_fields', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->unsignedInteger('profile_id')->index();
            $table->enum('required', ["yes", "no"])->default("yes");
            $table->enum('type', ["text", "number", "menu"])->default("text");
            $table->enum('show_on_export', ["yes", "no"])->default("yes");
            $table->string('field_name');
            $table->text('menu_options')->nullable();
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
        Schema::dropIfExists('custom_invoice_fields');
    }
}
