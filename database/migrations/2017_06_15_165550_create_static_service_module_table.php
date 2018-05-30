<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticServiceModuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_service_modules', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->string('module', 200);
            $table->string('billing_units', 100);
            $table->timestamps();
        });

        DB::table('static_service_modules')->insert(
            [
                [
                    'module' => 'appointment_manager',
                    'billing_units' => 'minutes',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]
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
        Schema::dropIfExists('static_service_modules');
    }
}
