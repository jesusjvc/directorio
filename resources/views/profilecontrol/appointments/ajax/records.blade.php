<div class="reload" id="ajaxpaginateblock">
    <div class="panel panel-default">
        <div class="panel-heading">
            {{ trans('app.schedule_an_appointment_at_publicname_for_date', ["publicname"  =>  ucwords(trans('app.' . $agenda->user->prefix) . ' ' . $agenda->user->firstname . ' ' . $agenda->user->lastname), "date"  =>  CustomHelper::dateTimeShort(date('Y-m-d H:i:s', $timeslot))]) }}
            <div class="pull-right">
                <a href="{{ url('profilecontrol/appointments/' . $agenda->sharecode) }}">
                            <span class="btn btn-xs btn-primary">
                            {{ trans('app.cancel_and_go_back') }}
                            </span>
                </a>
            </div>
        </div>
        <div class="panel-body">
            <form method="GET" id="q"
                  action="{{ url(Session::get('guard') . '/appointments/' . $agenda->id . '/search/' . $timeslot) }}">
                <div class="row">
                    <div class="col-md-3 col-md-offset-8 col-sm-6">
                        <div class="form-group">
                            <input type="text" name="q" autocomplete="off" class="form-control"
                                   placeholder="{{ trans('app.search') }}" required>
                        </div>
                    </div>
                    <div class="col-md-1 col-cm-6">
                        <div class="form-group">
                                            <span class="input-group-btn">
						                        <button class="btn btn-sm btn-default"
                                                        type="submit">{{ trans('app.search') }}</button>
					                        </span>
                        </div>
                    </div>
                </div>
            </form>

            @if(last(explode('/',url()->current())) == 'search')
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <p>
                                {{ $customers->total() }} {{ trans_choice('app.result_foundresults_found',count($customers)) }}
                                <mark>{{ Request::input('q') }}</mark>
                            </p>
                            <p>
                                <a href="{{ url(Session::get('guard') . '/customers') }}"
                                   class="fetchajaxpage">{{ trans('app.reset_search') }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endif
            @if(count($customers) > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-left">
                                {{ trans('app.customer') }}
                            </th>
                            <th class="text-left">
                                {{ trans('app.email') }}
                            </th>
                            <th class="text-left">
                                {{ trans('app.mobile_no') }}
                            </th>
                            <th class="text-left">

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>
                                    {{ ucwords(trans('app.' . $customer->prefix) . ' ' . $customer->firstname . ' ' . $customer->lastname) }}

                                </td>
                                <td class="text-left">
                                    {{ $customer->email }}
                                </td>
                                <td class="text-left">
                                    +{{ $customer->mobile_no }}
                                </td>
                                <td class="text-left">
                                    <a href="{{ url(Session::get('guard') . '/appointments/' . $agenda->id . '/branch/' . $timeslot . '/customer/' . $customer->id) }}"
                                       class="fetchajaxpage"
                                       title="{{ trans('app.view_customer_namess_account',["customer_names" => ucwords(trans('app.' . $customer->prefix) . ' ' . $customer->firstname . ' ' . $customer->lastname)]) }}">
                                                    <span class="btn btn-outline btn-info btn-xs">
                                                        {{ trans('app.select') }}
                                                    </span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>
                    {{ trans('app.unable_to_proceed_no_customers_exist') }}
                </p>
            @endif
            <div class="panel-footer">
                <div class="text-center">
                    @if((count($customers) == 0) && (last(explode('/',url()->current())) != 'search'))
                        {{ trans('app.no_data_found') }}
                    @endif
                    @if((last(explode('/',url()->current())) == 'search') && (count($customers) > 0))
                        <a href="{{ url(Session::get('guard') . '/customers') }}"
                           class="fetchajaxpage">{{ trans('app.reset_search') }}</a>
                    @endif
                </div>
                @if(method_exists($customers,'links'))
                    <div align="center">
                        @if($customers->links())
                            <div align="center">
                                @if(Request::get('q'))
                                    {{ $customers->appends(['q' => Request::get('q')])->links() }}
                                @else
                                    {{ $customers->links() }}
                                @endif
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>