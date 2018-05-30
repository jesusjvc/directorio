<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_settings', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->smallInteger('default_pagination_count')->default(5)->unsigned();
            $table->smallInteger('limit_log_results')->default(50)->unsigned();
            $table->boolean('login_show_background_image')->default(1);
            $table->string('login_default_background_image', 100)->nullable();
            $table->string('file_allowable_file_formats', 200)->default('jpg,jpeg,png,gif,doc,docx,xls,xlsx,pdf');
            $table->boolean('show_system_footer_on_pdf')->default(1);
            $table->double('sms_provider_balance_threshold_notification', 15, 1)->default(5, 00);
            $table->string('system_notifications_mail_address', 250)->default('admin@localhost.com'); // admin@localhost.com
            $table->string('google_api_key', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_settings');
    }
}
