<div class="reload">
    <div class="panel-body">
        <p class="text-muted">
        <i>
            {{ trans('app.in_order_to_assign_a_did_number_to_a_profile_a_sell_per_month_value_must_be_set_and_be_greater_than_zero') }}
        </i>
        </p>
        @if($numbers->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>
                            {{ trans('app.number') }}
                        </th>
                        <th>
                            {{ trans('app.assigned_to') }}
                        </th>
                        <th>
                            {{ trans('app.gateway_provider') }}
                        </th>
                        <th>
                            {{ trans('app.geo_country') }}
                        </th>
                        <th class="text-right">{{ trans('app.cost_per_month') }}
                        </th>
                        <th class="text-right">{{ trans('app.sell_per_month') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                        <th>
                            &nbsp;
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($numbers as $number)
                        <tr>
                            <td @if ($number->status == 0) style="text-decoration: line-through"
                                class="text-danger" @endif>
                                +{{ $number->did_number }}
                            </td>
                            <td>@if($number->profile != null) {{ $number->profile->business_name }} @elseif($number->branch != null) {{ $number->branch->branch_name }} @else - @endif
                            </td>
                            <td>{{ ucwords($number->static_sms_provider->sms_gateway_provider) }}
                            </td>
                            <td @if ($number->status == 0) class="strikeout" @endif>{{ $number->country }}
                            </td>
                            <td class="text-right">{{ Session::get('profile_settings')->profile_billing->default_currency_symbol }}{{ $number->cost_per_month }}
                            </td>
                            <td class="text-right">{{ Session::get('profile_settings')->profile_billing->default_currency_symbol }}{{ $number->sell_per_month }}
                            </td>
                            <td class="text-right">
                                <span class="btn btn-primary btn-xs" data-toggle="modal" data-target="#ajaxmodel"
                                      data-remote="{{ url(Session::get('guard') . '/sms_did_numbers/'.$number->id.'/edit') }}">{{ trans('app.edit') }}</span>
                            </td>
                            <td class="text-right">
                                @if(($number->isdefault != 1) && ($number->status == 0))
                                    <span class="btn btn-danger btn-xs postconfirm"
                                          data-title="{{ trans('app.delete_did_number') }}"
                                          data-description="{{ trans('app.are_you_sure_you_want_to_delete_this_did_number') }} +{{ $number->did_number }}"
                                          data-reloadurl="{{ url(Session::get('guard') . '/sms_did_numbers') }}"
                                          data-posturl="{{ url(Session::get('guard') . '/sms_did_numbers/'.$number->id) }}">{{ trans('app.delete') }}</span>
                                @endif
                            </td>
                            <td class="text-right">
                                @if(($number->status == 1) && (($number->static_sms_provider->sms_gateway_provider == 'twilio') || ($number->static_sms_provider->sms_gateway_provider == 'nexmo')))
                                    <span class="btn btn-success btn-xs" data-toggle="modal" data-target="#ajaxmodel"
                                          data-remote="{{ url(Session::get('guard') . '/sms_did_numbers/'.$number->id.'/validate') }}">{{ trans('app.validate') }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            {{ trans('app.no_data_found') }}
        @endif
    </div>
</div>