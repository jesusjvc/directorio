@extends('documents.layout')
@section('content')
    @php
        $profile = $payment->profile;
    @endphp
    @if($payment->profile_customer != null)
        <footer>
            @if(($profile->profile_billing->custom_financial_footer != null) && ($profile->profile_billing->custom_financial_footer != ''))
                {{ $profile->profile_billing->custom_financial_footer }}
                <br>
            @endif
            {!! trans('app.payment_payment_no_submitted_by_customername',["payment_no" => $profile->profile_billing->payment_number_prefix . $payment->payment_no,"customername" => ucwords($payment->profile_customer->business_name)]) !!}
            @if($app_settings->show_system_footer_on_pdf == 1)
                - {{ trans('app.generated_by') }} {{ CustomHelper::wwwOnly($system_profile->business_url) }}
            @endif
        </footer>
    @else
        @php
            $customernames = ucwords($payment->customer->prefix . ' ' . $payment->customer->firstname . ' ' . $payment->customer->lastname)
        @endphp
        <footer>
            @if(($profile->profile_billing->custom_financial_footer != null) && ($profile->profile_billing->custom_financial_footer != ''))
                {{ $profile->profile_billing->custom_financial_footer }}
                <br>
            @endif
            {!! trans('app.payment_payment_no_submitted_by_customername',["payment_no" => $profile->profile_billing->payment_number_prefix . $payment->payment_no,"customername" => $customernames]) !!}
            @if($app_settings->show_system_footer_on_pdf == 1)
                - {{ trans('app.generated_by') }} {{ CustomHelper::wwwOnly($system_profile->business_url) }}
            @endif
        </footer>
    @endif
    <table class="tg" width="100%">
        <tr>
            <td class="tg-yw4l" width="40%"></td>
            <td class="tg-yw4l" width="20%"></td>
            <td class="tg-yw4l" width="40%"></td>
        </tr>
        <tr>
            <th class="tg-5fb6" colspan="2">{{ $profile->business_name }}</th>
            <th class="tg-yw4l text-center" rowspan="2">
                @if($payment->profile->business_logo != null)
                    <img src="{{ Storage::url('user_uploads/profiles/' . $profile->id . '/logos/' . $profile->business_logo) }}">
                @endif
            </th>
        </tr>
        <tr>
            <td class="tg-yw4l top" colspan="2">
                <div class="addressdetails">
                    @if(($profile->profile_billing->tax_personal_name != null) && ($profile->profile_billing->tax_personal_name != ''))
                        <div>{{ $profile->profile_billing->tax_personal_name }}</div>
                    @endif
                    @if(($profile->profile_billing->tax_number != null) && ($profile->profile_billing->tax_number != ''))
                        <div>{{ trans('app.tax_number') }}: {{ $profile->profile_billing->tax_number }}</div>
                    @endif
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
            </td>
        </tr>
        <tr>
            <td class="tg-yw4l vspace5"></td>
            <td class="tg-yw4l vspace5"></td>
            <td class="tg-yw4l vspace5"></td>
        </tr>
        <tr>
            <td class="tg-doctitle" colspan="3">
                {{ trans('app.payment_receipt') }}
            </td>
        </tr>
        <tr>
            <td class="tg-yw4l vspace10"></td>
            <td class="tg-yw4l vspace10"></td>
            <td class="tg-yw4l vspace10"></td>
        </tr>
        <tr>
            <td class="tg-yw4l documentto">{{ ucwords(trans('app.payment_to')) }}</td>
            <td class=""></td>
            <td class="tg-yw4l top" rowspan="5">
                <ul class="linelist">
                    <li>
                        <span>{{ trans('app.payment_no') }}:</span>
                        {{ $profile->profile_billing->payment_number_prefix }}{{ $payment->payment_no }}
                    </li>
                    <li>
                        <span>{{ trans('app.payment_date') }}:</span>
                        {{ CustomHelper::dateShort($payment->payment_date) }}
                    </li>
                    <li>
                        <span>{{ trans('app.document_status') }}:</span>
                        {{ strtoupper($payment->textStatus) }}
                    </li>
                    <li>
                        <span>{{ trans('app.payment_gateway') }}:</span>
                        {{ $payment->payment_gateway->payment_method_name }}
                    </li>
                    <li>
                        <span>{{ trans('app.amount') }}:</span>
                        {{ $payment->profile->profile_billing->default_currency }} {{ number_format($payment->total_amount,2) }}
                    </li>
                    @if(($payment->payment_gateway->payment_method_name == 'Cash') && ($payment->cash_receipt != null))
                        <li>
                            <span>{{ trans_choice('app.cash_receipt',1) }}:</span>
                            {{ $profile->profile_billing->cash_receipt_number_prefix }}{{ $payment->cash_receipt->cash_receipt_no }}
                        </li>
                        <li>
                            <span>{{ trans('app.invoice') }}:</span>
                            {{ $profile->profile_billing->invoice_number_prefix }}{{ $payment->cash_receipt->invoice->invoice_no }}
                        </li>
                    @endif
                </ul>
            </td>
        </tr>
        <tr>
            <td class="tg-yw4l top" rowspan="4">
                <div class="">
                    @if($payment->profile_customer != null)
                        <span style="text-transform:uppercase; font-weight:bold;">{{ ucwords($payment->profile_customer->business_name) }}</span>
                        <span style="text-transform:uppercase; font-weight:normal;"><br><i>{{ ucwords($payment->profile_customer->account_number) }}</i><br></span>
                    @endif
                    @if($payment->customer != null)
                        <span style="text-transform:uppercase; font-weight:bold;">{{ $customernames }}</span>
                        @if(($payment->customer->company) && ($payment->customer->company != ''))
                            <span style="text-transform:uppercase; font-weight:normal;"><br><i>{{ ucwords($payment->customer->company) }}</i><br></span>
                        @endif
                    @endif
                    @if(($payment->profile_customer != null) && ($payment->profile_customer->profile_billing != null) && ($payment->profile_customer->profile_billing->tax_number != null) && ($payment->profile_customer->profile_billing->tax_number != ''))
                        <div style="text-transform:uppercase;">{{ ucwords(trans('app.tax_number')) }}
                            <i>{{ ucwords($payment->profile_customer->profile_billing->tax_number) }}</i>
                        </div>
                    @endif
                    @if(($payment->customer != null)  && ($payment->customer->tax_number != null) && ($payment->customer->tax_number != ''))
                        <div style="text-transform:uppercase;">{{ ucwords(trans('app.tax_number')) }}
                            <i>{{ ucwords($payment->customer->tax_number) }}</i>
                        </div>
                    @endif
                    @if(($billing_address->address_1) && ($billing_address->address_1 != ''))
                        <br>{{ $billing_address->address_1 }}
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
                    @if($payment->profile_customer != null)
                        @if(($payment->profile_customer->business_phone) && ($payment->profile_customer->business_phone != ''))
                            <br>{{ trans('app.tel') }}:
                            +{{ $payment->profile_customer->business_phone }}
                        @endif
                    @endif
                    @if($payment->customer != null)
                        @if(($payment->customer->mobile_no) && ($payment->customer->mobile_no != ''))
                            <br>{{ trans('app.tel') }}: +{{ $payment->customer->mobile_no }}
                        @endif
                    @endif
                </div>
            </td>
            <td class=""></td>
        </tr>
        <tr>
            <td class=""></td>
        </tr>
        <tr>
            <td class=""></td>
        </tr>
        <tr>
            <td class=""></td>
        </tr>
        <tr>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
        </tr>
        <tr>
            <td class="tg-yw4l" colspan="3" align="right">
                <strong>{{ trans('app.reference') }}
                    : </strong> {{ strtoupper($payment->description) }}
            </td>
        </tr>
        <tr>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
        </tr>
    </table>
    <div class="vspace10">
        &nbsp;
    </div>
    @if(($profile->profile_billing->default_payment_text != null) && ($profile->profile_billing->default_payment_text != ''))
        <pagebreak></pagebreak>
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td align="center">
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="conditions-header">
                                <div>
                                    {{ trans('app.conditions_and_other_related_information') }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="conditions">
                                    {!! $profile->profile_billing->default_payment_text !!}
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    @endif
@endsection