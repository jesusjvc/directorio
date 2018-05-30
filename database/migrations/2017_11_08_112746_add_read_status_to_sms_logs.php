<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReadStatusToSmsLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sms_logs', function($table) {
            $table->enum('read_status', ['read', 'unread'])->default('read');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('sms_logs', 'read_status'))
        {
            Schema::table('sms_logs', function($table) {
                $table->dropColumn('read_status');
            });
        }
    }
}
