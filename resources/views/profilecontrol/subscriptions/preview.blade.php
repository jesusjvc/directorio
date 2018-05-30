<!DOCTYPE html>
<html>

<head>
    <style>

        header {
            position: fixed;
            top: -20px;
            left: 0px;
            right: 0px;
            height: 20px;
        }

        footer {
            position: fixed;
            bottom: -25px;
            left: 0px;
            right: 0px;
            height: 20px;
            text-align: center;
            font-family: DejaVu Sans;
            font-size: 9px;
        }

        pagebreak {
            page-break-after: always;
        }

        table {
            page-break-inside: avoid;
        }

        hr {
            border-top-width: 1px;
            border-top-style: solid;
            height: 0px;
        }

    </style>
    <title>{{ $docname }}</title>
</head>

<?php

$style = [
    /* Layout ------------------------------ */

    'body' => 'font-size: 13px; margin: 0; padding: 0; width: 100%; background-color: #FFFFFF; line-height:22px;',
    'pdf-wrapper' => 'width: 100%; margin: 0; padding: 0;',

    /* Masthead ----------------------- */

    'pdf-profile-title' => 'font-size: 18px; font-weight: bold; color: #000; text-decoration: none; text-transform:uppercase;',
    'pdf-header' => 'padding: 15px 0; text-align: center; background-color: #EDEFF2;',
    'document-title' => 'font-size: 28px; font-weight: bold; padding: 20px 0; margin: 5px 0; text-align: center; text-transform:uppercase;
    border-width:2px; border-color: #000; border-top-style:solid; border-bottom-style:solid; border-left-style:none; border-right-style:none;',

    'pdf-body' => 'width: 100%; margin: 0; padding-top: 25px; padding-bottom: 0; background-color: #FFF;',
    'pdf-body_inner' => 'margin: 0 auto; padding: 0; background-color: #FFF;',
    'pdf-body_cell' => 'padding: 35px;',

    'pdf-footer' => 'margin-top: 25px; padding: 0; text-align: center; background-color: #EDEFF2;',
    'pdf-footer_cell' => 'color: #AEAEAE; padding: 15px; text-align: center;',

    /* Body ------------------------------ */

    'body_action' => 'width: 100%; margin: 30px auto; padding: 0; text-align: center;',
    'body_sub' => 'margin-top: 25px; padding-top: 25px; border-top: 1px solid #EDEFF2;',
    'pdf-itemlist_cell_left' => 'padding: 0px; text-align:left; vertical-align:top;',
    'pdf-itemlist_cell_center' => 'padding: 0px; text-align:center; vertical-align:top;',
    'pdf-itemlist_cell_right' => 'padding: 0px; text-align:right; vertical-align:top;',
    'pdf-itemheaders_cell_left' => 'padding: 0px; font-weight: bold; text-transform:uppercase; text-align:left;',
    'pdf-itemheaders_cell_center' => 'padding: 0px; font-weight: bold; text-transform:uppercase; text-align:center;',
    'pdf-itemheaders_cell_right' => 'padding: 0px; font-weight: bold; text-transform:uppercase; text-align:right;',
    'pdf-itemfooter' => 'padding: 0px; font-weight: bold; text-transform:uppercase; text-align:right;',
    'border-top-bottom' => 'border-top-style:solid;border-top-width:1px;border-color#EDEFF2; border-bottom-style:solid;border-bottom-width:1px;',

    'pdf-items-fontstyle' => 'font-weight: normal; line-height:25px;',
    'address_to' => 'font-weight: bold; text-transform: uppercase; padding:5px;',
    'sectional_titles' => 'font-size:12px; font-weight: bold; text-transform: uppercase; padding:0px 10px; text-align:right; vertical-align:top;',
    'sectional_values' => 'font-size:12px; font-weight: normal; text-align:left; vertical-align:top;',

    /* Type ------------------------------ */

    'anchor' => 'color: #3869D4;',
    'header-1' => 'margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold; text-align: left;',
    'paragraph' => 'margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;',
    'paragraph-sub' => 'margin-top: 0; color: #74787E; font-size: 12px; line-height: 1.5em;',
    'paragraph-center' => 'text-align: center;',

    /* Buttons ------------------------------ */

    'button' => 'display: block; display: inline-block; width: 200px; min-height: 20px; padding: 10px;
                 background-color: #3869D4; border-radius: 3px; color: #ffffff; font-size: 15px; line-height: 25px;
                 text-align: center; text-decoration: none; -webkit-text-size-adjust: none;',

    'button--green' => 'background-color: #22BC66;',
    'button--red' => 'background-color: #dc4d2f;',
    'button--blue' => 'background-color: #3869D4;',
];
?>

<?php $fontFamily = 'font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;'; ?>
<body style="{{ $style['body'] }} {{ $fontFamily }}">
@if($customer != null)
    <footer>{!! trans('app.credit_note_credit_note_no_addressed_to_customername',["credit_note_no" => $profile_billing->credit_note_number_prefix . $credit_note->credit_note_no,"customername" => ucwords($customer->business_name)]) !!}
        @if(Session::get('app_settings')->show_system_footer_on_pdf == 1)
            - {{ trans('app.generated_by') }} {{ $profile->business_name }} {{ CustomHelper::wwwOnly($profile->business_url) }}
        @endif
    </footer>
@else
    @php
        $customernames = ucwords(trans('app.' . $customer->prefix) . ' ' . $customer->firstname . ' ' . $customer->lastname)
    @endphp
    <footer>{!! trans('app.credit_note_credit_note_no_addressed_to_customername',["credit_note_no" => $profile_billing->credit_note_number_prefix . $credit_note->credit_note_no,"customername" => $customernames]) !!}
        @if(Session::get('app_settings')->show_system_footer_on_pdf == 1)
            - {{ trans('app.generated_by') }} {{ $profile->business_name }} {{ CustomHelper::wwwOnly($profile->business_url) }}
        @endif
    </footer>
@endif
<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td style="{{ $style['pdf-wrapper'] }}" align="center">
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="{{ $style['pdf-header'] }}">
                        <div style="{{ $style['pdf-profile-title'] }}">
                            {{ $profile->business_name }}
                        </div>
                        <div>
                            @if(($profile->business_address_1) && ($profile->business_address_1 != ''))
                                {{ $profile->business_address_1 }}
                            @endif
                            @if(($profile->business_address_2) && ($profile->business_address_2 != ''))
                                , {{ $profile->business_address_2 }}
                            @endif
                            @if(($profile->business_city) && ($profile->business_city != ''))
                                : : {{ $profile->business_city }}
                            @endif
                            @if(($profile->business_zip) && ($profile->business_zip != ''))
                                : : {{ $profile->business_zip }}
                                @if(($profile->business_state) && ($profile->business_state != ''))
                                    {{ " " . $profile->business_state }}
                                @endif
                            @endif
                            @if(($profile->country) && ($profile->country != ''))
                                : : {{ ucwords($profile->country) }}
                            @endif
                            @if(($profile->business_phone) && ($profile->business_phone != ''))
                                <br> {{ trans('app.tel') }}: +{{ $profile->business_phone }}
                            @endif
                            @if(($profile->business_email) && ($profile->business_email != ''))
                                : : {{ trans('app.email') }}: {{ $profile->business_email }}
                            @endif
                            @if(($profile->business_url) && ($profile->business_url != ''))
                                : : {{ trans('app.web') }}: {{ CustomHelper::wwwOnly($profile->business_url) }}
                            @endif
                        </div>
                        @if(($profile->profile_billing->tax_enabled == 1) && (($profile->profile_billing->tax_number != null)))
                            <div>{{ trans('app.tax_number') }} #{{ $profile->profile_billing->tax_number }}</div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="{{ $style['pdf-body'] }}" width="100%">
                        <table style="{{ $style['pdf-body_inner'] }} {{ $style['pdf-items-fontstyle'] }}" width="100%"
                               cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="line-height:18px; vertical-align:top;" width="35%">
                                    <div style="{{ $style['border-top-bottom'] }} {{ $style['address_to'] }}">
                                        {{ trans('app.credit_note_to') }}
                                    </div>
                                    @if($customer != null)
                                        <p>
                                            <span style="text-transform:uppercase; font-weight:bold;">{{ ucwords($customer->business_name) }}</span>
                                            <span style="text-transform:uppercase; font-weight:normal;"><br><i>#{{ ucwords($customer->account_number) }}</i><br></span>
                                            @if(($billing_address->address_1) && ($billing_address->address_1 != ''))
                                                {{ $billing_address->address_1 }}
                                            @endif
                                            @if(($billing_address->address_2) && ($billing_address->address_2 != ''))
                                                , {{ $billing_address->address_2 }}
                                            @endif
                                            @if(($billing_address->city) && ($billing_address->city != ''))
                                                <br>{{ $billing_address->city }}
                                            @endif
                                            @if(($billing_address->postal_code) && ($billing_address->postal_code != ''))
                                                <br>{{ $billing_address->postal_code }}
                                                @if(($billing_address->state) && ($billing_address->state != ''))
                                                    {{ " " . $billing_address->state }}
                                                @endif
                                            @endif
                                            @if(($billing_address->country) && ($billing_address->country != ''))
                                                <br>{{ strtoupper($billing_address->country) }}
                                            @endif
                                            @if(($customer->business_phone) && ($customer->business_phone != ''))
                                                <br>{{ trans('app.tel') }}:
                                                +{{ $customer->business_phone }}
                                            @endif
                                            @if(($customer->profile_billing->tax_enabled == 1) && (($profile->profile_billing->tax_number != null)))
                                                <br>{{ trans('app.tax_number') }}
                                                #{{ $customer->profile_billing->tax_number }}
                                            @endif
                                        </p>
                                    @else
                                        <p>
                                            <span style="text-transform:uppercase; font-weight:bold;">{{ $customernames }}</span>
                                            @if(($customer->company) && ($customer->company != ''))
                                                <span style="text-transform:uppercase; font-weight:normal;"><br><i>{{ ucwords($customer->company) }}</i><br></span>
                                            @endif
                                            <br>
                                            @if(($billing_address->address_1) && ($billing_address->address_1 != ''))
                                                {{ $billing_address->address_1 }}
                                            @endif
                                            @if(($billing_address->address_2) && ($billing_address->address_2 != ''))
                                                , {{ $billing_address->address_2 }}
                                            @endif
                                            @if(($billing_address->city) && ($billing_address->city != ''))
                                                <br>{{ $billing_address->city }}
                                            @endif
                                            @if(($billing_address->postal_code) && ($billing_address->postal_code != ''))
                                                <br>{{ $billing_address->postal_code }}
                                                @if(($billing_address->state) && ($billing_address->state != ''))
                                                    {{ " " . $billing_address->state }}
                                                @endif
                                            @endif
                                            @if(($billing_address->country) && ($billing_address->country != ''))
                                                <br>{{ strtoupper($billing_address->country) }}
                                            @endif
                                            @if(($customer->mobile_no) && ($customer->mobile_no != ''))
                                                <br>{{ trans('app.tel') }}: +{{ $customer->mobile_no }}
                                            @endif
                                        </p>
                                    @endif
                                </td>
                                <td style="line-height:18px; vertical-align:top;" width="15%">

                                </td>
                                <td style="line-height:18px; vertical-align:top;" width="50%">
                                    <table style="{{ $style['pdf-body_inner'] }} {{ $style['pdf-items-fontstyle'] }}"
                                           align="center"
                                           width="100%" cellpadding="0"
                                           cellspacing="0">
                                        <tr>
                                            <td style="{{ $style['sectional_titles'] }} {{ $style['sectional_titles'] }}">
                                                {{ trans('app.credit_note_no') }}
                                            </td>
                                            <td style="{{ $style['sectional_values'] }}">
                                                #{{ $profile_billing->credit_note_number_prefix }}{{ $credit_note->credit_note_no }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="{{ $style['sectional_titles'] }} {{ $style['sectional_titles'] }}">
                                                {{ trans('app.credit_note_date') }}
                                            </td>
                                            <td style="{{ $style['sectional_values'] }}">
                                                {{ $credit_note->credit_note_date }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="{{ $style['sectional_titles'] }} {{ $style['sectional_titles'] }}">
                                                {{ trans('app.document_status') }}
                                            </td>
                                            <td style="{{ $style['sectional_values'] }}">
                                                <span style="background-color:#fa000b; text-transform:uppercase; padding:3px; font-weight:bold; color:#FFFFFF;">
                                                {{ strtoupper($credit_note->textStatus) }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="{{ $style['sectional_titles'] }} {{ $style['sectional_titles'] }}">
                                                {{ trans('app.currency') }}
                                            </td>
                                            <td style="{{ $style['sectional_values'] }}">
                                                {{ $credit_note->profile->profile_billing->default_currency }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="{{ $style['sectional_titles'] }} {{ $style['sectional_titles'] }}">
                                                {{ trans('app.credit_amount') }}
                                            </td>
                                            <td style="{{ $style['sectional_values'] }}">
                                                {{ $credit_note->total_amount }}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            @if($credit_note->description != null)
                                <tr>
                                    <td colspan="4" style="{{ $style['sectional_values'] }}">
                                        <hr>
                                        <div>
                                            <strong>
                                                {{ trans('app.description') }}:
                                            </strong>
                                        </div>
                                        <div>
                                            {{ $credit_note->description }}
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
@if(($profile_billing->default_credit_note_text != null) && ($profile_billing->default_credit_note_text != ''))
    <pagebreak></pagebreak>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td style="{{ $style['pdf-wrapper'] }}" align="center">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="{{ $style['pdf-header'] }}">
                            <div style="{{ $style['pdf-profile-title'] }}">
                                {{ trans('app.conditions_and_other_related_information') }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                {!! $profile_billing->default_credit_note_text !!}
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endif
</body>
</html>