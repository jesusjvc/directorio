<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->unsignedInteger('profile_id');
            $table->string('branch_name');
            $table->string('map_address');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('business_hours');
            $table->text('facilities');
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
        Schema::dropIfExists('branches');
    }
}
