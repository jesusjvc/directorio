<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReadNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('read_notifications', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->integer('profile_id')->index()->default(0)->unsigned();
            $table->integer('branch_id')->index()->default(0)->unsigned();
            $table->enum('status', [0, 1])->default(0); // 0=unread  1=read
            $table->string('subject',100);
            $table->string('detail',250);
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
        Schema::dropIfExists('read_notifications');
    }
}
