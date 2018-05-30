<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Static_variable_relation;

class AddProfessionalLimitNoticeToEmailTemplates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $var_default = 'date|time|datetime_text_long|date_text_short';
        $var_application = 'app_business_name|app_business_email|app_business_url|app_business_address_1|app_business_address_2|app_business_city|app_business_state|app_business_zip|app_business_country|app_business_phone|app_business_logo|app_timezone|app_paper_size|app_currency';
        $var_sms_gateway = 'sms_gateway_name|sms_gateway_balance';
        $var_sms_gateway_name = 'sms_gateway_name';
        $var_payment_gateway = 'payment_gateway_name';
        $var_password_reset = 'token';
        $var_profile = 'profile_account_number|profile_business_name|profile_business_email|profile_business_url|profile_business_address_1|profile_business_address_2|profile_business_city|profile_business_state|profile_business_zip|profile_business_country|profile_business_phone|profile_business_logo|profile_timezone|profile_default_sms_country_code|profile_paper_size';
        $var_profile_did = 'profile_did_number|profile_did_number_features';
        $var_branch_did = 'branch_did_number|branch_did_number_features';
        $var_profile_inbound_sms = 'inbound_did_number|sms_from_number|inbound_sms_message';
        $var_profile_inbound_voicemail = 'inbound_did_number|voicemail_from_number|voicemail_link';
        $var_user = 'user_prefix|user_firstname|user_lastname|user_email|user_mobile_no';
        $var_user_password = 'user_password';
        $var_profile_billing_address = 'profile_billing_address_friendly_name|profile_billing_address_address_1|profile_billing_address_address_2|profile_billing_address_city|profile_billing_address_country|profile_billing_address_state|profile_billing_address_postal_code';
        $var_profile_shipping_address = 'profile_shipping_address_friendly_name|profile_shipping_address_address_1|profile_shipping_address_address_2|profile_shipping_address_city|profile_shipping_address_country|profile_shipping_address_state|profile_shipping_address_postal_code';
        $var_customer = 'customer_fullnames|customer_prefix|customer_firstname|customer_lastname|customer_email|customer_mobile_no';
        $var_branch = 'branch_name|map_address|latitude|longitude|facilities';
        $non_customers = 'recipient_names|recipient_email';
        $custom_message = 'custom_message';
        $var_customer_billing_address = 'customer_billing_address_friendly_name|customer_billing_address_address_1|customer_billing_address_address_2|customer_billing_address_city|customer_billing_address_country|customer_billing_address_state|customer_billing_address_postal_code';
        $var_customer_shipping_address = 'customer_shipping_address_friendly_name|customer_shipping_address_address_1|customer_shipping_address_address_2|customer_shipping_address_city|customer_shipping_address_country|customer_shipping_address_state|customer_shipping_address_postal_code';
        $var_note = 'note';
        $var_electronic_signature = 'customer_entity|token|expiry_date|document_type';
        $var_invoice = 'public_web_address|invoice_date|due_date|invoice_no|status|purchase_order_no|optional_reference|currency|optional_reference';
        $var_cash_receipt = 'public_web_address|cash_receipt_date|cash_receipt_no|customer_entity';
        $var_invoice_email = 'customer_entity|customer_email_address|customer_contact_number';
        $var_quotation_email = 'customer_entity|customer_email_address|customer_contact_number';
        $var_quotation = 'quotation_date|expiry_date|quotation_no|status|public_web_address|currency|optional_reference';
        $var_credit_note = 'credit_note_date|total_amount|description|status|public_web_address';
        $var_credit_note_email = 'customer_entity|customer_email_address|customer_contact_number';
        $var_payment = 'payment_date|total_amount|description|status|public_web_address';
        $var_payment_email = 'customer_entity|customer_email_address|customer_contact_number';
        $var_saas_subscription = 'service_name|service_description|service_monthly_charge_per_profile|service_expire_in_x_days|service_limit_customer_accounts|service_limit_professional_accounts';
        $var_appointment = 'appointment_reference|appointment_status|appointment_date';
        $var_rateme = 'rateme_link';

        // path
        $seedsemailpath = 'database/seeds/emails/';

        $datainsert = null;
        $fileContents = trans('app.enter_your_email_body_contents_here');

        // cash_receipt

        $file = base_path($seedsemailpath . 'professional_limit_notice.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'profile|professional_limit_notice';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_saas_subscription . '|usage|limit';
        $datainsert['subject'] = 'Your professional provider limit is almost reached';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
