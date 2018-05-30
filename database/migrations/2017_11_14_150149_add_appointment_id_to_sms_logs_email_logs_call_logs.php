<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAppointmentIdToSmsLogsEmailLogsCallLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('email_logs', function($table) {
            $table->unsignedInteger('appointment_id')->default(0);
        });

        Schema::table('call_logs', function($table) {
            $table->unsignedInteger('appointment_id')->default(0);
        });

        Schema::table('sms_logs', function($table) {
            $table->unsignedInteger('appointment_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('email_logs', 'appointment_id'))
        {
            Schema::table('email_logs', function($table) {
                $table->dropColumn('appointment_id');
            });
        }

        if (Schema::hasColumn('call_logs', 'appointment_id'))
        {
            Schema::table('call_logs', function($table) {
                $table->dropColumn('appointment_id');
            });
        }

        if (Schema::hasColumn('sms_logs', 'appointment_id'))
        {
            Schema::table('sms_logs', function($table) {
                $table->dropColumn('appointment_id');
            });
        }
    }
}
