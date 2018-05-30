<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticEmailTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_email_templates', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->integer('static_variable_relation_id')->index()->unsigned();
            $table->string('subject', 150);
            $table->text('body');
            $table->timestamps();
        });

        // NB! ek het user firstname, en customer firstname, so ek sal moet dit doen as user_firstname en customer_firstname al gebruik ek dit nie in dieselfde fields nie

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('static_email_templates');
    }
}
