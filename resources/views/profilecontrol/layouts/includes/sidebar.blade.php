<div class="right-sidebar">
    <div class="slimscrollright">
        <div class="rpanel-title"> {{ trans('app.account_balances') }} <span><i class="ti-close right-side-toggle"></i></span>
        </div>
        <div class="r-panel-body">
            <ul>
                <li class="text-right">{{ trans('app.account') }}
                    : {{ number_format(Session::get('accountBalance'),2) }} {{ Session::get('profile_settings')->profile_billing->default_currency }}</li>
                @if (Session::get('app_settings')->disable_sms == 0)
                    <li class="text-right">{{ trans('app.airtime') }}
                    : {{ number_format(Session::get('airtimeBalance'),2) }} {{ Session::get('profile_settings')->profile_billing->default_currency }}</li>
                    @endif
            </ul>
            <hr>
            <div class="topup">
                <ul>
                    <li class="text-right">
                        <a href="{{ url(Session::get('guard') . '/topup') }}" class="fetchajaxpage" data-reloaddiv="topup">
                            <span class="btn btn-success" style="width:100%;">
                                {{ trans('app.top_up_your_account') }}
                            </span>
                        </a>
                    </li>
                    @if (Session::get('app_settings')->disable_sms == 0)
                    @if(Session::get('accountBalance') > 1)
                        <li class="text-right">
                            <button class="btn btn-primary" style="width:100%;" data-toggle="modal"
                                    data-target="#ajaxmodel"
                                    data-remote="{{ url('profilecontrol/airtime/buy') }}">
                                {{ trans('app.buy_airtime') }}
                            </button>
                        </li>
                    @endif
                        @endif
                </ul>
            </div>
        </div>
    </div>
</div>