<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxConfigurationsController extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_configurations', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->integer('profile_id')->index()->unsigned();
            $table->string('title', 100);
            $table->decimal('percentage', 5, 2);
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
        Schema::dropIfExists('tax_configurations');
    }
}
