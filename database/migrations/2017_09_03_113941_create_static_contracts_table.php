<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_contracts', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->integer('profile_id')->index()->unsigned();
            $table->integer('user_id')->index()->default(0);
            $table->integer('customer_id')->index()->default(0);
            $table->integer('profile_customer_id')->index()->default(0);
            $table->boolean('status')->default(0); // 0=draft  1=awaiting_signature 2=signed 3=expired
            $table->string('title', 100);
            $table->string('filename', 100);
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
        Schema::dropIfExists('static_contracts');
    }
}
