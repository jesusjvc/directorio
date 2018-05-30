@extends(Session::get('guard') . '.layouts.app') @section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.credit_notes') }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <form role="form" method="POST" action="{{ url(Session::get('guard') . '/credit_notes/' . $credit_note->id . '/build') }}" class="autosave">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.issue_a_credit_note') }}
                        <div class="pull-right">
                            <span class="btn btn-xs btn-warning" data-toggle="collapse" data-target="#collapse"
                                  aria-expanded="false" aria-controls="collapse">
                                {!! trans('app.notice_current_status_is_currentstatus_click_to_read_more',["currentstatus" => "<i>" . trans('app.draft') . "</i>"]) !!}
                            </span>
                            <a href="{{ $reffered }}">
                                <span class="btn btn-xs btn-primary">
                                    {{ trans('app.go_back') }}
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="collapse" id="collapse">
                            <div class="text-muted">{!! trans('descriptions.credit_note_status') !!}</div>
                            <hr>
                        </div>
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
                                    $customernames = ucwords($credit_note->customer->prefix . ' ' . $credit_note->customer->firstname . ' ' . $credit_note->customer->lastname)
                                @endphp
                                <div class="col-md-6">
                                    <label class="col-md-12">{{ trans('app.customer') }} <span
                                                class="required"> * </span></label>
                                    <div class="form-group">
                                        <select name="find_id" class="form-control profile_customer_search"
                                                required>
                                            <option value="{{ $credit_note->customer->id }}"
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
                                        <label>{{ trans('app.credit_note_date') }} <span
                                                    class="required"> * </span></label>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose"
                                                       placeholder="YYYY-MM-DD" name="credit_note_date"
                                                       value="{{ $credit_note->credit_note_date }}" readonly
                                                       required>
                                                <span class="input-group-addon"><i class="icon-calender"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>{{ trans('app.tax_configuration') }} <span
                                                    class="required"> * </span></label>
                                        <div class="form-group">
                                            <select name="tax_configuration_id" class="form-control"
                                                    required>
                                                <option value="">
                                                    {{ trans('app.select_a_selectwhat',["selectwhat" => trans('app.tax_configuration')]) }}
                                                </option>
                                                @foreach($tax_configurations as $tax_configuration)
                                                    <option value="{{ $tax_configuration->id }}" @if($credit_note->tax_configuration_id == $tax_configuration->id) selected @endif>
                                                        {{ $tax_configuration->title }}: {{ $tax_configuration->percentage }}%
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <label>{{ trans('app.description') }} <span
                                                    class="required"> * </span></label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="description" value="{{ $credit_note->description }}"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>{{ trans('app.amount') }} <span
                                                    class="required"> * </span>@if($profile->profile_billing->tax_enabled == 1)<small>{{ trans('app.tax_inclusive') }}</small>@endif</label>
                                        <div class="form-group">
                                            <input type="number" step="0.01" min="0" class="form-control" name="total_amount" value="{{ $credit_note->total_amount }}"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="buildlinks">

                    </div>
            </form>
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

    function getBuildLinks() {

        // load buidlinks
        if (buildlinks) {
            buildlinks.abort();
        }
        $(".buildlinks").empty(); // empty parent page div and show loader to load
        $(".buildlinks").prepend('<p class="text-center">{{ trans("app.fetching_available_options") }}</p><br>');

        var buildlinks = $(".buildlinks").load("{{ url(Session::get('guard') . '/credit_notes/' . $credit_note->id . '/buildlinks') }}", function (response, status, buildlinks) {

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

    $(document).ready(function () {

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

        getBuildLinks();

    });
</script>
@include('global.includes.autosave')
@endpush