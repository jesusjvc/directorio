@extends(Session::get('guard') . '.layouts.app') @section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.subscriptions') }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    {{--<div class="row">--}}
        {{--@if(isset($stats))--}}
            {{--@foreach($stats as $key => $value)--}}
                {{--<div class="col-md-4 col-sm-12 col-xs-12">--}}
                    {{--<div class="white-box">--}}
                        {{--<h3 class="box-title">--}}
                            {{--<small class="pull-right m-t-10 text-success">--}}
                                {{--@if($stats[$key]['compared_to_average'] < 0)--}}
                                    {{--<i class="fa fa-sort-asc"></i>--}}
                                    {{--{{ (abs($stats[$key]['compared_to_average'])) }}% {{ trans('app.compared_to_average') }}--}}
                                {{--@else--}}
                                    {{--<i class="fa fa-sort-desc"></i>--}}
                                    {{--{{ $stats[$key]['compared_to_average'] }}% {{ trans('app.compared_to_average') }}--}}
                                {{--@endif--}}
                                    {{--{{ trans('app.average') }}: {{ $stats[$key]['average_value'] }} {{ $profile->profile_billing->default_currency }}--}}
                            {{--</small>--}}
                            {{--{{ CustomHelper::reverseUscore($key) }}--}}
                        {{--</h3>--}}
                        {{--<div class="stats-row">--}}
                            {{--<div class="stat-item">--}}
                                {{--<h6>{{ trans('app.total') }}</h6>--}}
                                {{--<b>{{ $stats[$key]['total_value'] }}</b></div>--}}
                            {{--<div class="stat-item">--}}
                                {{--<h6>{{ trans('app.average') }}</h6>--}}
                                {{--<b>{{ $stats[$key]['average_value'] }}</b>--}}
                            {{--</div>--}}
                            {{--<div class="stat-item">--}}
                                {{--<h6>{{ trans('app.highest') }}</h6>--}}
                                {{--<b>{{ $stats[$key]['maximum']['label'] }}</b>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div id="{{ $key }}"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--@endforeach--}}
        {{--@endif--}}
    {{--</div>--}}

    @include(Session::get('guard') . '.subscriptions.ajaxpaginate.records')
@endsection @push('head') @endpush
@push('javascript')
{{--@if(isset($stats))--}}
    {{--<!-- Sparkline charts -->--}}
    {{--<script src="{{ url('assets') }}/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>--}}
    {{--<script type="text/javascript">--}}
        {{--$(document).ready(function () {--}}
            {{--var sparklineLogin = function () {--}}
                {{--@foreach($stats as $key => $value)--}}

                {{--@if(count($stats[$key]['daterange']) > 0)--}}
                   {{--$("#{{ $key }}").sparkline([@foreach($stats[$key]['daterange'] as $instance) {{ $instance['value'] }}, @endforeach], {--}}
                    {{--type: 'line',--}}
                    {{--width: '100%',--}}
                    {{--height: '50',--}}
                    {{--lineColor: '{{ $stats[$key]['chartcolor'] }}',--}}
                    {{--fillColor: '{{ $stats[$key]['chartcolor'] }}',--}}
                    {{--maxSpotColor: '{{ $stats[$key]['chartcolor'] }}',--}}
                    {{--highlightLineColor: 'rgba(0, 0, 0, 0.2)',--}}
                    {{--highlightSpotColor: '{{ $stats[$key]['chartcolor'] }}',--}}
                    {{--tooltipFormat: '@{{offset:offset}} @{{value}}',--}}
                    {{--tooltipValueLookups: {--}}
                        {{--'offset': {--}}
                {{--@php $i = 0; @endphp--}}
                {{--@foreach($stats[$key]['daterange'] as $instance) {{ $i }}:--}}
                {{--'{{ $instance['label'] }}', @php $i++; @endphp--}}
                {{--@endforeach--}}
            {{--}--}}
            {{--},--}}
            {{--});--}}
                {{--@endif--}}
                {{--@endforeach--}}

            {{--}--}}
            {{--var sparkResize;--}}

            {{--$(window).resize(function (e) {--}}
                {{--clearTimeout(sparkResize);--}}
                {{--sparkResize = setTimeout(sparklineLogin, 500);--}}
            {{--});--}}
            {{--sparklineLogin();--}}

        {{--});--}}
    {{--</script>--}}
{{--@endif--}}
@endpush