<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         * Scope
         * ** Line per field
         * ** E.g. field_name:field_type: |amount,number| // text / number
         * ** E.g. field_name:field_type: |firstname,text| // text / number
         */

        Schema::create('contract_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profile_id')->index()->unsigned();
            $table->string('title', 100);
            $table->text('contract');
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
        Schema::dropIfExists('contract_templates');
    }
}
