@php
    if(Session::get('guard') != 'profilecontrol'):
        if(isset($profile)):
        $modifylink = $profile->id . '/profile_';
        else:
        $modifylink = null;
        endif;
    else:
    $modifylink = null;
    endif;
@endphp
<div class="reload">
    <div class="panel-body">
        @if(Session::get('profile_settings')->profile_billing->disable_online_payments == 1)
            <div class="alert alert-warning text-center"> {{ trans('app.warning_online_payments_are_disabled_under_the_profile_billing_section') }} </div>
        @endif
        @if(($enabledgateways == 0) && (isset($profile)))
            <div class="alert alert-danger text-center"> {{ trans('app.theprofile_has_no_payment_gateways_enabled',["theprofile" => $profile->business_name]) }} </div>
        @endif
        @if(($enabledgateways == 0) && (!isset($profile)))
            <div class="alert alert-danger text-center"> {{ trans('app.warning_you_have_no_active_payment_gateways_configured') }} </div>
        @endif
        @if($gateways->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>
                            {{ trans('app.gateway_channel') }}
                        </th>
                        <th>
                            {{ trans('app.configured_title') }}
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
                    @foreach($gateways as $gateway)
                        <tr>
                            <td @if(($gateway->status == 0) || (($gateway->static_payment_gateway->process_method == 1) && (Session::get('profile_settings')->profile_billing->disable_online_payments == 1))) style="text-decoration: line-through" @endif >{{ $gateway->static_payment_gateway->gateway_name }}
                            </td>
                            <td @if(($gateway->status == 0) || (($gateway->static_payment_gateway->process_method == 1) && (Session::get('profile_settings')->profile_billing->disable_online_payments == 1))) style="text-decoration: line-through" @endif >{{ $gateway->payment_method_name }}
                            </td>
                            <td class="text-right">
                                <span class="btn btn-primary btn-xs" data-toggle="modal" data-target="#ajaxmodel"
                                        data-remote="{{ url(Session::get('guard') . '/' . $modifylink . 'payment_gateways/'.$gateway->id.'/edit') }}">{{ trans('app.edit') }}</span>
                            </td>
                            <td class="text-right">
                                <span class="btn btn-danger btn-xs postconfirm" data-deleteid="ab{{ $gateway->id }}"
                                        data-title="{{ trans('app.delete_payment_gateway') }}"
                                        data-description="{!! trans('app.are_you_sure_you_want_to_delete_the_payment_gateway_paymentgateway',["paymentgateway" => "<i>$gateway->payment_method_name</i>"]) !!}"
                                        data-reloadurl="{{ url(Session::get('guard') . '/' . $modifylink . 'payment_gateways') }}"
                                        data-posturl="{{ url(Session::get('guard') . '/' . $modifylink . 'payment_gateways/'.$gateway->id) }}">{{ trans('app.delete') }}</span>
                            </td>
                            <td class="text-right">
                                @if($gateway->status == 0)
                                    <span class="btn btn-success btn-xs confirmajaxpost"
                                            data-title="{{ trans('app.enable_payment_gateway') }}"
                                            data-description="{!! trans('app.are_you_sure_you_want_to_enable_the_payment_gateway_paymentgateway',["paymentgateway" => "<i>$gateway->payment_method_name</i>"]) !!}"
                                            data-posturl="{{ url(Session::get('guard') . '/' . $modifylink . 'payment_gateways/'.$gateway->id.'/enable') }}"
                                            data-reloadurl="{{ url(Session::get('guard') . '/' . $modifylink . 'payment_gateways') }}">{{ trans('app.enable') }}</span>
                                @endif
                                @if($gateway->status == 1)
                                    <span class="btn btn-warning btn-xs confirmajaxpost"
                                            data-title="{{ trans('app.disable_payment_gateway') }}"
                                            data-description="{!! trans('app.are_you_sure_you_want_to_disable_the_payment_gateway_paymentgateway',["paymentgateway" => "<i>$gateway->payment_method_name</i>"]) !!}"
                                            data-posturl="{{ url(Session::get('guard') . '/' . $modifylink . 'payment_gateways/'.$gateway->id.'/disable') }}"
                                            data-reloadurl="{{ url(Session::get('guard') . '/' . $modifylink . 'payment_gateways') }}">{{ trans('app.disable') }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>