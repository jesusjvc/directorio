<div class="row">
    @if(isset($stats))
        @foreach($stats as $key => $value)
            <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="white-box">
                    <h3 class="box-title">
                        <small class="pull-right m-t-10 text-success">
                            {{--@if($stats[$key]['compared_to_average'] < 0)--}}
                            {{--<i class="fa fa-sort-asc"></i>--}}
                            {{--{{ (abs($stats[$key]['compared_to_average'])) }}% {{ trans('app.compared_to_average') }}--}}
                            {{--@else--}}
                            {{--<i class="fa fa-sort-desc"></i>--}}
                            {{--{{ $stats[$key]['compared_to_average'] }}% {{ trans('app.compared_to_average') }}--}}
                            {{--@endif--}}
                            {{ trans('app.average') }}
                            : {{ $stats[$key]['average_value'] }} {{ Auth::guard(Session::get('guard'))->user()->profile->profile_billing->default_currency }}
                        </small>
                        {{ trans('app.' . $key) }}
                    </h3>
                    <div class="stats-row">
                        <div class="stat-item">
                            <h6>{{ trans('app.total') }}</h6>
                            <b>{{ $stats[$key]['total_value'] }}</b></div>
                        {{--<div class="stat-item">--}}
                        {{--<h6>{{ trans('app.average') }}</h6>--}}
                        {{--<b>{{ $stats[$key]['average_value'] }}</b>--}}
                        {{--</div>--}}
                        <div class="stat-item">
                            <h6>{{ trans('app.highest') }}</h6>
                            <b>{{ $stats[$key]['maximum']['label'] }}</b>
                        </div>
                    </div>
                    <div id="{{ $key }}"></div>
                </div>
            </div>
        @endforeach
    @endif
</div>
