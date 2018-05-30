@extends(Session::get('guard') . '.layouts.app') @section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.subscriptions') }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.build_subscription_subscription_no',["subscription_no" => Auth::user()->profile->profile_billing->subscription_number_prefix . $subscription->subscription_no]) }}
                    <span class="label label-danger">{{ trans('app.inactive') }}</span>
                    <div class="pull-right">
                        <a href="{{ $reffered }}">
                                <span class="btn btn-xs btn-primary">
                                    {{ trans('app.go_back') }}
                                </span>
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                    <form role="form" method="POST" action="{{ url(Session::get('guard') . '/subscriptions/' . $subscription->id . '/build') }}" class="autosave">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="row">
                            @if($profile_customer != null)
                                <div class="col-md-6">
                                    <label class="col-md-12">{{ trans('app.profile_customer') }} <span
                                                class="required"> * </span></label>
                                    <div class="form-group">
                                        <select name="find_id" class="form-control profile_customer_search"
                                                required>
                                            <option value="-{{ ($profile_customer->id) }}"
                                                    selected>{{ $profile_customer->business_name }}</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="loadcustomers">
                                        <address>
                                            <h3> &nbsp;<b class="text-danger">{{ $profile_customer->business_name }}</b>
                                            </h3>
                                            <i>{{ trans('app.account_no') }}
                                                #{{ $profile_customer->account_number }}</i>
                                            <p class="text-muted">
                                                @if(($billing_address->address_1) && ($billing_address->address_1 != ''))
                                                    {{ $billing_address->address_1 }}
                                                @endif
                                                @if(($billing_address->address_2) && ($billing_address->address_2 != ''))
                                                    , {{ $billing_address->address_2 }}
                                                @endif
                                                @if(($billing_address->city) && ($billing_address->city != ''))
                                                    <br>{{ $billing_address->city }}
                                                @endif
                                                @if(($billing_address->postal_code) && ($billing_address->postal_code != ''))
                                                    <br>{{ $billing_address->postal_code }}
                                                    @if(($billing_address->state) && ($billing_address->state != ''))
                                                        {{ " " . $billing_address->state }}
                                                    @endif
                                                @endif
                                                @if(($billing_address->country) && ($billing_address->country != ''))
                                                    <br>{{ strtoupper($billing_address->country) }}
                                                @endif
                                                @if(($profile_customer->business_phone) && ($profile_customer->business_phone != ''))
                                                    <br>{{ trans('app.tel') }}:
                                                    +{{ $profile_customer->business_phone }}
                                                @endif
                                            </p>
                                        </address>
                                    </div>
                                </div>
                            @else
                                @php
                                    $customernames = ucwords($subscription->customer->prefix . ' ' . $subscription->customer->firstname . ' ' . $subscription->customer->lastname)
                                @endphp
                                <div class="col-md-6">
                                    <label class="col-md-12">{{ trans('app.customer') }} <span
                                                class="required"> * </span></label>
                                    <div class="form-group">
                                        <select name="find_id" class="form-control profile_customer_search"
                                                required>
                                            <option value="{{ $subscription->customer->id }}"
                                                    selected>{{ $customernames }}</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="loadcustomers">
                                        <address>
                                            <h3>
                                                <b class="text-danger">{{ $customernames }}</b>
                                            </h3>
                                            <p class="text-muted">
                                                @if($billing_address == null)
                                                    <i>{{ trans('app.this_type_has_no_default_billing_address', ["type" => trans('app.customer_file')]) }}</i>
                                                @else
                                                    @if(($customer->company) && ($customer->company != ''))
                                                        <span style="text-transform:uppercase; font-weight:normal;"><i>{{ ucwords($customer->company) }}</i><br></span>
                                                    @endif
                                                    @if(($billing_address->address_1) && ($billing_address->address_1 != ''))
                                                        {{ $billing_address->address_1 }}
                                                    @endif
                                                    @if(($billing_address->address_2) && ($billing_address->address_2 != ''))
                                                        , {{ $billing_address->address_2 }}
                                                    @endif
                                                    @if(($billing_address->city) && ($billing_address->city != ''))
                                                        <br>{{ $billing_address->city }}
                                                    @endif
                                                    @if(($billing_address->postal_code) && ($billing_address->postal_code != ''))
                                                        <br>{{ $billing_address->postal_code }}
                                                        @if(($billing_address->state) && ($billing_address->state != ''))
                                                            {{ " " . $billing_address->state }}
                                                        @endif
                                                    @endif
                                                    @if(($billing_address->country) && ($billing_address->country != ''))
                                                        <br>{{ strtoupper($billing_address->country) }}
                                                    @endif
                                                    @if(($customer->mobile_no) && ($customer->mobile_no != ''))
                                                        <br>{{ trans('app.tel') }}: +{{ $customer->mobile_no }}
                                                    @endif
                                                @endif
                                            </p>
                                        </address>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>{{ trans('app.start_date') }} <span
                                                    class="required"> * </span></label>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose"
                                                       placeholder="YYYY-MM-DD" name="start_date"
                                                       value="{{ $subscription->start_date }}" readonly
                                                       required>
                                                <span class="input-group-addon"><i class="icon-calender"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>{{ trans('app.end_date') }} <span
                                                    class="required"> * </span>
                                            <small><i>{{  trans('app.leave_empty_for_no_end_date') }}</i></small>
                                        </label>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose"
                                                       placeholder="YYYY-MM-DD" name="end_date"
                                                       value="{{ $subscription->end_date }}"
                                                       readonly>
                                                <span class="input-group-addon"><i class="icon-calender"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label>{{ trans('app.tax_configuration') }} <span
                                                    class="required"> * </span></label>
                                        <div class="form-group">
                                            <select name="tax_configuration_id" class="form-control"
                                                    required>
                                                <option value="">
                                                    {{ trans('app.select_a_selectwhat',["selectwhat" => trans('app.tax_configuration')]) }}
                                                </option>
                                                @foreach($tax_configurations as $tax_configuration)
                                                    <option value="{{ $tax_configuration->id }}"
                                                            @if($subscription->tax_configuration_id == $tax_configuration->id) selected @endif>
                                                        {{ $tax_configuration->title }}
                                                        : {{ $tax_configuration->percentage }}%
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>{{ trans('app.subscription_interval') }} <span
                                                    class="required"> * </span></label>
                                        <div class="form-group">
                                            <select name="interval" class="form-control select2" required>
                                                <option value="daily" @if($subscription->interval == "daily") selected @endif>
                                                    {{ trans('app.daily') }}
                                                </option>
                                                <option value="weekly" @if($subscription->interval == "weekly") selected @endif>
                                                    {{ trans('app.weekly') }}
                                                </option>
                                                <option value="bimonthly" @if($subscription->interval == "bimonthly") selected @endif>
                                                    {{ trans('app.bi_monthly') }}
                                                </option>
                                                <option value="monthly" @if($subscription->interval == "monthly") selected @endif>
                                                    {{ trans('app.monthly') }}
                                                </option>
                                                <option value="quarterly" @if($subscription->interval == "quarterly") selected @endif>
                                                    {{ trans('app.quarterly') }}
                                                </option>
                                                <option value="biannually" @if($subscription->interval == "biannually") selected @endif>
                                                    {{ trans('app.bi_annually') }}
                                                </option>
                                                <option value="annually" @if($subscription->interval == "annually") selected @endif>
                                                    {{ trans('app.annually') }}
                                                </option>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>{{ trans('app.currency') }} <span
                                                    class="required"> * </span></label>
                                        <div class="form-group">
                                            <select name="currency" id="currency" class="form-control select2" required>
                                                @foreach ($currencies as $currency)
                                                    <optgroup
                                                            label="{{ strtoupper($currency->code) }} : {{ $currency->symbol }}">
                                                        <option value="{{ $currency->code }}"
                                                                @if($subscription->currency == $currency->code) selected @endif>{{ strtoupper($currency->name) }}</option>
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div style="display:none;" id="validateCurrencyDifference">
                                        <div class="col-md-12">
                                            <div class="alert alert-danger"> {!! trans('descriptions.subscription_exchange_rate',["profilecurrency" => "<b>".$profile->profile_billing->default_currency."</b>"]) !!} </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-right">
                                <a class="fetchajaxpage"
                                   href="{{ url(Session::get('guard') . '/subscriptions/' . $subscription->id . '/add_item') }}">
                                    <span class="btn btn-xs btn-primary">
                                        {{ trans('app.add_item') }}
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="table-responsive" style="clear: both;">
                                    <span class="reload">

                                    </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="buildlinks">

                </div>
            </div>
        </div>

    @endsection
    @push('head')
    <!-- Date picker plugins css -->
        <link href="{{ url('assets') }}/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css"
              rel="stylesheet" type="text/css"/>
        @endpush
        @push('javascript')
        <script src="{{ url('assets') }}/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script>
            jQuery('.datepicker-autoclose').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            });

            $(".profile_customer_search").on("change", function (e) {

                var profile_id = $(this).find("option:selected").val();
                        {{--var reloadurl = '{{ url(Session::get('guard') . '/ajaxdata/profile_customer_search') }}/55';--}}
                var reloadurl = '{{ url(Session::get('guard') . '/ajaxdata/profile_customer_search') }}/' + profile_id;

                $('.loadcustomers').empty();
                $(".loadcustomers").prepend('<div style="padding:10px; text-align:center;"><p><img src="{{ url("") }}/assets/loading-spinner-default.gif"></p></div>');
                var xhr = $(".loadcustomers").load(reloadurl, function (response, status, xhr) {
                    e.preventDefault();
                    var responseText = xhr.responseText;
                });

//        xhr.abort();
            });

            function validateCurrencyDifference() {
                if ($("#currency").val() != "{{ Session::get('profile_settings')->profile_billing->default_currency }}") {
                    $("#validateCurrencyDifference").show();
                } else {
                    $("#validateCurrencyDifference").hide();
                }
            }

            function getBuildLinks() {

                // load buidlinks
                if (buildlinks) {
                    buildlinks.abort();
                }
                $(".buildlinks").empty(); // empty parent page div and show loader to load
                $(".buildlinks").prepend('<p class="text-center">{{ trans("app.fetching_available_options") }}</p><br>');

                var buildlinks = $(".buildlinks").load("{{ url(Session::get('guard') . '/subscriptions/' . $subscription->id . '/buildlinks') }}", function (response, status, buildlinks) {

                    if (buildlinks.status == 404) {
                        swal({
                            title: "{{ trans('app.an_error_has_occurred') }}",
                            text: "{{ trans('app.please_refresh_this_entire_page_then_try_again') }}",
                            html: true,
                            type: "danger",
                            confirmButtonText: "{{ trans('app.okay') }}",
                            closeOnConfirm: true
                        });

                        buildlinks.abort();

                        $('.buildlinks').empty();
                    }
                });
            }

            $("#currency").on("change", function () {
                validateCurrencyDifference();
            });

            $(document).ready(function () {

                validateCurrencyDifference();
                getBuildLinks();

                // load default ajax items
                if (ajax_items) {
                    ajax_items.abort();
                }
                $(".reload").empty(); // empty parent page div and show loader to load
                $(".reload").prepend('<p class="text-center">{{ trans("app.fetching_data") }}</p>');

                var ajax_items = $(".reload").load("{{ url(Session::get('guard') . '/subscriptions/' . $subscription->id . '/items') }}", function (response, status, ajax_items) {

                    if (ajax_items.status == 418) {
                        swal({
                            title: "{{ trans('app.notice') }}",
                            text: "" + ajax_items.responseText,
                            html: true,
                            type: "warning",
                            confirmButtonText: "{{ trans('app.done') }}",
                            closeOnConfirm: true
                        });

                        ajax_items.abort();

                        $('.reload').empty();
                    }
                });

                $(".profile_customer_search").select2({
                    ajax: {
                        url: '{{ url(Session::get('guard') . '/ajaxdata/profile_customer_search') }}',
                        dataType: 'json',
                        delay: 2000,
                        processResults: function (data) {
                            return {
                                results: data
                            };
                        },
                        cache: false
                    },
                    minimumInputLength: 3
                });

            });
        </script>
    @include('global.includes.autosave')
    @endpush