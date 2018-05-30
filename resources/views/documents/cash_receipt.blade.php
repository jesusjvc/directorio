@extends('documents.layout')
@section('content')
    @php
        $profile = $cash_receipt->profile;
    @endphp
    @if($cash_receipt->invoice->profile_customer != null)
        <footer>
            @if(($profile->profile_billing->custom_financial_footer != null) && ($profile->profile_billing->custom_financial_footer != ''))
                {{ $profile->profile_billing->custom_financial_footer }}
                <br>
            @endif
            {!! trans('app.cash_receipt_cash_receipt_no_submitted_by_customername',["cash_receipt_no" => $profile->profile_billing->cash_receipt_number_prefix . $cash_receipt->cash_receipt_no,"customername" => ucwords($cash_receipt->invoice->profile_customer->business_name)]) !!}
            @if($app_settings->show_system_footer_on_pdf == 1)
                - {{ trans('app.generated_by') }} {{ CustomHelper::wwwOnly($system_profile->business_url) }}
            @endif
        </footer>
    @else
        @php
            $customernames = ucwords($cash_receipt->invoice->customer->prefix . ' ' . $cash_receipt->invoice->customer->firstname . ' ' . $cash_receipt->invoice->customer->lastname)
        @endphp
        <footer>
            @if(($profile->profile_billing->custom_financial_footer != null) && ($profile->profile_billing->custom_financial_footer != ''))
                {{ $profile->profile_billing->custom_financial_footer }}
                <br>
            @endif
            {!! trans('app.cash_receipt_cash_receipt_no_submitted_by_customername',["cash_receipt_no" => $profile->profile_billing->cash_receipt_number_prefix . $cash_receipt->cash_receipt_no,"customername" => $customernames]) !!}
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
                @if($cash_receipt->profile->business_logo != null)
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
                {{ trans_choice('app.cash_receipt',1) }}
            </td>
        </tr>
        <tr>
            <td class="tg-yw4l vspace10"></td>
            <td class="tg-yw4l vspace10"></td>
            <td class="tg-yw4l vspace10"></td>
        </tr>
        <tr>
            <td class="tg-yw4l documentto">{{ ucwords(trans('app.cash_receipt_to')) }}</td>
            <td class=""></td>
            <td class="tg-yw4l top" rowspan="5">
                <ul class="linelist">
                    <li>
                        <span>{{ trans('app.cash_receipt_no') }}:</span>
                        {{ $profile->profile_billing->cash_receipt_number_prefix }}{{ $cash_receipt->cash_receipt_no }}
                    </li>
                    <li>
                        <span>{{ trans('app.cash_receipt_date') }}:</span>
                        {{ CustomHelper::dateShort($cash_receipt->cash_receipt_date) }}
                    </li>
                    <li>
                        <span>{{ trans('app.related_invoice') }}:</span>
                        {{ $profile->profile_billing->invoice_number_prefix }}{{ $cash_receipt->invoice->invoice_no }}
                    </li>
                    <li>
                        <span>{{ trans('app.amount_paid') }}:</span>
                        {{ $cash_receipt->profile->profile_billing->default_currency }} {{ number_format($cash_receipt->total_amount,2) }}
                    </li>
                </ul>
            </td>
        </tr>
        <tr>
            <td class="tg-yw4l top" rowspan="4">
                <div class="">
                    @if($cash_receipt->invoice->profile_customer != null)
                        <span style="text-transform:uppercase; font-weight:bold;">{{ ucwords($cash_receipt->invoice->profile_customer->business_name) }}</span>
                        <span style="text-transform:uppercase; font-weight:normal;"><br><i>{{ ucwords($cash_receipt->invoice->profile_customer->account_number) }}</i><br></span>
                    @endif
                    @if($cash_receipt->invoice->customer != null)
                        <span style="text-transform:uppercase; font-weight:bold;">{{ $customernames }}</span>
                        @if(($cash_receipt->invoice->customer->company) && ($cash_receipt->invoice->customer->company != ''))
                            <span style="text-transform:uppercase; font-weight:normal;"><br><i>{{ ucwords($cash_receipt->invoice->customer->company) }}</i><br></span>
                        @endif
                    @endif
                    @if(($cash_receipt->invoice->profile_customer != null) && ($cash_receipt->invoice->profile_customer->profile_billing != null) && ($cash_receipt->invoice->profile_customer->profile_billing->tax_number != null) && ($cash_receipt->invoice->profile_customer->profile_billing->tax_number != ''))
                        <div style="text-transform:uppercase;">{{ ucwords(trans('app.tax_number')) }}
                            <i>{{ ucwords($cash_receipt->invoice->profile_customer->profile_billing->tax_number) }}</i>
                        </div>
                    @endif
                    @if(($cash_receipt->invoice->customer != null)  && ($cash_receipt->invoice->customer->tax_number != null) && ($cash_receipt->invoice->customer->tax_number != ''))
                        <div style="text-transform:uppercase;">{{ ucwords(trans('app.tax_number')) }}
                            <i>{{ ucwords($cash_receipt->invoice->customer->tax_number) }}</i>
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
                    @if($cash_receipt->invoice->profile_customer != null)
                        @if(($cash_receipt->invoice->profile_customer->business_phone) && ($cash_receipt->invoice->profile_customer->business_phone != ''))
                            <br>{{ trans('app.tel') }}:
                            +{{ $cash_receipt->invoice->profile_customer->business_phone }}
                        @endif
                    @endif
                    @if($cash_receipt->invoice->customer != null)
                        @if(($cash_receipt->invoice->customer->mobile_no) && ($cash_receipt->invoice->customer->mobile_no != ''))
                            <br>{{ trans('app.tel') }}: +{{ $cash_receipt->invoice->customer->mobile_no }}
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

            </td>
        </tr>
        <tr>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
        </tr>
    </table>
@endsection