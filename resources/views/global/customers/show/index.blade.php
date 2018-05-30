<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ trans('app.customer_information') }}
                <span class="btn btn-xs btn-success" data-toggle="modal" data-target="#ajaxmodel"
                      data-remote="{{ url(Session::get('guard') . '/customers/' . $customer->id . '/edit') }}">
                            {{ trans('app.edit') }}
                        </span>
                <div class="pull-right">
                    <div class="btn-group m-r-10">
                        <button aria-expanded="false" data-toggle="dropdown"
                                class="btn btn-xs btn-info dropdown-toggle"
                                type="button">{{ trans('app.more_options') }} <span class="caret"></span></button>
                        <ul role="menu" class="dropdown-menu">
                            <li>
                                <a href="{{ url(Session::get('guard') . '/customers/' . $customer->id . '/send_mail') }}"
                                   class="fetchajaxpage">{{ trans('app.send_email') }}</a></li>
                            @if (Session::get('app_settings')->disable_sms == 0)
                                <li>
                                    <a href="{{ url(Session::get('guard') . '/customers/' . $customer->id . '/send_sms') }}"
                                       class="fetchajaxpage">{{ trans('app.send_sms') }}</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div>
                    <ul class="linelist col-md-6">
                        <li>
						<span>{{ trans('app.customer_since') }}:
						</span> {{ CustomHelper::dateLong($customer->created_at) }}
                        </li>
                        @if($customer->company != null)
                            <li>
						            <span>
                                        {{ trans('app.company') }}:
						            </span>
                                {{ $customer->company }}
                            </li>
                        @endif
                        <li>
						            <span>
                                        {{ trans('app.timezone') }}:
						            </span>
                            {{ CustomHelper::reverseUscore($customer->timezone) }}
                        </li>
                        <li>
						            <span>
                                        {{ trans('app.default_paper_size') }}:
						            </span>
                            {{ $customer->paper_size }}
                        </li>
                    </ul>
                    <ul class="linelist col-md-6">
                        <li>
						<span>{{ trans('app.email_address') }}:
						</span> {{ $customer->email }}
                        </li>
                        <li>
						<span>{{ trans('app.mobile_number') }}:
						</span> +{{ $customer->mobile_no }}
                        </li>
                        <li>
						            <span>
                                        {{ trans('app.default_currency') }}:
						            </span>{{ CustomHelper::getCurrency($customer->default_currency,'name') }}
                        </li>
                        @if(($customer->tax_number != null) && ($customer->tax_number != ''))
                            <li>
						            <span>
                                        {{ trans('app.tax_number') }}:
						            </span>{{ $customer->tax_number }}
                            </li>
                        @endif
                        <li>
						            <span>
                                        {{ trans('app.account_balance') }}:
						            </span>{{ number_format($customer->accountBalance,2) }} {{ $profile->profile_billing->default_currency }}
                        </li>
                    </ul>
                    <div class="clearfix">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>