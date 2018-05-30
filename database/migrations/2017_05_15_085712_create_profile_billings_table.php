<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_billings', function (Blueprint $table) {
            $table->increments('id')->index()->unsigned();
            $table->integer('profile_id')->index()->unsigned();
            $table->string('default_currency', 10)->default('USD');
            $table->boolean('tax_enabled')->default(1);
            $table->string('tax_number', 100)->nullable();
            $table->boolean('show_total_customer_balance_on_documents')->default(1);
            $table->boolean('autoconvert_accepted_quotations_to_invoice')->default(1);
            $table->boolean('disable_online_payments')->default(0);
            $table->boolean('display_draft_invoice_as_pro_forma_invoice')->default(1);
            $table->tinyInteger('default_days_invoice_due')->default(0);
            $table->tinyInteger('default_days_quotation_valid')->default(7);
            $table->tinyInteger('default_days_contract_expire')->default(7);
            $table->string('invoice_number_prefix', 10)->default('INV');
            $table->string('quotation_number_prefix', 10)->default('QUO');
            $table->string('payment_number_prefix', 10)->default('PMT');
            $table->string('credit_note_number_prefix', 10)->default('CN');
            $table->string('subscription_number_prefix', 10)->default('SUB');
            $table->text('default_invoice_text')->nullable();
            $table->text('default_quotation_text')->nullable();
            $table->text('default_credit_note_text')->nullable();
            $table->timestamps();
        });

        DB::table('profile_billings')->insert(
            [
                'profile_id' => 1,
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
        Schema::dropIfExists('profile_billings');
    }
}
