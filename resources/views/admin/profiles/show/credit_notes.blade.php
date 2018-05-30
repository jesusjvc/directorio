{{--<div class="reload">--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-12">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">--}}
                    {{--{{ trans('app.credit_notes') }}--}}
                    {{--<div class="pull-right">--}}
                        {{--<a href="{{ url(Session::get('guard') . '/credit_notes/create/p' . $profile->id) }}">--}}
                            {{--<span class="btn btn-xs btn-success">--}}
                                {{--{{ trans('app.issue_a_credit_note') }}--}}
                            {{--</span>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="panel-body">--}}
                    {{--xxx--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
@include(Session::get('guard') . '.credit_notes.ajaxpaginate.records')