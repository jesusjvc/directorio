<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAutomatedEmailInvoiceOnLockToAppSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_settings', function($table) {
            $table->boolean('automated_email_invoice_on_lock')->default(1);
            $table->boolean('automated_email_payment_on_lock')->default(1);
            $table->boolean('automated_email_credit_note_on_lock')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('app_settings', 'automated_email_invoice_on_lock'))
        {
            Schema::table('app_settings', function($table) {
                $table->dropColumn('automated_email_invoice_on_lock');
            });
        }
        if (Schema::hasColumn('app_settings', 'automated_email_payment_on_lock'))
        {
            Schema::table('app_settings', function($table) {
                $table->dropColumn('automated_email_payment_on_lock');
            });
        }
        if (Schema::hasColumn('app_settings', 'automated_email_credit_note_on_lock'))
        {
            Schema::table('app_settings', function($table) {
                $table->dropColumn('automated_email_credit_note_on_lock');
            });
        }
    }
}
