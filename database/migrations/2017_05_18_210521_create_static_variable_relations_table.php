<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Static_variable_relation;

//use File;

class CreateStaticVariableRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_variable_relations', function (Blueprint $table) {
            $table->increments('id')->unsigned()->index();
            $table->string('relation', 100);
            $table->text('available_variables');
            $table->timestamps();
        });

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

        // rateme

        $file = base_path($seedsemailpath . 'rateme.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'appointments|rate_me';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_customer . '|' . $var_appointment . '|' . $var_branch . '|' . $var_rateme . '|provider';
        $datainsert['subject'] = '{{customer_firstname}}, please tell me how I did';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        // appointments

        $file = base_path($seedsemailpath . 'appointment_schedule_pending.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'appointments|schedule_pending';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_customer . '|' . $var_appointment . '|' . $var_branch . '|provider';
        $datainsert['subject'] = 'Your appointment #{{appointment_reference}} at {{provider}} has been scheduled';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'appointment_schedule.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'appointments|schedule';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_customer . '|' . $var_appointment . '|' . $var_branch . '|provider';
        $datainsert['subject'] = 'Your appointment #{{appointment_reference}} at {{provider}} has been scheduled';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'appointment_reschedule.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'appointments|reschedule';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_customer . '|' . $var_appointment . '|' . $var_branch . '|provider';
        $datainsert['subject'] = 'RESCHEDULE CONFIRMATION: Your appointment #{{appointment_reference}} at {{provider}} has been RESCHEDULED';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'appointment_cancel.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'appointments|cancel';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_customer . '|' . $var_appointment . '|' . $var_branch . '|provider';
        $datainsert['subject'] = 'CANCELLATION CONFIRMATION: Your appointment #{{appointment_reference}} at {{provider}} has been CANCELLED';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'appointment_accept.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'appointments|accept';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_customer . '|' . $var_appointment . '|' . $var_branch . '|provider';
        $datainsert['subject'] = 'APPOINTMENT CONFIRMATION: Your appointment #{{appointment_reference}} at {{provider}} has been ACCEPTED';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'appointment_reject.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'appointments|reject';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_customer . '|' . $var_appointment . '|' . $var_branch . '|provider';
        $datainsert['subject'] = 'REJECTED: Your appointment #{{appointment_reference}} at {{provider}} has been REJECTED';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'appointment_reminder.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'appointments|reminder';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile;
        $datainsert['subject'] = '';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        // electronic_signature

        $file = base_path($seedsemailpath . 'customer_new.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'customers|customer_new';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_customer;
        $datainsert['subject'] = '{{customer_fullnames}}, your account is registered with {{profile_business_name}}';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'customer_existing.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'customers|customer_existing';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_customer;
        $datainsert['subject'] = '{{customer_fullnames}}, your account is registered with {{profile_business_name}}';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'customer_edit.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 0;
        $datainsert['relation'] = 'customers|customer_edit';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_customer;
        $datainsert['subject'] = '{{customer_fullnames}}, your account information has been updated';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'electronic_signature_request.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'electronic_signature|signature_request';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_electronic_signature;
        $datainsert['subject'] = '{{customer_entity}}, you`re requested to sign the attached {{document_type}}';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'electronic_signature_processed.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'electronic_signature|signature_processed';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_electronic_signature;
        $datainsert['subject'] = '{{customer_entity}}, this is a confirmation that you have signed and accepted the attached {{document_type}}';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'electronic_signature_expiration_notification.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'electronic_signature|token_expire_notice';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_electronic_signature . '|expiredays';
        $datainsert['subject'] = 'Your {{document_type}} token expires in {{expiredays}} days';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        // contracts

        $file = base_path($seedsemailpath . 'contracts_customers.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'contracts|customers';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_customer . '|' . $custom_message . '|contract_title';
        $datainsert['subject'] = '{{customer_fullnames}}, your contract {{contract_title}} is attached';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'contracts_users.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'contracts|users';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_user . '|' . $custom_message . '|contract_title';
        $datainsert['subject'] = '{{user_prefix}} {{user_firstname}} {{user_lastname}}, your contract {{contract_title}} is attached';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'contracts_profiles.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'contracts|profiles';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $custom_message . '|contract_title';
        $datainsert['subject'] = '{{profile_business_name}}, your contract {{contract_title}} is attached';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        // custom mail

        $file = base_path($seedsemailpath . 'custom_custom_email.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'custom|custom_email';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_user;
        $datainsert['subject'] = '';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        // Application

        $file = base_path($seedsemailpath . 'application_test_mail.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'application|test_mail';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_user;
        $datainsert['subject'] = 'Test mail from {{app_business_name}}';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'application_gateway_account_balance.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'application|gateway_account_balance_update';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_sms_gateway;
        $datainsert['subject'] = 'Important: {{sms_gateway_name}}`s balance is {{sms_gateway_balance}}';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'application_no_system_default_sms_gateway.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'application|no_system_default_sms_gateway';
        $datainsert['available_variables'] = $var_default . '|' . $var_application;
        $datainsert['subject'] = 'Important: No default SMS/Voice gateway';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'application_no_system_sms_or_voice_number.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'application|no_system_sms_or_voice_number';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_sms_gateway_name;
        $datainsert['subject'] = 'Important: No system DID number for {{sms_gateway_name}} assigned to {{app_business_name}}';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'application_sms_gateway_connection_failure.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'application|sms_gateway_connection_failure';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_sms_gateway_name;
        $datainsert['subject'] = 'Important: {{sms_gateway_name}} failed to establish a connection';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'application_payment_gateway_connection_failure.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'application|payment_gateway_connection_failure';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_payment_gateway;
        $datainsert['subject'] = 'Important: {{payment_gateway_name}} failed to establish a connection';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        // Password Reset

        $file = base_path($seedsemailpath . 'application_password_reset.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'application|password_reset';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_password_reset;
        $datainsert['subject'] = 'Here is your password reset token at {{app_business_name}}';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);


        // saas service subscriptions

        $file = base_path($seedsemailpath . 'saas_new_subscription.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'saas_service|new_subscription';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_saas_subscription;
        $datainsert['subject'] = 'Your service at {{app_business_name}} is now active';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);


        // Profile

        $file = base_path($seedsemailpath . 'profile_customer_limit_notice.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'profile|customer_limit_notice';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_saas_subscription . '|usage|limit';
        $datainsert['subject'] = 'Your customer account limit is almost reached';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'profile_airtime_topup.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'profile|airtime_topup';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|amount|balance';
        $datainsert['subject'] = 'Your airtime wallet received a top-up of {{amount}}';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'profile_airtime_balance_low.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'profile|airtime_balance_low';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|balance';
        $datainsert['subject'] = 'Your airtime wallet balance is low';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'profile_new.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'profile|new';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile;
        $datainsert['subject'] = 'Hello {{profile_business_name}}! Your profile at {{app_business_name}} is ready';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'profile_update.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 0;
        $datainsert['relation'] = 'profile|update';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile;
        $datainsert['subject'] = 'Your profile at {{app_business_name}} has been updated';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'profile_delete.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'profile|delete';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile;
        $datainsert['subject'] = 'Your profile at {{app_business_name}} has been closed';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'profile_did_number_assigned.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'profile|did_number_assigned';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_profile_did;
        $datainsert['subject'] = '{{profile_business_name}}, your number {{profile_did_number}} is ready';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'profile_did_number_released.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'profile|did_number_released';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_profile_did;
        $datainsert['subject'] = '{{profile_business_name}}, your number +{{profile_did_number}} was removed';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'branch_did_number_assigned.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'branch|did_number_assigned';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_branch_did . '|' . $var_branch;
        $datainsert['subject'] = '{{branch_branch_name}}, your number {{branch_did_number}} is ready';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'branch_did_number_released.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'branch|did_number_released';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_branch_did . '|' . $var_branch;
        $datainsert['subject'] = '{{branch_branch_name}}, your number +{{branch_did_number}} was removed';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'profile_inbound_sms.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'profile|inbound_sms';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_profile_inbound_sms;
        $datainsert['subject'] = '{{profile_business_name}}, you have just received a SMS message from {{sms_from_number}}';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'profile_inbound_voicemail.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'profile|inbound_voicemail';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_profile_inbound_voicemail;
        $datainsert['subject'] = '{{profile_business_name}}, you have an voicemail message from {{voicemail_from_number}}';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'profile_expired.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'profile|profile_expired';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile;
        $datainsert['subject'] = '{{profile_business_name}}, your trial has ended';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'profile_expire_notice.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'profile|profile_expire_notice';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|expiredays';
        $datainsert['subject'] = 'Your trial account at {{app_business_name}} expires in {{expiredays}} days';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        // Profile Billing Address

        $file = base_path($seedsemailpath . 'profile_new_billing_address.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 0;
        $datainsert['relation'] = 'profile|new_billing_address';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_profile_billing_address;
        $datainsert['subject'] = '{{profile_business_name}}, your new billing address has been recorded';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'profile_update_billing_address.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 0;
        $datainsert['relation'] = 'profile|update_billing_address';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_profile_billing_address;
        $datainsert['subject'] = '{{profile_business_name}}, a billing address as been updated';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'profile_delete_billing_address.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 0;
        $datainsert['relation'] = 'profile|delete_billing_address';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_profile_billing_address;
        $datainsert['subject'] = '{{profile_business_name}}, a billing address as been deleted';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        // Profile Shipping Address

        $file = base_path($seedsemailpath . 'profile_new_shipping_address.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 0;
        $datainsert['relation'] = 'profile|new_shipping_address';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_profile_shipping_address;
        $datainsert['subject'] = '{{profile_business_name}}, your new shipping address has been recorded';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'profile_update_shipping_address.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 0;
        $datainsert['relation'] = 'profile|update_shipping_address';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_profile_shipping_address;
        $datainsert['subject'] = '{{profile_business_name}}, a shipping address as been updated';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'profile_delete_shipping_address.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 0;
        $datainsert['relation'] = 'profile|delete_shipping_address';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_profile_shipping_address;
        $datainsert['subject'] = '{{profile_business_name}}, a shipping address as been deleted';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        // professional
        $file = base_path($seedsemailpath . 'professional_new_assign.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'professional|new_assign';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_user;
        $datainsert['subject'] = '{{user_firstname}}, you are now assigned as a professional';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'professional_new.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'professional|new';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_user . '|' . $var_user_password;
        $datainsert['subject'] = '{{user_firstname}}, you are now registered as a professional';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'professional_update.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 0;
        $datainsert['relation'] = 'professional|update';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_user;
        $datainsert['subject'] = '{{user_firstname}} {{user_lastname}}, your account at {{profile_business_name}} has been updated';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        // reception
        $file = base_path($seedsemailpath . 'reception_new_assign.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'reception|new_assign';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_user;
        $datainsert['subject'] = '{{user_firstname}}, you now have reception access';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'reception_new.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'reception|new';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_user . '|' . $var_user_password;
        $datainsert['subject'] = '{{user_firstname}}, you now have reception access';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'reception_update.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 0;
        $datainsert['relation'] = 'reception|update';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_user;
        $datainsert['subject'] = '{{user_firstname}} {{user_lastname}}, your account at {{profile_business_name}} has been updated';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        // user
        $file = base_path($seedsemailpath . 'user_new_assign.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'user|new_assign';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_user;
        $datainsert['subject'] = '{{user_firstname}}, user access has been granted';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        // user
        $file = base_path($seedsemailpath . 'user_new.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'user|new';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_user . '|' . $var_user_password;
        $datainsert['subject'] = '{{user_firstname}} {{user_lastname}}, your account at {{profile_business_name}} is ready!';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'user_update.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 0;
        $datainsert['relation'] = 'user|update';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_user;
        $datainsert['subject'] = '{{user_firstname}} {{user_lastname}}, your account at {{profile_business_name}} has been updated';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        $file = base_path($seedsemailpath . 'user_delete.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 0;
        $datainsert['relation'] = 'user|delete';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_user;
        $datainsert['subject'] = '{{user_firstname}} {{user_lastname}}, your account at {{profile_business_name}} has been closed';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        // quotation

        $file = base_path($seedsemailpath . 'quotation_new.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'quotation|new';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_quotation_email . '|' . $var_quotation;
        $datainsert['subject'] = '{{customer_entity}}, here is your quotation {{quotation_no}}';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        // invoice

        $file = base_path($seedsemailpath . 'invoice_new.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'invoice|new';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_invoice_email . '|' . $var_invoice;
        $datainsert['subject'] = '{{customer_entity}}, here is your invoice {{invoice_no}}';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        // credit_note

        $file = base_path($seedsemailpath . 'credit_note_new.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'credit_note|new';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_credit_note_email . '|' . $var_credit_note;
        $datainsert['subject'] = '{{customer_entity}}, here is your credit note {{credit_note_no}}';
        $datainsert['body'] = $emailcontents;
        $tryinsert = new Static_variable_relation();
        $tryinsert = $tryinsert->create($datainsert);
        $tryinsert->email_template()->create($datainsert);

        // payment

        $file = base_path($seedsemailpath . 'payment_new.txt');
        if (!file_exists($file)): File::put($file, $fileContents); endif;
        try {
            $emailcontents = File::get($file);
        } catch (FileNotFoundException $exception) {
        }
        $datainsert['enabled'] = 1;
        $datainsert['relation'] = 'payment|new';
        $datainsert['available_variables'] = $var_default . '|' . $var_application . '|' . $var_profile . '|' . $var_payment_email . '|' . $var_payment;
        $datainsert['subject'] = '{{customer_entity}}, here is your payment confirmation {{payment_no}}';
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
        Schema::dropIfExists('static_variable_relations');
    }
}
