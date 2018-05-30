@extends('frontend.layout.layout')
@section('pagetitle')
    {{ trans('app.subscription_plans') }}
@endsection
@section('content')
    @if(Auth::guard('customer')->user() == null)
        <div style="padding:30px;"></div>
    @endif
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.subscription_plans') }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                @foreach($plans as $plan)
                    <div class="col-md-3 col-xs-12 col-sm-6">
                        <div class="">
                            <div class="text-center listing-box">
                                <div class="title">
                                    <h4 class="text-center" style="padding-bottom:10px;">{{ $plan->name }}</h4>
                                    <h2 class="text-center">
                                                <span class="price-sign">
                                                    {{ $currencies[Session::get('profile_settings')->profile_billing->default_currency]->symbol }}
                                                </span>
                                        <span style="font-size:55px; font-weight:400;">
                                                    {{ $plan->monthly_charge_per_profile }}
                                                </span>
                                    </h2>
                                    @if($plan->monthly_charge_per_profile > 0)
                                        <p class="uppercase text-muted">{{ trans('app.per_month') }}</p>
                                    @else
                                        <p class="uppercase text-muted">{{ trans('app.no_charge') }}</p>
                                    @endif
                                </div>
                                <div class="descriptionx">
                                    <div class="price-table-content">
                                        <div class="price-row"><i
                                                    class="icon-user"></i> {{ $plan->limit_customer_accounts }} {{ trans('app.customer_accounts') }}
                                        </div>
                                        <div class="price-row"><i
                                                    class="icon-screen-smartphone"></i> {{ $plan->limit_professional_accounts }} {{ trans('app.professional_providers') }}
                                        </div>
                                        <div class="price-row"><i
                                                    class="fa fa-check-square-o"></i> {{ trans('app.free_updates') }}
                                        </div>
                                        <div class="price-row"><i
                                                    class="fa fa-check-square-o"></i> {{ trans('app.free_support') }}
                                        </div>
                                        <div class="price-row"><i
                                                    class="fa fa-check-square-o"></i> {{ trans('app.free_public_listing') }}
                                        </div>
                                        <div class="price-row"><i
                                                    class="fa fa-check-square-o"></i> {{ trans('app.multi_branch_management') }}
                                        </div>
                                        <div class="price-row"><i
                                                    class="fa fa-check-square-o"></i> {{ trans('app.intelligent_contract_builder') }}
                                        </div>
                                        <div class="price-row"><i
                                                    class="fa fa-check-square-o"></i> {{ trans('app.online_file_manager') }}
                                        </div>
                                        <div class="price-row"><i
                                                    class="fa fa-check-square-o"></i> {{ trans('app.real_time_online_payments') }}
                                        </div>
                                        <div class="price-row"><i
                                                    class="fa fa-check-square-o"></i> {{ trans('app.realtime_sms_notifications') }}
                                        </div>
                                        <div class="price-row"><i
                                                    class="fa fa-check-square-o"></i> {{ trans('app.realtime_call_notifications') }}
                                        </div>
                                        <div class="price-row"><i
                                                    class="fa fa-check-square-o"></i> {{ trans('app.custom_notification_templates') }}
                                        </div>
                                        <div class="price-row"><i
                                                    class="fa fa-check-square-o"></i> {{ trans('app.dedicated_profilecontrol') }}
                                        </div>
                                        <div class="price-row"><i
                                                    class="fa fa-check-square-o"></i> {{ trans('app.unlimited_appointments') }}
                                        </div>
                                        <div class="price-row"><i
                                                    class="fa fa-check-square-o"></i> {{ trans('app.unlimited_quotations') }}
                                        </div>
                                        <div class="price-row"><i
                                                    class="fa fa-check-square-o"></i> {{ trans('app.unlimited_invoices') }}
                                        </div>
                                        <div class="price-row"><i
                                                    class="fa fa-check-square-o"></i> {{ trans('app.unlimited_credit_notes') }}
                                        </div>
                                        <div class="price-row"><i
                                                    class="fa fa-check-square-o"></i> {{ trans('app.unlimited_contracts') }}
                                        </div>
                                        <div class="text-center">
                                            <a href="{{ url('join/' . $plan->id*date('Ymd')) }}" class="btn btn-success waves-effect waves-light" style="width:100%;">
                                                {{ trans('app.sign_up') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection @push('head') @endpush @push('javascript') @endpush