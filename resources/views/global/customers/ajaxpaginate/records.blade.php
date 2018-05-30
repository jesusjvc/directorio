<section class="records">
    <div class="reload" id="ajaxpaginateblock">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.customer_records') }}
                        <div class="pull-right">
                            <a href="{{ url(Session::get('guard') . '/customers/create/') }}">
                        <span class="btn btn-xs btn-success">
                            {{ trans('app.register_a_new_customer') }}
                        </span>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(Session::get('guard') == 'profilecontrol')
                            @if (($profile->subscription_package != null) && ($profile->subscription_package->limit_customer_accounts != 0) && ($profile->customers->count() >= $profile->subscription_package->limit_customer_accounts))
                                <p class="text-danger text-center">
                                    {{ trans('app.your_type_limit_has_been_reached_please_upgrade_your_subscription_package', ["type" => strtolower(trans('app.customer')), "limit" => $profile->subscription_package->limit_customer_accounts]) }}
                                </p>
                            @endif
                        @endif
                        <form method="GET" id="q" action="{{ url(Session::get('guard') . '/customers/search') }}">
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
                                        <th class="text-center">
                                            {{ trans('app.quotations') }}
                                        </th>
                                        <th class="text-center">
                                            {{ trans('app.invoices') }}
                                        </th>
                                        <th class="text-center">
                                            {{ trans('app.subscriptions') }}
                                        </th>
                                        <th class="text-right">
                                            {{ trans('app.balance') }}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td>
                                                <a href="{{ url(Session::get('guard') . '/customers/' . $customer->id) }}"
                                                   title="{{ trans('app.view_customer_namess_account',["customer_names" => ucwords(trans('app.' . $customer->prefix) . ' ' . $customer->firstname . ' ' . $customer->lastname)]) }}">
                                                    <span class="btn btn-outline btn-info btn-xs">
                                                        {{ ucwords(trans('app.' . $customer->prefix) . ' ' . $customer->firstname . ' ' . $customer->lastname) }}
                                                    </span>
                                                </a>
                                            </td>
                                            <td class="text-left">
                                                <a href="{{ url(Session::get('guard') . '/customers/' . $customer->id . '/send_mail') }}"
                                                   class="fetchajaxpage"
                                                   title="{{ trans('app.send_an_email_to_customer_names',["customer_names" => ucwords(trans('app.' . $customer->prefix) . ' ' . $customer->firstname . ' ' . $customer->lastname)]) }}">
                                                    <i class="fa fa-envelope"></i>
                                                </a>
                                                {{ $customer->email }}
                                            </td>
                                            <td class="text-left">
                                                @if (Session::get('app_settings')->disable_sms == 0)
                                                    <a href="{{ url(Session::get('guard') . '/customers/' . $customer->id . '/send_sms') }}"
                                                       class="fetchajaxpage"
                                                       title="{{ trans('app.send_a_sms_to_customer_names',["customer_names" => ucwords(trans('app.' . $customer->prefix) . ' ' . $customer->firstname . ' ' . $customer->lastname)]) }}">
                                                        <i class="fa fa-comments-o"></i>
                                                    </a>
                                                @endif
                                                +{{ $customer->mobile_no }}
                                            </td>
                                            <td class="text-center">
                                                <span class="label label-info">
                                                        {{ $customer->quotations->where('profile_id', Auth::guard(Session::get('guard'))->user()->profile_id)->count() }}
                                                    </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="label label-info">
                                                        {{ $customer->invoices->where('profile_id', Auth::guard(Session::get('guard'))->user()->profile_id)->count() }}
                                                    </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="label label-info">
                                                        {{ $customer->subscriptions->where('profile_id', Auth::guard(Session::get('guard'))->user()->profile_id)->count() }}
                                                    </span>
                                            </td>
                                            <td class="text-right">
                                                {{ $customer->accountBalance }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
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
        </div>
    </div>
</section>