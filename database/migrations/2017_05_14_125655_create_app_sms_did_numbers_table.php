<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppSmsDidNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_sms_did_numbers', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->boolean('status')->index()->default(1)->unsigned(); // 1 = active
            $table->integer('profile_id')->index()->default(0)->unsigned();
            $table->integer('branch_id')->index()->default(0)->unsigned();
            $table->integer('static_sms_provider_id')->index()->unsigned();
            $table->string('did_number', 50)->unique();
            $table->string('features', 150)->nullable();
            $table->string('country', 100);
            $table->decimal('cost_per_month', 15, 7)->default(0);
            $table->decimal('sell_per_month', 15, 7)->default(0);
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
        Schema::dropIfExists('app_sms_did_numbers');
    }
}
