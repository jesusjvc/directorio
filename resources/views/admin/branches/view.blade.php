<div class="reload">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.branch') }}: {{ $branch->branch_name }}
                    <div class="pull-right">
                        <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/branches') }}"
                           class="fetchajaxpage">
                                    <span class="btn btn-xs btn-primary">
                                        {{ trans('app.go_back') }}
                                    </span>
                        </a>
                    </div>
                </div>
                <div class="panel-heading">
                    <div class="pull-right">
                    <a href="{{ url(Session::get('guard') . '/appointment_text_notifications/' . $branch->id) }}"
                       class="fetchajaxpage">
                                    <span class="btn btn-xs btn-success">
                                        {{ trans('app.text_notifications') }}
                                    </span>
                    </a>
                    <a href="{{ url(Session::get('guard') . '/appointment_call_notifications/' . $branch->id) }}"
                       class="fetchajaxpage">
                                    <span class="btn btn-xs btn-success">
                                        {{ trans('app.call_notifications') }}
                                    </span>
                    </a>
                    <a href="{{ url(Session::get('guard') . '/scheduled_text_notifications/' . $branch->id) }}"
                       class="fetchajaxpage">
                                    <span class="btn btn-xs btn-warning">
                                        {{ trans('app.scheduled_text_notifications') }}
                                    </span>
                    </a>
                    <a href="{{ url(Session::get('guard') . '/scheduled_call_notifications/' . $branch->id) }}"
                       class="fetchajaxpage">
                                    <span class="btn btn-xs btn-warning">
                                        {{ trans('app.scheduled_call_notifications') }}
                                    </span>
                    </a>
                    {{--<a href="{{ url(Session::get('guard') . '/' . $profile->id . '/did_number/' . $branch->id) }}"--}}
                       {{--class="fetchajaxpage">--}}
                                    {{--<span class="btn btn-xs btn-primary">--}}
                                        {{--{{ trans('app.did_numbers') }}--}}
                                    {{--</span>--}}
                    {{--</a>--}}
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <h4>{{ trans('app.business_hours') }}</h4>
                    <div>
                        <ul class="linelist col-md-12">
                            @foreach($businesshours as $key => $value)
                                <li class="col-lg-3 col-md-6 col-md-3">
						<span>{{ trans('app.' . $key) }}:
						</span> {{ $value }}
                                </li>
                            @endforeach
                        </ul>
                        <div class="clearfix">
                        </div>
                    </div>
                    <h4 class="m-t-30">{{ trans('app.facilities') }}</h4>
                    <p>{{ $branch->facilities }}</p>
                </div>
                <div class="panel-footer text-right">
                    x
                </div>
            </div>
        </div>
    </div>
</div>