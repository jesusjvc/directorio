@php
    $sectiontoreload = mt_rand(10000,99999)
@endphp
<div class="{{ $sectiontoreload }}">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.service_options') }}
                    <div class="pull-right">
                        @if(($profile->subscription_package == null) || (($profile->expiry_date != null) && ($profile->expiry_date <= date('Y-m-d'))))
                            <span class="btn btn-xs btn-success" data-toggle="modal" data-target="#ajaxmodel"
                                  data-remote="{{ url(Session::get('guard') . '/profiles/' . $profile->id . '/linksubscription/' . $sectiontoreload) }}">
                                    {{ trans('app.create_a_service_subscription_for_profilename', ["profilename"   =>  $profile->business_name]) }}
                                </span>
                        @else
                            <span class="btn btn-xs btn-success" data-toggle="modal" data-target="#ajaxmodel"
                                  data-remote="{{ url(Session::get('guard') . '/profiles/' . $profile->id . '/changeplan/' . $sectiontoreload) }}">
                                    {{ trans('app.upgradedowngrade') }}
                                </span>
                        @endif
                    </div>
                </div>
                <div class="panel-body">
                    @if(($profile->expiry_date <= date('Y-m-d')) && ($profile->expiry_date != null))
                        <p class="text-muted">
                            {{ trans('app.this_account_is_currently_closed_or_has_expired_you_can_re_activate_it_by_signing_up_for_a_saas_service_subscription_plan') }}
                        </p>
                    @else
                        @if($profile->subscription_package == null)
                            <p class="text-muted">
                                {{ trans('app.profilename_is_currently_not_subscribed_to_any_service_packages', ["profilename" =>  $profile->business_name]) }}
                            </p>
                        @else
                            <p class="text-muted">
                                {!! trans('app.profilename_is_currently_subscribed_to_packagename', ["profilename"  =>  $profile->business_name, "packagename"  =>  "<strong><i>". $profile->subscription_package->name . "</i></strong>"]) !!}
                            </p>
                            <h5>
                                <strong>
                                    {{ trans('app.subscription_information') }}
                                </strong>
                            </h5>
                            <div>
                                <ul class="linelist col-md-12">
                                    <li>
						        <span>
                                    {{ trans('app.description') }}:
						        </span>
                                        {{ $profile->subscription_package->description }}
                                    </li>
                                    <li>
						        <span>
                                    {{ trans('app.charge_per_month') }}:
						        </span>
                                        {{ number_format($profile->subscription_package->monthly_charge_per_profile,2) }} {{ Session::get('profile_settings')->profile_billing->default_currency }}
                                        <i>{{ ucwords(strtolower(trans('app.excl_tax'))) }}</i>
                                    </li>
                                    @if($profile->subscription_package->expire_in_x_days > 0)
                                        <li>
						        <span>
                                    {{ trans('app.trial_period') }}:
						        </span>
                                            {{ $profile->subscription_package->expire_in_x_days }} {{ trans_choice('app.day',$profile->subscription_package->expire_in_x_days) }}
                                        </li>
                                    @endif
                                </ul>
                                <div class="clearfix">
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>