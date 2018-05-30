<section class="records">
    <div class="reload" id="ajaxpaginateblock">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.subscriptions') }}
                        @php
                            $createlink = url(Session::get('guard') . '/subscriptions/create/');
                        if(($class == 'CustomersController') && ($customer != null)):
                            $createlink = url(Session::get('guard') . '/subscriptions/create/c' . $customer->id);
                        endif;
                        if(($class == 'ProfilesController') && ($profile != null)):
                            $createlink = url(Session::get('guard') . '/subscriptions/create/p' . $profile->id);
                        endif;
                        @endphp
                        <div class="pull-right">
                            <a href="{{ $createlink }}">
                        <span class="btn btn-xs btn-success">
                            {{ trans('app.create_a_new_subscription') }}
                        </span>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <p>
                            {{ trans('app.important_if_you_cancel_a_subscription_any_related_services_will_not_be_cancelled_as_an_example_if_you_cancel_a_did_subscription_the_did_will_remain_active_however_if_you_cancel_a_related_service_such_as_a_did_number_the_related_subscription_will_be_cancelled_as_well') }}
                        </p>
                        <hr>
                        @if(count($subscriptions) > 0)
                            @if($class == 'SubscriptionsController')
                                <form method="GET" id="q" action="{{ url(Session::get('guard') . '/subscriptions/search') }}">
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
                                                    {{ $subscriptions->total() }} {{ trans_choice('app.result_foundresults_found',count($subscriptions)) }}
                                                    <mark>{{ Request::input('q') }}</mark>
                                                </p>
                                                <p>
                                                    <a href="{{ url(Session::get('guard') . '/subscriptions') }}"
                                                       class="fetchajaxpage">{{ trans('app.reset_search') }}</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endif
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-left oneline">
                                        #
                                    </th>
                                    <th class="text-left oneline">
                                        {{ trans('app.status') }}
                                    </th>
                                    @if($class == 'SubscriptionsController')
                                        <th class="text-center oneline">
                                            {{ trans('app.customer_type') }}
                                        </th>
                                        <th>
                                            {{ trans('app.customer') }}
                                        </th>
                                    @endif
                                    <th class="text-left oneline">
                                        {{ trans('app.interval') }}
                                    </th>
                                    <th class="text-left oneline">
                                        {{ trans('app.start_date') }}
                                    </th>
                                    <th class="text-left oneline">
                                        {{ trans('app.next_bill_date') }}
                                    </th>
                                    <th class="text-left oneline">
                                        {{ trans('app.end_date') }}
                                    </th>
                                    <th class="text-center oneline">
                                        {{ trans('app.currency') }}
                                    </th>
                                    <th class="text-center oneline">
                                        {{ trans('app.tax') }}
                                    </th>
                                    <th class="text-right oneline">
                                        {{ trans('app.total_homecurrency',["homecurrency" => Auth::guard(Session::get('guard'))->user()->profile->profile_billing->default_currency]) }}
                                        <small>{{ trans('app.incl') }}</small>
                                    </th>
                                    <th class="text-center">

                                    </th>
                                </tr>
                                </thead>
                                @if(count($subscriptions) > 0)
                                    <tbody>
                                    @foreach ($subscriptions as $subscription)
                                        <tr>
                                            <td>
                                                @if($subscription->status == "inactive")
                                                    <a href="{{ url(Session::get('guard') . '/subscriptions/' . $subscription->id . '/build') }}">
                                                            <span class="btn btn-outline btn-primary btn-xs">
                                                            #{{ $profile->profile_billing->subscription_number_prefix }}{{ $subscription->subscription_no }}
                                                            </span>
                                                    </a>
                                                @else
                                                    #{{ $profile->profile_billing->subscription_number_prefix }}{{ $subscription->subscription_no }}
                                                @endif
                                            </td>
                                            <td class="text-left oneline">
                                                @if($subscription->status == "inactive")
                                                    <span class="yellowbg"
                                                          style="background-color:#ffff83;"><i
                                                                class="fa fa-unlock"></i> {{ trans('app.' . $subscription->status) }}</span>
                                                @elseif($subscription->status == "cancelled")
                                                    <i class="fa fa-times-circle"></i> {{ trans('app.' . $subscription->status) }}
                                                @else($subscription->status == "cancelled")
                                                    <i class="fa fa-lock"></i> {{ trans('app.' . $subscription->status) }}
                                                @endif
                                            </td>
                                            @if($class == 'SubscriptionsController')
                                                    @php
                                                        $customernames = ucwords($subscription->customer->prefix . ' ' . $subscription->customer->firstname . ' ' . $subscription->customer->lastname)
                                                    @endphp
                                                    <td class="text-center">
                                                        <span class="label label-primary">
                                                            {{ trans('app.customer') }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url(Session::get('guard') . '/customers/' . $subscription->customer->id) }}">
                                                            <span class="btn btn-outline btn-info btn-xs">
                                                            {{ $customernames }}
                                                            </span>
                                                        </a>
                                                    </td>
                                            @endif
                                            <td class="text-left">
                                                {{ trans('app.' . $subscription->interval) }}
                                            </td>
                                            <td class="text-left">
                                                {{ $subscription->start_date }}
                                            </td>
                                            <td class="text-left">
                                                @if($subscription->status == "active")
                                                    {{ $subscription->next_bill_date }}
                                                @endif
                                            </td>
                                            <td class="text-left">
                                                {{ $subscription->end_date }}
                                            </td>
                                            <td class="text-center">
                                                {{ $subscription->currency }}
                                            </td>
                                            <td class="text-center">
                                                {{ $subscription->tax_configuration->percentage }}%
                                            </td>
                                            <td class="text-right">
                                                {{ number_format($subscription->total_amount,2) }}
                                            </td>
                                            <td class="text-center">
                                                @if($subscription->status == "active")
                                                <span class="btn btn-danger btn-xs postconfirm"
                                                      data-title="{{ trans('app.cancel_this_subscription') }}"
                                                      data-description="{{  trans('app.are_you_sure_you_want_to_cancel_this_subscription') }}"
                                                      data-reloaddiv="reload"
                                                      @if($class == 'CustomersController')
                                                      data-reloadurl="{{ url(Session::get('guard') . '/customers/' . $subscription->customer->id . '/subscriptions') }}"
                                                      @else
                                                      data-reloadurl="{{ url(Session::get('guard') . '/subscriptions') }}"
                                                      @endif
                                                      data-posturl="{{ url(Session::get('guard') . '/subscriptions/' . $subscription->id . '/cancel') }}">
                                                    {{ trans('app.cancel') }}
                                                </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>
                        <div class="panel-footer">
                            <div class="text-center">
                                @if((count($subscriptions) == 0) && (last(explode('/',url()->current())) != 'search'))
                                    {{ trans('app.no_data_found') }}
                                @endif
                                @if((last(explode('/',url()->current())) == 'search') && (count($subscriptions) > 0))
                                    <a href="{{ url(Session::get('guard') . '/subscriptions') }}"
                                       class="fetchajaxpage">{{ trans('app.reset_search') }}</a>
                                @elseif((last(explode('/',url()->current())) == 'search') && (count($subscriptions) == 0))
                                    <a href="{{ url(Session::get('guard') . '/subscriptions') }}"
                                       class="fetchajaxpage">{{ trans('app.no_results_found_reset_search') }}</a>
                                @endif
                            </div>
                            @if(method_exists($subscriptions,'links'))
                                <div align="center">
                                    @if($subscriptions->links())
                                        <div align="center">
                                            @if(Request::get('q'))
                                                {{ $subscriptions->appends(['q' => Request::get('q')])->links() }}
                                            @else
                                                {{ $subscriptions->links() }}
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