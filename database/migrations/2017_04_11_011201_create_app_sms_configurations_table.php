<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppSmsConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_sms_configurations', function (Blueprint $table) {
            $table->increments('id')->unsigned()->index();
            $table->smallInteger('isdefault')->index()->unsigned()->default(0);
            $table->integer('static_sms_provider_id')->index()->unsigned();
            $table->string('sms_gateway_api_values');
            $table->string('configuration_nickname');
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
        Schema::dropIfExists('app_sms_configurations');
    }
}
