<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_billings', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->unsignedInteger('profile_id')->index()->default(0);
            $table->unsignedInteger('customer_id')->index()->default(0);
            $table->boolean('is_default')->default(0);
            $table->string('friendly_name', 150);
            $table->string('address_1', 150);
            $table->string('address_2', 150)->nullable();
            $table->string('city', 150);
            $table->string('state', 50)->nullable();
            $table->string('country', 150);
            $table->string('postal_code', 150)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address_billings');
    }
}
