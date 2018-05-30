<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToCallLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('call_logs', function($table) {
            $table->string('call_instance_id')->nullable();
            $table->string('status')->nullable();
            $table->integer('call_duration')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('call_logs', 'call_instance_id'))
        {
            Schema::table('call_logs', function($table) {
                $table->dropColumn('call_instance_id');
            });
        }
        if (Schema::hasColumn('call_logs', 'status'))
        {
            Schema::table('call_logs', function($table) {
                $table->dropColumn('status');
            });
        }
        if (Schema::hasColumn('call_logs', 'call_duration'))
        {
            Schema::table('call_logs', function($table) {
                $table->dropColumn('call_duration');
            });
        }
    }
}
