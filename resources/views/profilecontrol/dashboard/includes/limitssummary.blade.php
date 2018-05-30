<div class="row">
    <div class="col-sm-12 col-xs-12">
        <div class="white-box">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12 m-t-20 text-left">
                    <h3 class="box-title">{{ trans('app.your_subscription_plan') }}
                        <span class="btn btn-xs btn-success" data-toggle="modal" data-target="#ajaxmodel"
                              data-remote="{{ url(Session::get('guard') . '/change_subscription') }}">
                    <span class="btn btn-xs btn-success">
                        {{ trans('app.upgradedowngrade') }}
                    </span>
                        </span>
                    </h3>
                    <strong>{{ trans('app.plan') }}:</strong> {{ $profile->subscription_package->name }}
                    <br>
                    <i>{{ str_limit($profile->subscription_package->description,150) }}</i>
                    <hr>
                    <strong>{{ trans('app.customer_accounts') }}
                        :</strong> {{ $profile->subscription_package->limit_customer_accounts }}
                    <br>
                    <strong>{{ trans('app.professional_providers') }}
                        :</strong> {{ $profile->subscription_package->limit_professional_accounts }}
                    @if($profile->expiry_date != null)
                        <br>
                        <strong>{{ trans('app.expiry_date') }}
                            :</strong> {{ $profile->expiry_date }}
                    @endif
                </div>
                <div class="col-md-8 col-sm-8 col-xs-12 m-t-20 text-center">
                    <ul class="country-state slimscrollcountry">
                        <li>
                            <h2>{{ number_format($profile->limit_customer_accounts_count) }}@if($profile->subscription_package->limit_customer_accounts > 0)
                                    /{{ $profile->subscription_package->limit_customer_accounts }}@endif</h2>
                            <small>{{ trans('app.customer_accounts') }}</small>
                            @if($profile->subscription_package->limit_customer_accounts == 0)
                                <div class="pull-right">{{ trans('app.unlimited') }} <i
                                            class="fa fa-bar-chart-o text-default"></i></div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50"
                                         aria-valuemin="0" aria-valuemax="100" style="width:0%;"><span class="sr-only">0% {{ trans('app.utilized') }}</span>
                                    </div>
                                </div>
                            @elseif($profile->subscription_package->limit_customer_accounts > 0)
                                <div class="pull-right">
                                    @if($profile->limit_customer_accounts_count > 0)
                                    {{ ceil(($profile->limit_customer_accounts_count/$profile->subscription_package->limit_customer_accounts)*100) }}
                                    @else
                                        0
                                    @endif
                                    % <i class="fa fa-bar-chart-o text-default"></i></div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50"
                                         aria-valuemin="0" aria-valuemax="100"
                                         style="width:{{ ($profile->limit_customer_accounts_count/$profile->subscription_package->limit_customer_accounts)*100 }}%;">
                                    </div>
                                </div>
                            @else
                                <div class="pull-right">0 <i class="fa fa-bar-chart-o text-default"></i></div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50"
                                         aria-valuemin="0" aria-valuemax="100" style="width:0%;"><span class="sr-only">0% {{ trans('app.utilized') }}</span>
                                    </div>
                                </div>
                            @endif
                        </li>
                        <li>
                            <h2>{{ number_format($profile->limit_professional_accounts_count) }}@if($profile->subscription_package->limit_professional_accounts > 0)
                                    /{{ $profile->subscription_package->limit_professional_accounts }}@endif</h2>
                            <small>{{ trans('app.professional_providers') }}</small>
                            @if($profile->subscription_package->limit_professional_accounts == 0)
                                <div class="pull-right">{{ trans('app.unlimited') }} <i
                                            class="fa fa-bar-chart-o text-default"></i></div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50"
                                         aria-valuemin="0" aria-valuemax="100" style="width:0%;"><span class="sr-only">0% {{ trans('app.utilized') }}</span>
                                    </div>
                                </div>
                            @elseif($profile->subscription_package->limit_professional_accounts > 0)
                                <div class="pull-right">
                                    @if($profile->limit_professional_accounts_count > 0)
                                        {{ ceil(($profile->limit_professional_accounts_count/$profile->subscription_package->limit_professional_accounts)*100) }}
                                    @else
                                        0
                                    @endif
                                    % <i class="fa fa-bar-chart-o text-default"></i></div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50"
                                         aria-valuemin="0" aria-valuemax="100"
                                         style="width:{{ ($profile->limit_professional_accounts_count/$profile->subscription_package->limit_professional_accounts)*100 }}%;">
                                    </div>
                                </div>
                            @else
                                <div class="pull-right">0 <i class="fa fa-bar-chart-o text-default"></i></div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50"
                                         aria-valuemin="0" aria-valuemax="100" style="width:0%;"><span class="sr-only">0% {{ trans('app.utilized') }}</span>
                                    </div>
                                </div>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>