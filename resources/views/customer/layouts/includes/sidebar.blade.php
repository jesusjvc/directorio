<div class="right-sidebar">
    <div class="slimscrollright">
        <div class="rpanel-title"> {{ trans('app.account_balances') }} <span><i class="ti-close right-side-toggle"></i></span>
        </div>
        <div class="r-panel-body">
            <ul>
                <div class="topup">
                    @foreach(Auth::guard('customer')->user()->profile as $profile)
                        <li class="text-right">{{ $profile->business_name }}:
                            <br>{{ number_format(Auth::guard('customer')->user()->accountBalance(Auth::guard('customer')->user()->id,$profile->id),2) }} {{ $profile->profile_billing->default_currency }}
                        </li>

                        <ul>
                            <li class="text-right">
                                <a href="{{ url(Session::get('guard') . '/topup/' . $profile->thumbprint) }}"
                                   class="fetchajaxpage" data-reloaddiv="topup">
                            <span class="btn btn-success btn-xs" style="width:100%;">
                                {{ trans('app.top_up_your_account') }}
                            </span>
                                </a>
                            </li>
                        </ul>
                        <hr>
                    @endforeach
                </div>
            </ul>
        </div>
    </div>
</div>