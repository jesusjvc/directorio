<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticUserPrefixesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_user_prefixes', function (Blueprint $table) {
            $table->string('prefix');
        });

        DB::table('static_user_prefixes')->insert(
            [[
                'prefix' => 'mr',
            ],
                [
                    'prefix' => 'mrs',
                ],
                [
                    'prefix' => 'miss',
                ],
                [
                    'prefix' => 'prof',
                ],
                [
                    'prefix' => 'dr',
                ]]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('static_user_prefixes');
    }
}
