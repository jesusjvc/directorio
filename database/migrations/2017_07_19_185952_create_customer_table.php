<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->char('prefix', 10);
            $table->string('company')->nullable();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->index();
            $table->string('mobile_no')->index();
            $table->string('password');
            $table->string('timezone', 150)->default('Africa/Johannesburg');
            $table->string('default_currency', 10)->default('USD');
            $table->string('paper_size')->default('A4');
            $table->rememberToken();
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
        Schema::dropIfExists('customers');
    }
}
