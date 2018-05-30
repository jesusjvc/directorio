@extends(Session::get('guard') . '.layouts.app') @section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.dashboard') }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        @include('profilecontrol.dashboard.includes.limitssummary')
        @if((Auth::guard(Session::get('guard'))->user()->isuser == 1) || (Auth::guard(Session::get('guard'))->user()->isreception == 1))
        @include('profilecontrol.dashboard.includes.balances')
        @include('profilecontrol.dashboard.includes.piecharts')
        @include('profilecontrol.dashboard.includes.sparkline')
{{--        @include('profilecontrol.dashboard.includes.upcomingsubscriptions')--}}
        @endif
        @include('profilecontrol.dashboard.includes.appointments')
    </div>
@endsection
@push('head')
<link href="{{ url('assets') }}/plugins/bower_components/morrisjs/morris.css" rel="stylesheet">

@endpush
@push('javascript')
<script src="{{ url('assets') }}/plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
<script src="{{ url('assets') }}/plugins/bower_components/counterup/jquery.counterup.min.js"></script>
<!--Morris JavaScript -->
<script src="{{ url('assets') }}/plugins/bower_components/raphael/raphael-min.js"></script>
<script src="{{ url('assets') }}/plugins/bower_components/morrisjs/morris.js"></script>
<script type="text/javascript">
    Morris.Area({
        element: 'morris-area-chart',
        data: [
                @foreach($appointmentsChart as $appointments)
            {
                period: "{{ $appointments['period'] }}",
                active: {{ $appointments['active'] }},
                cancelled: {{ $appointments['cancelled'] }},
                rescheduled: {{ $appointments['rescheduled'] }}
            },
            @endforeach
        ],
        xkey: 'period',
        ykeys: ['active', 'cancelled', 'rescheduled'],
        labels: ["{{ trans('app.active') }}", "{{ trans('app.cancelled') }}", "{{ trans('app.rescheduled') }}"],
        pointSize: 3,
        fillOpacity: 0,
        pointStrokeColors: ['#00bfc7', '#fb9678', '#9675ce'],
        behaveLikeLine: true,
        gridLineColor: '#e0e0e0',
        lineWidth: 3,
        hideHover: 'auto',
        lineColors: ['#00bfc7', '#fb9678', '#9675ce'],
        resize: true

    });

    Morris.Donut({
        element: 'totalsales',
        data: [
                @foreach($totalsales as $key => $totalsale)
            {
                label: "{{ trans('app.' . $key) }}",
                value: {{ number_format((float)$totalsale, 2, '.', '') }},

            },
            @endforeach
        ],
        resize: true,
        colors: ['#99d683', '#13dafe', '#6164c1', '#e44006', '#ffee54'],
        formatter: function (x) { return parseFloat(Math.round(x * 100) / 100).toFixed(2) }
    });

    Morris.Donut({
        element: 'totalquotations',
        data: [
                @foreach($totalquotations as $key => $totalquotation)
            {
                label: "{{ trans('app.' . $key) }}",
                value: {{ number_format((float)$totalquotation, 2, '.', '') }},

            },
            @endforeach
        ],
        resize: true,
        colors: ['#99d683', '#13dafe', '#6164c1', '#e44006', '#ffee54'],
        formatter: function (x) { return parseFloat(Math.round(x * 100) / 100).toFixed(2) }
    });

    Morris.Donut({
        element: 'total_payments',
        data: [
                @foreach($totalpayments as $key => $totalpayment)
            {
                label: "{{ trans('app.' . $key) }}",
                value: {{ number_format((float)$totalpayment, 2, '.', '') }},

            },
            @endforeach
        ],
        resize: true,
        colors: ['#99d683', '#13dafe', '#6164c1', '#e44006', '#ffee54'],
        formatter: function (x) { return parseFloat(Math.round(x * 100) / 100).toFixed(2) }
    });

    Morris.Donut({
        element: 'total_credit_notes',
        data: [
                @foreach($totalcreditnotes as $key => $totalcreditnote)
            {
                label: "{{ trans('app.' . $key) }}",
                value: {{ number_format((float)$totalcreditnote, 2, '.', '') }},

            },
            @endforeach
        ],
        resize: true,
        colors: ['#99d683', '#13dafe', '#6164c1', '#e44006', '#ffee54'],
        formatter: function (x) { return parseFloat(Math.round(x * 100) / 100).toFixed(2) }
    });

</script>
@if(isset($stats))
    <!-- Sparkline charts -->
    <script src="{{ url('assets') }}/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var sparklineLogin = function () {
                @foreach($stats as $key => $value)

                @if(count($stats[$key]['daterange']) > 0)
                   $("#{{ $key }}").sparkline([@foreach($stats[$key]['daterange'] as $instance) {{ $instance['value'] }}, @endforeach], {
                    type: 'line',
                    width: '100%',
                    height: '50',
                    lineColor: '{{ $stats[$key]['chartcolor'] }}',
                    fillColor: '{{ $stats[$key]['chartcolor'] }}',
                    maxSpotColor: '{{ $stats[$key]['chartcolor'] }}',
                    highlightLineColor: 'rgba(0, 0, 0, 0.2)',
                    highlightSpotColor: '{{ $stats[$key]['chartcolor'] }}',
                    tooltipFormat: '@{{offset:offset}} @{{value}}',
                    tooltipValueLookups: {
                        'offset': {
                @php $i = 0; @endphp
                @foreach($stats[$key]['daterange'] as $instance) {{ $i }}:
                '{{ trans('app.' . $instance['label']) }}', @php $i++; @endphp
                @endforeach
            }
            },
            })
                ;
                @endif
                @endforeach

            }
            var sparkResize;

            $(window).resize(function (e) {
                clearTimeout(sparkResize);
                sparkResize = setTimeout(sparklineLogin, 500);
            });
            sparklineLogin();

        });
    </script>
@endif
@endpush