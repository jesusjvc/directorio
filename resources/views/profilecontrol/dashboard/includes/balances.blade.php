<div class="row">
    @foreach($headlines as $key => $headline)
        <div class="col-lg-3 col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">{{ trans('app.' . $key) }}</h3>
                <ul class="list-inline">
                    <li class="text-left"><span class="counter" style="font-weight:400;">
                            @if(($key == 'account_balance') || ($key == 'airtime_balance'))
                                {{ number_format($headline,2) }} {{ Session::get('profile_settings')->profile_billing->default_currency }}</span>
                        @else
                            {{ number_format($headline) }}
                        @endif
                        @if(($key == 'account_balance') && ($headline < 0))
                            <small><i>{{ trans('app.due') }}</i></small>
                        @elseif(($key == 'account_balance') && ($headline > 0))
                            <small><i>{{ trans('app.cr') }}</i></small>
                        @elseif(($key == 'airtime_balance') && ($headline < 0))
                            <small><i>{{ trans('app.due') }}</i></small>
                        @elseif(($key == 'airtime_balance') && ($headline > 0))
                            <small><i>{{ trans('app.cr') }}</i></small>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    @endforeach
</div>
