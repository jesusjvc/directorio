@extends('documents.layout')
@section('content')
    @php
        $profile = $quotation->profile;
    @endphp
    @if($quotation->profile_customer != null)
        <footer>
            @if(($profile->profile_billing->custom_financial_footer != null) && ($profile->profile_billing->custom_financial_footer != ''))
                {{ $profile->profile_billing->custom_financial_footer }}
                <br>
            @endif
            {!! trans('app.quotation_quote_no_addressed_to_customername',["quote_no" => $profile->profile_billing->quotation_number_prefix . $quotation->quotation_no,"customername" => ucwords($quotation->profile_customer->business_name)]) !!}
            @if($app_settings->show_system_footer_on_pdf == 1)
                - {{ trans('app.generated_by') }} {{ CustomHelper::wwwOnly($system_profile->business_url) }}
            @endif
            @if(($quotation->status == 2) && ($quotation->electronic_signature_token->electronic_signature_archive != null))
                <br>{{ trans('app.this_documenttype_was_signed_by_signedbywho_on_datewhensigned',["documenttype" => strtolower(trans('app.quotation')), "signedbywho" => ucwords($quotation->electronic_signature_token->electronic_signature_archive->signed_by_names) . ' (' . $quotation->electronic_signature_token->electronic_signature_archive->ip_address . ')', "datewhensigned" => CustomHelper::dateLong($quotation->electronic_signature_token->electronic_signature_archive->created_at)]) }}
            @endif
        </footer>
    @else
        @php
            $customernames = ucwords($quotation->customer->prefix . ' ' . $quotation->customer->firstname . ' ' . $quotation->customer->lastname)
        @endphp
        <footer>
            @if(($profile->profile_billing->custom_financial_footer != null) && ($profile->profile_billing->custom_financial_footer != ''))
                {{ $profile->profile_billing->custom_financial_footer }}
                <br>
            @endif
                {!! trans('app.quotation_quote_no_addressed_to_customername',["quote_no" => $profile->profile_billing->quotation_number_prefix . $quotation->quotation_no,"customername" => $customernames]) !!}
            @if($app_settings->show_system_footer_on_pdf == 1)
                - {{ trans('app.generated_by') }} {{ CustomHelper::wwwOnly($system_profile->business_url) }}
            @endif
            @if(($quotation->status == 2) && ($quotation->electronic_signature_token->electronic_signature_archive != null))
                <br>{{ trans('app.this_documenttype_was_signed_by_signedbywho_on_datewhensigned',["documenttype" => strtolower(trans('app.quotation')), "signedbywho" => ucwords($quotation->electronic_signature_token->electronic_signature_archive->signed_by_names) . ' (' . $quotation->electronic_signature_token->electronic_signature_archive->ip_address . ')', "datewhensigned" => CustomHelper::dateLong($quotation->electronic_signature_token->electronic_signature_archive->created_at)]) }}
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
                @if($quotation->profile->business_logo != null)
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
                {{ trans('app.quotation') }}
            </td>
        </tr>
        <tr>
            <td class="tg-yw4l vspace10"></td>
            <td class="tg-yw4l vspace10"></td>
            <td class="tg-yw4l vspace10"></td>
        </tr>
        <tr>
            <td class="tg-yw4l documentto">{{ ucwords(trans('app.quotation_to')) }}</td>
            <td class=""></td>
            <td class="tg-yw4l top" rowspan="5">
                <ul class="linelist">
                    <li>
                        <span>{{ trans('app.quotation_no') }}:</span>
                        {{ $profile->profile_billing->quotation_number_prefix }}{{ $quotation->quotation_no }}
                    </li>
                    <li>
                        <span>{{ trans('app.quotation_date') }}:</span>
                        {{ CustomHelper::dateShort($quotation->quotation_date) }}
                    </li>
                    <li>
                        <span>{{ trans('app.expiry_date') }}:</span>
                        {{ CustomHelper::dateShort($quotation->expiry_date) }}
                    </li>
                    <li>
                        <span>{{ trans('app.document_status') }}:</span>
                        {{ strtoupper($quotation->textStatus) }}
                    </li>
                    <li>
                        <span>{{ trans('app.currency') }}:</span>
                        {{ $quotation->home_currency->code }}
                    </li>
                    @if($quotation->home_currency->code != $quotation->quotation_currency->code)
                        <li>
                            <span>{{ trans('app.foreign_currency') }}:</span>
                            {{ $quotation->quotation_currency->code }}
                        </li>
                        <li>
                            <span>{{ trans('app.homecurrforeigncurr_xrt',["homecurr" => $quotation->home_currency->code,"foreigncurr" => $quotation->quotation_currency->code]) }}
                                :</span>
                            {{ $exchange_rate }}
                        </li>
                    @endif
                </ul>
            </td>
        </tr>
        <tr>
            <td class="tg-yw4l top" rowspan="4">
                <div class="">
                    @if($quotation->profile_customer != null)
                        <span style="text-transform:uppercase; font-weight:bold;">{{ ucwords($quotation->profile_customer->business_name) }}</span>
                        <span style="text-transform:uppercase; font-weight:normal;"><br><i>{{ ucwords($quotation->profile_customer->account_number) }}</i><br></span>
                    @endif
                    @if($quotation->customer != null)
                        <span style="text-transform:uppercase; font-weight:bold;">{{ $customernames }}</span>
                        @if(($quotation->customer->company) && ($quotation->customer->company != ''))
                            <span style="text-transform:uppercase; font-weight:normal;"><br><i>{{ ucwords($quotation->customer->company) }}</i><br></span>
                        @endif
                    @endif
                    @if(($quotation->profile_customer != null) && ($quotation->profile_customer->profile_billing != null) && ($quotation->profile_customer->profile_billing->tax_number != null) && ($quotation->profile_customer->profile_billing->tax_number != ''))
                        <div style="text-transform:uppercase;">{{ ucwords(trans('app.tax_number')) }}
                            <i>{{ ucwords($quotation->profile_customer->profile_billing->tax_number) }}</i>
                        </div>
                    @endif
                    @if(($quotation->customer != null)  && ($quotation->customer->tax_number != null) && ($quotation->customer->tax_number != ''))
                        <div style="text-transform:uppercase;">{{ ucwords(trans('app.tax_number')) }}
                            <i>{{ ucwords($quotation->customer->tax_number) }}</i>
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
                    @if($quotation->profile_customer != null)
                        @if(($quotation->profile_customer->business_phone) && ($quotation->profile_customer->business_phone != ''))
                            <br>{{ trans('app.tel') }}:
                            +{{ $quotation->profile_customer->business_phone }}
                        @endif
                    @endif
                    @if($quotation->customer != null)
                        @if(($quotation->customer->mobile_no) && ($quotation->customer->mobile_no != ''))
                            <br>{{ trans('app.tel') }}: +{{ $quotation->customer->mobile_no }}
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
        @if($quotation->optional_reference != null)
            <tr>
                <td class="tg-yw4l" colspan="3" align="right">
                    <strong>{{ trans('app.reference') }}
                        : </strong> {{ $quotation->optional_reference }}
                </td>
            </tr>
        @endif
        <tr>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
            <td class="tg-yw4l"></td>
        </tr>
        @if($quotation->quotation_message != null)
            <tr>
                <td class="tg-yw4l vspace10" colspan="3" align="center">
                    <code style="text-transform:uppercase; padding:3px; font-weight:bold; color:#000000;">
                        {!! $quotation->quotation_message !!}
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
            <td class="tg-yw4l items uppercase text-right bold thickline vspace10">{{ trans('app.total') }}@if($quotation->home_currency->code != $quotation->quotation_currency->code) {{ $quotation->home_currency->code }} @endif</td>
            @if($quotation->home_currency->code != $quotation->quotation_currency->code)
                <td class="tg-yw4l items uppercase text-right bold thickline vspace10">{{ strtoupper(trans('app.total')) }} {{ $quotation->quotation_currency->code }}</td>
            @endif
        </tr>
        </thead>
        <tbody>
        @if($quotation->quotation_items->count() > 0)
            @foreach($quotation->quotation_items as $item)
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
                    @if($quotation->home_currency->code != $quotation->quotation_currency->code)
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
                @if(ctype_alpha($quotation->home_currency->symbol))
                    <td class="tg-yw4l items text-right bold"> {{ $quotation->home_currency->code }} {{ number_format($quotation->total_amount-$quotation->tax_amount,2) }}</td>
                @else
                    <td class="tg-yw4l items text-right bold">{{ $quotation->home_currency->symbol }}{{ number_format($quotation->total_amount-$quotation->tax_amount,2) }} </td>
                @endif
                @if($quotation->home_currency->code != $quotation->quotation_currency->code)
                    @if(ctype_alpha($quotation->quotation_currency->symbol))
                        <td class="tg-yw4l items text-right bold">{{ $quotation->quotation_currency->code }} {{ number_format(($quotation->total_amount-$quotation->tax_amount)*$exchange_rate,2) }} </td>
                    @else
                        <td class="tg-yw4l items text-right bold"> {{ $quotation->quotation_currency->symbol }}{{ number_format(($quotation->total_amount-$quotation->tax_amount)*$exchange_rate,2) }}</td>
                    @endif
                @endif
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td class="tg-yw4l items text-right"> @if($quotation->tax_configuration != null) {{ $quotation->tax_configuration->title }} @ {{ $quotation->tax_configuration->percentage }}
                    % @endif</td>
                @if(ctype_alpha($quotation->home_currency->symbol))
                    <td class="tg-yw4l items text-right"> {{ $quotation->home_currency->code }} {{ number_format($quotation->tax_amount,2) }}</td>
                @else
                    <td class="tg-yw4l items text-right">{{ $quotation->home_currency->symbol }}{{ number_format($quotation->tax_amount,2) }} </td>
                @endif
                @if($quotation->home_currency->code != $quotation->quotation_currency->code)
                    @if(ctype_alpha($quotation->quotation_currency->symbol))
                        <td class="tg-yw4l items text-right">{{ $quotation->quotation_currency->code }} {{ number_format($quotation->tax_amount*$exchange_rate,2) }} </td>
                    @else
                        <td class="tg-yw4l items text-right"> {{ $quotation->quotation_currency->symbol }}{{ number_format($quotation->tax_amount*$exchange_rate,2) }}</td>
                    @endif
                @endif
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td class="tg-yw4l items text-right bold">{{ strtoupper(trans('app.total_amount')) }}</td>
                @if(ctype_alpha($quotation->home_currency->symbol))
                    <td class="tg-yw4l items text-right bold"> {{ $quotation->home_currency->code }} {{ number_format($quotation->total_amount,2) }}</td>
                @else
                    <td class="tg-yw4l items text-right bold">{{ $quotation->home_currency->symbol }}{{ number_format($quotation->total_amount,2) }} </td>
                @endif
                @if($quotation->home_currency->code != $quotation->quotation_currency->code)
                    @if(ctype_alpha($quotation->quotation_currency->symbol))
                        <td class="tg-yw4l items text-right bold">{{ $quotation->quotation_currency->code }} {{ number_format($quotation->total_amount*$exchange_rate,2) }} </td>
                    @else
                        <td class="tg-yw4l items text-right bold"> {{ $quotation->quotation_currency->symbol }}{{ number_format($quotation->total_amount*$exchange_rate,2) }}</td>
                    @endif
                @endif
            </tr>
        @endif
        </tbody>
    </table>
    @if(($profile->profile_billing->default_quotation_text != null) && ($profile->profile_billing->default_quotation_text != ''))
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
                                    {!! $profile->profile_billing->default_quotation_text !!}
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    @endif
@endsection