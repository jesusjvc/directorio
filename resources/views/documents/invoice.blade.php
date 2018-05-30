@extends('documents.layout')
@section('content')
    @php
        $profile = $invoice->profile;
    @endphp
    @if($invoice->profile_customer != null)
        <footer>
            @if(($profile->profile_billing->custom_financial_footer != null) && ($profile->profile_billing->custom_financial_footer != ''))
                {{ $profile->profile_billing->custom_financial_footer }}
                <br>
            @endif
                {!! trans('app.invoice_invoice_no_addressed_to_customername',["invoice_no" => $profile->profile_billing->invoice_number_prefix . $invoice->invoice_no,"customername" => ucwords($invoice->profile_customer->business_name)]) !!}
            @if($app_settings->show_system_footer_on_pdf == 1)
                - {{ trans('app.generated_by') }} {{ CustomHelper::wwwOnly($system_profile->business_url) }}
            @endif
        </footer>
    @else
        @php
            $customernames = ucwords($invoice->customer->prefix . ' ' . $invoice->customer->firstname . ' ' . $invoice->customer->lastname)
        @endphp
        <footer>
            @if(($profile->profile_billing->custom_financial_footer != null) && ($profile->profile_billing->custom_financial_footer != ''))
                {{ $profile->profile_billing->custom_financial_footer }}
                <br>
            @endif
                {!! trans('app.invoice_invoice_no_addressed_to_customername',["invoice_no" => $profile->profile_billing->invoice_number_prefix . $invoice->invoice_no,"customername" => $customernames]) !!}
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
                @if($invoice->profile->business_logo != null)
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
                @if($invoice->status == 0)
                    @if($profile->profile_billing->display_draft_invoice_as_pro_forma_invoice == 1)
                        {{ trans('app.pro_forma_invoice') }}
                    @else
                        @if(($profile->profile_billing->tax_number != null) && ($profile->profile_billing->tax_number != ''))
                            {{ trans('app.tax_invoice') }}
                        @else
                            {{ trans('app.invoice') }}
                        @endif
                    @endif
                @else
                    @if(($profile->profile_billing->tax_number != null) && ($profile->profile_billing->tax_number != ''))
                        {{ trans('app.tax_invoice') }}
                    @else
                        {{ trans('app.invoice') }}
                    @endif
                @endif
            </td>
        </tr>
        <tr>
            <td class="tg-yw4l vspace10"></td>
            <td class="tg-yw4l vspace10"></td>
            <td class="tg-yw4l vspace10"></td>
        </tr>
        <tr>
            <td class="tg-yw4l documentto">{{ ucwords(trans('app.invoice_to')) }}</td>
            <td class=""></td>
            <td class="tg-yw4l top" rowspan="5">
                <ul class="linelist">
                    <li>
                        <span>{{ trans('app.invoice_no') }}:</span>
                        {{ $profile->profile_billing->invoice_number_prefix }}{{ $invoice->invoice_no }}
                    </li>
                    <li>
                        <span>{{ trans('app.invoice_date') }}:</span>
                        {{ CustomHelper::dateShort($invoice->invoice_date) }}
                    </li>
                    <li>
                        <span>{{ trans('app.due_date') }}:</span>
                        {{ CustomHelper::dateShort($invoice->due_date) }}
                    </li>
                    <li>
                        <span>{{ trans('app.document_status') }}:</span>
                        {{ strtoupper($invoice->textStatus) }}
                    </li>
                    <li>
                        <span>{{ trans('app.currency') }}:</span>
                        {{ $invoice->home_currency->code }}
                    </li>
                    @if($invoice->home_currency->code != $invoice->invoice_currency->code)
                        <li>
                            <span>{{ trans('app.foreign_currency') }}:</span>
                            {{ $invoice->invoice_currency->code }}
                        </li>
                        <li>
                            <span>{{ trans('app.homecurrforeigncurr_xrt',["homecurr" => $invoice->home_currency->code,"foreigncurr" => $invoice->invoice_currency->code]) }}
                                :</span>
                            {{ $exchange_rate }}
                        </li>
                    @endif
                    @if($invoice->purchase_order_no != null)
                        <li>
                            <span>{{ trans('app.purchase_order_no') }}:</span>
                            {{ strtoupper($invoice->purchase_order_no) }}
                        </li>
                    @endif
                    @if($invoice->profile->custom_invoice_fields != null)
                        @foreach($profile->custom_invoice_fields as $invoicefield)
                            @php
                                $fieldvalue = $invoice->custom_invoice_field_values->where('custom_invoice_field_id', $invoicefield->id)->first();
                                if($fieldvalue != null):
                                $fielddataset = $fieldvalue;
                                $fieldvalue = $fieldvalue->field_value;
                                else:
                                $fieldvalue = null;
                                endif;
                            @endphp
                            @if($fieldvalue != null)
                                <li>
                                    <span>{{ $fielddataset->custom_invoice_field->field_name }}:</span>
                                    {{ strtoupper($fieldvalue) }}
                                </li>
                            @endif
                        @endforeach
                    @endif
                    @if($invoice->payment_transaction != null)
                        <li>
                            <span>{{ trans('app.paid') }}:</span>
                            {{ CustomHelper::dateShortRaw($invoice->payment_transaction->update_at) }}
                        </li>
                    @endif
                    @if($invoice->cash_receipt != null)
                        <li>
                            <span>{{ trans_choice('app.cash_receipt',1) }}:</span>
                            {{ $profile->profile_billing->cash_receipt_number_prefix }}{{ $invoice->cash_receipt->cash_receipt_no }}
                        </li>
                    @endif
                </ul>
            </td>
        </tr>
        <tr>
            <td class="tg-yw4l top" rowspan="4">
                <div class="">
                    @if($invoice->profile_customer != null)
                        <span style="text-transform:uppercase; font-weight:bold;">{{ ucwords($invoice->profile_customer->business_name) }}</span>
                        <span style="text-transform:uppercase; font-weight:normal;"><br><i>{{ ucwords($invoice->profile_customer->account_number) }}</i><br></span>
                    @endif
                    @if($invoice->customer != null)
                        <span style="text-transform:uppercase; font-weight:bold;">{{ $customernames }}</span>
                        @if(($invoice->customer->company) && ($invoice->customer->company != ''))
                            <span style="text-transform:uppercase; font-weight:normal;"><br><i>{{ ucwords($invoice->customer->company) }}</i><br></span>
                        @endif
                    @endif
                        @if(($invoice->profile_customer != null) && ($invoice->profile_customer->profile_billing != null) && ($invoice->profile_customer->profile_billing->tax_number != null) && ($invoice->profile_customer->profile_billing->tax_number != ''))
                            <div style="text-transform:uppercase;">{{ ucwords(trans('app.tax_number')) }}
                                <i>{{ ucwords($invoice->profile_customer->profile_billing->tax_number) }}</i>
                            </div>
                        @endif
                        @if(($invoice->customer != null)  && ($invoice->customer->tax_number != null) && ($invoice->customer->tax_number != ''))
                            <div style="text-transform:uppercase;">{{ ucwords(trans('app.tax_number')) }}
                                <i>{{ ucwords($invoice->customer->tax_number) }}</i>
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
                    @if($invoice->profile_customer != null)
                        @if(($invoice->profile_customer->business_phone) && ($invoice->profile_customer->business_phone != ''))
                            <br>{{ trans('app.tel') }}:
                            +{{ $invoice->profile_customer->business_phone }}
                        @endif
                    @endif
                    @if($invoice->customer != null)
                        @if(($invoice->customer->mobile_no) && ($invoice->customer->mobile_no != ''))
                            <br>{{ trans('app.tel') }}: +{{ $invoice->customer->mobile_no }}
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
        @if($invoice->optional_reference != null)
            <tr>
                <td class="tg-yw4l" colspan="3" align="right">
                    <strong>{{ trans('app.reference') }}
                        : </strong> {{ $invoice->optional_reference }}
                </td>
            </tr>
        @endif
        <tr>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
        </tr>
        @if($invoice->invoice_message != null)
            <tr>
                <td class="tg-yw4l vspace10" colspan="3" align="center">
                    <code style="text-transform:uppercase; padding:3px; font-weight:bold; color:#000000;">
                        {!! $invoice->invoice_message !!}
                    </code>
                </td>
            </tr>
        @endif
    </table>
    <div class="vspace10">
        &nbsp;
    </div>
    <table class="tg" width="100%">
        <thead>
        <tr>
            <td class="tg-yw4l items uppercase bold thickline vspace10">{{ trans('app.item_description') }}</td>
            <td class="tg-yw4l items uppercase text-right bold thickline vspace10">{{ trans('app.amount') }}</td>
            <td class="tg-yw4l items uppercase text-center bold thickline vspace10">{{ trans('app.quantity') }}</td>
            <td class="tg-yw4l items uppercase text-right bold thickline vspace10">{{ trans('app.total') }}@if($invoice->home_currency->code != $invoice->invoice_currency->code) {{ $invoice->home_currency->code }} @endif</td>
            @if($invoice->home_currency->code != $invoice->invoice_currency->code)
                <td class="tg-yw4l items uppercase text-right bold thickline vspace10">{{ strtoupper(trans('app.total')) }} {{ $invoice->invoice_currency->code }}</td>
            @endif
        </tr>
        </thead>
        <tbody>
        @if($invoice->invoice_items->count() > 0)
            @foreach($invoice->invoice_items as $item)
                @php
                    if(preg_match("/\|\|/",$item->description)):
                        $breakapart = explode('||',$item->description);
                        if(isset($breakapart[0])):
                            $item->description = $breakapart[0];
                        endif;
                        if(isset($breakapart[1])):
                            $item->description .= "<small><i>" . implode(' / ',array_splice($breakapart, 1)) . "</i></small>";
                        endif;
                    endif;
                @endphp
                <tr>
                    <td class="tg-yw4l items borderbottom">{!! $item->description !!}</td>
                    <td class="tg-yw4l items borderbottom text-right">{{ number_format($item->item_amount,2) }}
                    </td>
                    <td class="tg-yw4l items borderbottom text-center">{{ $item->quantity }}</td>
                    <td class="tg-yw4l items borderbottom text-right">{{ number_format($item->total_amount,2) }}
                    @if($invoice->home_currency->code != $invoice->invoice_currency->code)
                        <td class="tg-yw4l items borderbottom text-right">
                            {{ number_format($item->exchange_amount,2) }}
                        </td>
                    @endif
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                @if(($profile->profile_billing->tax_number != null) && ($profile->profile_billing->tax_number != ''))
                    <td class="tg-yw4l items text-right bold">{{ strtoupper(trans('app.sub_total')) }}</td>
                @else
                    <td class="tg-yw4l items text-right bold">{{ strtoupper(trans('app.total')) }}</td>
                @endif
                @if(ctype_alpha($invoice->home_currency->symbol))
                    <td class="tg-yw4l items text-right bold"> {{ $invoice->home_currency->code }} {{ number_format($invoice->total_amount-$invoice->tax_amount,2) }}</td>
                @else
                    <td class="tg-yw4l items text-right bold">{{ $invoice->home_currency->symbol }}{{ number_format($invoice->total_amount-$invoice->tax_amount,2) }} </td>
                @endif
                @if($invoice->home_currency->code != $invoice->invoice_currency->code)
                    @if(ctype_alpha($invoice->invoice_currency->symbol))
                        <td class="tg-yw4l items text-right bold">{{ $invoice->invoice_currency->code }} {{ number_format(($invoice->total_amount-$invoice->tax_amount)*$exchange_rate,2) }} </td>
                    @else
                        <td class="tg-yw4l items text-right bold"> {{ $invoice->invoice_currency->symbol }}{{ number_format(($invoice->total_amount-$invoice->tax_amount)*$exchange_rate,2) }}</td>
                    @endif
                @endif
            </tr>
            @if(($profile->profile_billing->tax_number != null) && ($profile->profile_billing->tax_number != ''))
                <tr>
                    <td></td>
                    <td></td>
                    <td class="tg-yw4l items text-right"> @if($invoice->tax_configuration != null) {{ $invoice->tax_configuration->title }} @ {{ $invoice->tax_configuration->percentage }}
                        % @endif</td>
                    @if(ctype_alpha($invoice->home_currency->symbol))
                        <td class="tg-yw4l items text-right"> {{ $invoice->home_currency->code }} {{ number_format($invoice->tax_amount,2) }}</td>
                    @else
                        <td class="tg-yw4l items text-right">{{ $invoice->home_currency->symbol }}{{ number_format($invoice->tax_amount,2) }} </td>
                    @endif
                    @if($invoice->home_currency->code != $invoice->invoice_currency->code)
                        @if(ctype_alpha($invoice->invoice_currency->symbol))
                            <td class="tg-yw4l items text-right">{{ $invoice->invoice_currency->code }} {{ number_format($invoice->tax_amount*$exchange_rate,2) }} </td>
                        @else
                            <td class="tg-yw4l items text-right"> {{ $invoice->invoice_currency->symbol }}{{ number_format($invoice->tax_amount*$exchange_rate,2) }}</td>
                        @endif
                    @endif
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="tg-yw4l items text-right bold">{{ strtoupper(trans('app.total_amount')) }}</td>
                    @if(ctype_alpha($invoice->home_currency->symbol))
                        <td class="tg-yw4l items text-right bold"> {{ $invoice->home_currency->code }} {{ number_format($invoice->total_amount,2) }}</td>
                    @else
                        <td class="tg-yw4l items text-right bold">{{ $invoice->home_currency->symbol }}{{ number_format($invoice->total_amount,2) }} </td>
                    @endif
                    @if($invoice->home_currency->code != $invoice->invoice_currency->code)
                        @if(ctype_alpha($invoice->invoice_currency->symbol))
                            <td class="tg-yw4l items text-right bold">{{ $invoice->invoice_currency->code }} {{ number_format($invoice->total_amount*$exchange_rate,2) }} </td>
                        @else
                            <td class="tg-yw4l items text-right bold"> {{ $invoice->invoice_currency->symbol }}{{ number_format($invoice->total_amount*$exchange_rate,2) }}</td>
                        @endif
                    @endif
                </tr>
            @endif
        @endif
        </tbody>
    </table>
    @if(($profile->profile_billing->default_invoice_text != null) && ($profile->profile_billing->default_invoice_text != ''))
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
                                    {!! $profile->profile_billing->default_invoice_text !!}
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    @endif
@endsection