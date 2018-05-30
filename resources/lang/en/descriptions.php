<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'service_items_example' => '<p>Creating and managing service items are easy. The only aspect to take note of is that "General Items" can not be booked from the front-end customer side. Service modules other than "General Item" can be booked or purchased from the front end and are directly related to one specific chargeable unit - such as minutes. </p> <p>As an example, a hair studio allow their customers to book appointments in real-time from their website. Service items in the back-end are thus created under the Service Module "Appointment Manager" because it is important to know exactly how long it will take to complete the appointment - in order for us to have an effective calendar management system. In this case, anything that takes up time and which should be "bookable" from the front-end customer side, should be created under  the "Appointment Manager" service module, as it relates directly to time units.</p><p>Continuing with the example, assume that during the time attending the appointment, the customer decides to have a hair primer applied, which can be applied to the customer`s hair <strong>within the booked appointment time period.</strong> Since this is just a type of an add-on which does not really requires extra time, we will not create it as an "Appointment Manager" item, but rather as a "General Item" - so that it can be added to the invoice easily without altering the time booked.</p>',
    'contract_template_update' => '<p>Take note that when updating a contract template, online versions (found in the control panel) of contracts created from the updated template, will be updated as well. However, emailed, exported and PDF versions of contracts will not be updated, unless regenerated.</p><p><strong>IMPORTANT:</strong> If you change or remove dynamic input fields, any existing contracts which make use of the changed or removed fields, will have a direct effect and will not show the data of dynamic fields changed or removed.</p>',
    'verify' => '<p>An email and/or sms has been sent to you with a unique pincode. Please enter the pin below in order to verify yourself.</p>',
    'business_address' => '<p>The BUSINESS ADDRESS details is the professional address information the profile owner wants to present to the outside world and will be used to present on official business documents related to the profile, such as invoices, quotations, credit notes, email footers and other notification footers.</p>',
    'business_shipping_billing_address' => 'The shipping and billing address is for administrator purposes only and will ONLY be used for shipping and billing purposes by :BUSINESSNAME',
    'profile_create_did_number' => '<p>Please select an inbound number to allocate to this profile. Important to note is that each number has certain capabilities. If you want to send SMS messages, please ensure that the DID number is capable of sending SMS texts. If you want to process voice calls, please ensure that the DID number is capable of making and/or receiving VOICE calls.</p>',
    'logo_is_optional_on_edit' => '<p>Only browse and select a logo file if you want to change your existing logo.</p>',
    'long_billing_footer_text_can_be_edited' => 'The long footer text for invoices, credit notes and quotations can be updated by clicking on the EDIT button',
    'invoice_status_new' => 'The invoice currently has no definite status and nothing is saved yet.',
    'quotation_status_new' => 'The quotation currently has no definite status and nothing is saved yet.',
    'quotation_status_draft' => 'The quotation is created and a <u>unique</u> quotation number has been assigned. Assigned quotation numbers <b>can not be re-used</b>. Quotations with a <b>DRAFT</b> status can still be edited and changed. Once a quotation is <b>accepted or an invoice is created from the quotation,</b> no changes can be made to the quotation.',
    'invoice_status_draft' => 'The invoice is created and a <u>unique</u> invoice number has been assigned. Assigned invoice numbers <b>can not be re-used</b>. Invoices with a <b>DRAFT</b> status can still be edited and changed. Once the status of an invoice is updated to <b>locked,</b> no changes can be made to the invoice.',
    'credit_note_status' => 'In order for a credit note to be in affect, the status MUST be changed to LOCKED. <i>DRAFT</i> credit notes will not be calculated.',
    'contracts_explained' => '<p>The Contract Builder is a great tool for creating contract templates and creating multiple contracts based on the contract template. Fields can be added dynamically and contracts can be changed in real-time. Important to keep in mind is to update related contracts when adding or removing dynamic fields.</p><p><b>Input Fields</b> - Dynamic input fields can be created by simply wrapping a string (with no spaces or special characters) with double brackets like so: <code>[[string]]</code></p><p><b>BASIC EXAMPLE</b></p><p>Dear <code>[[buyers_name]]</code><br><br>I am selling you this <code>[[what_are_you_selling]]</code> for the amount of <code>[[selling_amount]]</code><br><br>Sold by: <code>[[seller_name]]</code></p>',
    'quote_exchange_rate' => 'IMPORTANT: The base currency is :profilecurrency. an Attempt wil be made to process the quotation in the foreign currency selected based on the latest exchange rates. The exchange rate is ONLY locked and only applies to the quotation when a quotation is either electronically accepted or if an invoice is created from the quotation.',
    'exchange_rate_notice_on_export' => 'IMPORTANT: Amounts quoted in :foreigncurrency are only indicative and may fluctuate depending on the <br> :homecurrency/:foreigncurrency exchange rate. Payments are required to be the equivalent of the amount in :homecurrency.',
    'note_credit_notes' => 'Take note: Credit note amounts should be captured as TAX INCLUSIVE',
    'manual_payments' => 'Important: Online payments can not be processed on behalf of customers. This section is for processing payments already received.',
    'subscription_exchange_rate' => 'IMPORTANT: The base currency is :profilecurrency. an Attempt wil be made to provide an ESTIMATE in the foreign currency selected based on the latest exchange rates. Estimated foreign amounts will be displayed on the subscription invoice only. All amounts are still billed and charged in :profilecurrency',
    'service_package' => 'Service packages are offerings you office as a SaaS service provider to your direct customers. Several packages with several configurations can be configured.',
    'note_subscriptions' => 'All amounts entered should be excluding TAX',
    'airtime_explained' => '<p>Important to note is that airtime is NOT automatically deducted from an account`s balance and that each profile account has a separate airtime wallet. Airtime must be purchased from an account`s balance.</p><p>Profile holders can make a payment to their account, but because we have other financial instances to take into account, such as subscriptions, invoices, credit notes and TAX calculations on these records, we have to ensure to actually bill an airtime transaction against a profile account.</p><p>So when a profile account wants to add airtime credit, the account holder (or you as the administrator on behalf of the profile account) should buy airtime by making use of the profile account`s credit as payment.</p>',
    'airtime_explained_alt' => '<p>Important to note is that airtime is NOT automatically deducted from your account balance and that your account has a separate airtime wallet. Airtime must be purchased from your account`s balance. So when you want to add airtime credit, you have to buy airtime by making use of your account credit as payment.</p>',
    'did_defaults_profile' => 'DID numbers are virtual numbers that allows you to, depending on the number capabilities, programatically send and receive SMS text messages and voice calls from and to your control panel. It also allows SMS recipients to reply directly to your control panel (some countries have restrictions that applies to this feature). Note that not all countries support virtual numbers.',
    'did_defaults' => 'When a SMS text is sent, the system will look for the first available DID number assigned, capable of sending a SMS text. The same principle applies for processing calls. When a call request is initiated, the system will automatically look for the first available DID number capable of processing calls. Thus, it is advisable to assign one DID number which is both voice and sms capable. However, some countries support DID numbers which are either voice or sms capable. Therefore you can assign one voice capable number and one sms capable number. Bear in mind that if a number is not SMS capable, SMS text message will not be able to send. The same applies for processing voice calls.',
    'payment_status' => 'The current status of this payment is DRAFT. Documents must be LOCKED in order to take effect.',
    'join_how_it_works' => 'Once you have complete the sign up form below, you will have immediate access to your profile account! You can then start making use of the system. You will receive a few emails which includes further instructions, your account invoice and your account information.',

];
