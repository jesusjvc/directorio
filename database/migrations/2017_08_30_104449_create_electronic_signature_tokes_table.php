<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElectronicSignatureTokesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('electronic_signature_tokens', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id')->index()->default(0);
            $table->unsignedInteger('profile_customer_id')->index()->default(0);
            $table->unsignedInteger('user_id')->index()->default(0);
            $table->unsignedInteger('contract_id')->index()->default(0);
            $table->unsignedInteger('static_contract_id')->index()->default(0);
            $table->unsignedInteger('quotation_id')->index()->default(0);
            $table->date('expiry_date');
            $table->enum('status', [0, 1, 2])->default(0); // 0=expired  1=active  2=rejected
            $table->string('token')->unique();
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
        Schema::dropIfExists('electronic_signature_tokens');
    }
}
