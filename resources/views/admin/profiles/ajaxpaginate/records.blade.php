<section class="records">
    <div class="reload" id="ajaxpaginateblock">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.profile_accounts') }}
                        <div class="pull-right">
                            <a href="{{ url(Session::get('guard') . '/profiles/create/') }}">
                        <span class="btn btn-xs btn-success">
                            {{ trans('app.register_a_new_profile') }}
                        </span>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form method="GET" id="q" action="{{ url(Session::get('guard') . '/profiles/search') }}">
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
                                            {{ $profiles->total() }} {{ trans_choice('app.result_foundresults_found',count($profiles)) }}
                                            <mark>{{ Request::input('q') }}</mark>
                                        </p>
                                        <p>
                                            <a href="{{ url(Session::get('guard') . '/profiles') }}"
                                               class="fetchajaxpage">{{ trans('app.reset_search') }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(count($profiles) > 0)
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>
                                            <span class="">{{ trans('app.account') }} #</span>
                                        </th>
                                        <th>
                                            <span class="">{{ trans('app.business_name') }}</span>
                                        </th>
                                        <th>
                                            <span class="">{{ trans('app.email_address') }} </span>
                                        </th>
                                        <th>
                                            <span class="">{{ trans('app.city') }}</span>
                                        </th>
                                        <th>
                                            <span class="">{{ trans_choice('app.country',1) }}</span>
                                        </th>
                                        <th>
                                            <span class="">{{ trans('app.timezone') }}</span>
                                        </th>
                                        <th>
                                            <span class="">{{ trans('app.subscription') }}</span>
                                        </th>
                                        <th class="text-center">
                                            {{ trans('app.numbers') }}
                                        </th>
                                        <th class="text-center">
                                            {{ trans('app.users') }}
                                        </th>
                                        <th class="text-right">
                                            {{ trans('app.balance') }}
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($profiles as $profile)
                                        <tr>
                                            <td>
                                                <a href="{{ url(Session::get('guard') . '/profiles') }}/{{ $profile->id }}">
                                <span class="btn btn-outline btn-primary btn-xs">
                            {{ $profile->account_number }}
                            </span>
                                                </a>
                                            </td>
                                            <td>
                                                {{ $profile->business_name }}
                                                @if(($profile->expiry_date <= date('Y-m-d')) && ($profile->expiry_date != null))
                                                    <span class="label label-danger">{{ trans('app.closed') }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $profile->business_email }}
                                            </td>
                                            <td>{{ $profile->business_city }}
                                            </td>
                                            <td>
                                                @if($profile->country)
                                                    {{ $profile->country }}
                                                @else
                                                    {{ $profile->business_country }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ CustomHelper::reverseUscore($profile->timezone) }}
                                            </td>
                                            <td class="oneline">
                                                @if($profile->subscription_package != null)
                                                    {{ $profile->subscription_package->name }}
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <span class="label label-info">{{ $profile->app_sms_did_numbers->count() }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="label label-info">{{ $profile->users->count() }}</span>
                                            </td>
                                            <td class="text-right">
                                                {{ $profile->accountBalance }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        <div class="panel-footer">
                            <div class="text-center">
                                @if((count($profiles) == 0) && (last(explode('/',url()->current())) != 'search'))
                                    {{ trans('app.no_data_found') }}
                                @endif
                                @if((last(explode('/',url()->current())) == 'search') && (count($profiles) > 0))
                                    <a href="{{ url(Session::get('guard') . '/profiles') }}"
                                       class="fetchajaxpage">{{ trans('app.reset_search') }}</a>
                                @endif
                            </div>
                            @if(method_exists($profiles,'links'))
                                <div align="center">
                                    @if($profiles->links())
                                        <div align="center">
                                            @if(Request::get('q'))
                                                {{ $profiles->appends(['q' => Request::get('q')])->links() }}
                                            @else
                                                {{ $profiles->links() }}
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