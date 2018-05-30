<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->integer('profile_id')->index()->unsigned();
            $table->boolean('isuser')->default(1);
            $table->boolean('isprofessional')->default(0);
            $table->boolean('isreception')->default(0);
            $table->char('prefix', 10);
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique()->index();
            $table->string('mobile_no')->index();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            [
                'profile_id' => 1,
                'prefix' => 'mr',
                'firstname' => 'System',
                'lastname' => 'Admin',
                'email' => 'x692222@gmail.com',
                'mobile_no' => '27821231234',
                'password' => bcrypt('admin'),
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
        Schema::dropIfExists('users');
    }
}
