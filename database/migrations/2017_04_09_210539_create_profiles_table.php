<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->unsignedInteger('subscription_package_id')->index()->default(0);
            $table->string('account_number', 100)->unique()->index();
            $table->string('business_name', 100);
            $table->string('business_email', 100);
            $table->string('business_url', 100)->nullable();
            $table->string('business_address_1', 100);
            $table->string('business_address_2', 100)->nullable();
            $table->string('business_city', 100);
            $table->string('business_state', 50)->nullable();
            $table->string('business_zip', 100)->nullable();
            $table->string('business_country', 100);
            $table->string('business_phone', 100)->nullable();
            $table->string('business_logo', 100)->nullable();
            $table->string('thumbprint')->unique();
            $table->string('timezone', 150)->default('Africa/Johannesburg');
            $table->string('default_sms_country_code', 10);
            $table->string('duration_to_show_flash_messages')->default(5);
            $table->string('paper_size')->default('A4');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('profiles')->insert(
            [
                'account_number' => 'administrator',
                'business_name' => 'My Service Business',
                'business_email' => 'postmaster@x692222.com',
                'business_url' => url(''),
                'business_address_1' => '1 Loop St',
                'business_city' => 'Cape Town',
                'business_country' => 'ZA',
                'business_phone' => '27824892604',
                'timezone' => 'Africa/Johannesburg',
                'default_sms_country_code' => '27',
                'thumbprint' => mt_rand(),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
