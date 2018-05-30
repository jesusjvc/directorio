<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomerIdToReadNotifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('read_notifications', function($table) {
            $table->unsignedInteger('customer_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('read_notifications', 'customer_id'))
        {
            Schema::table('read_notifications', function($table) {
                $table->dropColumn('customer_id');
            });
        }
    }
}
