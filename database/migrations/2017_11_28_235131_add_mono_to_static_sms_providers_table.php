<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMonoToStaticSmsProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('static_sms_providers', function($table) {
            $table->boolean('mono')->default(0);
            $table->decimal('static_sms_rate',15,5)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('static_sms_providers', 'mono'))
        {
            Schema::table('static_sms_providers', function($table) {
                $table->dropColumn('mono');
            });
        }
        if (Schema::hasColumn('static_sms_providers', 'static_sms_rate'))
        {
            Schema::table('static_sms_providers', function($table) {
                $table->dropColumn('static_sms_rate');
            });
        }
    }
}
