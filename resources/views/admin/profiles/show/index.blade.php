<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ trans('app.profile_information') }}
                <a href="{{ url(Session::get('guard') . '/profiles') }}/{{ $profile->id }}/edit/">
                    <span class="btn btn-xs btn-success">
                        {{ trans('app.edit') }}
                    </span>
                </a>
                @if(($profile->expiry_date > date('Y-m-d')) || ($profile->expiry_date == null))
                    <div class="pull-right">
                        <span class="btn btn-danger btn-xs postconfirm"
                              data-title="{{ trans('app.cancel_account') }}"
                              data-description="{{ trans('app.are_you_sure_you_want_to_cancel_the_account_of_profilename_if_you_cancel_this_account_all_data_will_remain_on_the_system_however_access_for_profilename_will_be_revoked_and_all_active_subscriptions_will_can_cancelled',['profilename' => "<i>" . $profile->business_name . "</i>"]) }}"
                              data-reloaddiv="reload"
                              data-redirect="{{ url(Session::get('guard') . '/profiles') }}"
                              data-posturl="{{ url(Session::get('guard') . '/profiles/' . $profile->id . '/cancel') }}">{{ trans('app.cancel_account') }}</span>
                    </div>
                @endif
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <div>
                    <ul class="linelist col-md-6">
                        <li>
						<span>{{ trans('app.member_since') }}:
						</span> {{ CustomHelper::dateLong($profile->created_at) }}
                        </li>
                        <li>
						<span>{{ trans('app.account_number') }}:
						</span> {{ $profile->account_number }}
                        </li>
                        <li>
						<span>{{ trans('app.email_address') }}:
						</span> {{ $profile->business_email }}
                        </li>
                        <li>
						<span>{{ trans('app.web_url') }}:
						</span> {{ $profile->business_url }}
                        </li>
                        <li>
						<span>{{ trans('app.contact_number') }}:
						</span> +{{ CustomHelper::digitsOnly($profile->business_phone) }}
                        </li>
                        <li>
						<span>{{ trans('app.default_sms_country_code') }}:
						</span> +{{ $profile->default_sms_country_code }}
                        </li>
                        <li>
						<span>{{ trans('app.timezone') }}:
						</span> {{ CustomHelper::reverseUscore($profile->timezone) }}
                        </li>
                        <li>
						<span>{{ trans('app.default_paper_size') }}:
						</span> {{ $profile->paper_size }}
                        </li>

                    </ul>
                    <ul class="linelist col-md-6">
                        <li>
						<span>{{ trans('app.address_1') }}:
						</span> {{ $profile->business_address_1 }}
                        </li>
                        <li>
						<span>{{ trans('app.address_2') }}:
						</span> {{ $profile->business_address_2 }}
                        </li>
                        <li>
						<span>{{ trans('app.city') }}:
						</span> {{ $profile->business_city }}
                        </li>
                        <li>
						<span>{{ trans('app.state') }}:
						</span> {{ $profile->business_state }}
                        </li>
                        <li>
						<span>{{ trans('app.zip_code') }}:
						</span> {{ $profile->business_zip }}
                        </li>
                        <li>
						<span>{{ trans_choice('app.country',1) }}:
						</span> {{ $profile_country }}
                        </li>
                        <li>
						<span>{{ trans('app.account_balance') }}:
						</span> {{ number_format($profile->accountBalance,2) }} {{ Session::get('profile_settings')->profile_billing->default_currency }}
                        </li>
                        @if (Session::get('app_settings')->disable_sms == 0)
                        <li>
						<span>{{ trans('app.airtime_balance') }}:
						</span> {{ number_format($profile->airtimebalance,2) }} {{ Session::get('profile_settings')->profile_billing->default_currency }}
                        </li>
                            @endif
                    </ul>
                    <div class="clearfix">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>