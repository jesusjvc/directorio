@extends(Session::get('guard') . '.layouts.app') @section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.credit_notes') }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <form role="form" method="POST" action="{{ url(Session::get('guard') . '/credit_notes/create') }}">
                {{ csrf_field() }}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.issue_a_credit_note') }}
                        <div class="pull-right">
                            <span class="btn btn-xs btn-warning" data-toggle="collapse" data-target="#collapse"
                                  aria-expanded="false" aria-controls="collapse">
                                {!! trans('app.notice_current_status_is_currentstatus_click_to_read_more',["currentstatus" => "<i>" . trans('app.draft') . "</i>"]) !!}
                            </span>
                            @if (stripos(url()->previous(), '.js') !== false )
                                <a href="{{ url(Session::get('guard') . '/credit_notes') }}">
                                <span class="btn btn-xs btn-primary">
                                    {{ trans('app.cancel_and_go_back') }}
                                </span>
                                </a>
                            @else
                                <a href="{{ url()->previous() }}">
                                <span class="btn btn-xs btn-primary">
                                    {{ trans('app.cancel_and_go_back') }}
                                </span>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="collapse" id="collapse">
                            <div class="text-muted">{!! trans('descriptions.credit_note_status') !!}</div>
                            <hr>
                        </div>
                        <div class="row">
                            @if($customer != null)
                                <input type="hidden" name="find_id" value="{{ $customer->id }}">
                                <div class="col-md-6">
                                    <address>
                                        <h3>
                                            <b class="text-danger">{{ ucwords(trans('app.' . $customer->prefix) . ' ' . $customer->firstname . ' ' . $customer->lastname) }}</b>
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
                            @elseif($profile_customer != null)
                                <input type="hidden" name="find_id" value="-{{ $profile_customer->id }}">
                                <div class="col-md-6">
                                    <address>
                                        <h3>
                                            <b class="text-danger">{{ ucwords($profile_customer->business_name) }}</b>
                                        </h3>
                                        <p class="text-muted">
                                            @if($billing_address == null)
                                                <i>{{ trans('app.this_type_has_no_default_billing_address', ["type" => trans('app.customer_file')]) }}</i>
                                            @else
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
                                                    <br>{{ trans('app.tel') }}: +{{ $profile_customer->business_phone }}
                                                @endif
                                            @endif
                                        </p>
                                    </address>
                                </div>
                            @else
                                <div class="col-md-6">
                                    <label class="col-md-12">{{ trans('app.customer') }} <span
                                                class="required"> * </span></label>
                                    <div class="form-group">
                                        <select name="find_id" class="form-control profile_customer_search"
                                                required>
                                            <option value=""
                                                    selected>{{ trans('app.select_a_selectwhat',["selectwhat" => trans('app.customer')]) }}</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="ajaxreload">

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
                                                       value="{{ date('Y-m-d') }}" readonly
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
                                                    <option value="{{ $tax_configuration->id }}">
                                                        {{ $tax_configuration->title }}
                                                        : {{ $tax_configuration->percentage }}%
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
                                            <input type="text" class="form-control" name="description"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>{{ trans('app.amount') }} <span
                                                    class="required"> * </span> @if($profile->profile_billing->tax_enabled == 1)<small>{{ trans('app.tax_inclusive') }}</small>@endif</label>
                                        <div class="form-group">
                                            <input type="number" step="0.01" min="0" class="form-control"
                                                   name="total_amount"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="pull-left">
                            <p class="text-muted">
                                <i>{!! trans('descriptions.note_credit_notes') !!}</i>
                            </p>
                        </div>
                        <div class="pull-right">
                            <button class="btn btn-primary">{{ trans('app.issue_credit_note') }}</button>
                        </div>
                        <div class="clear"></div>
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

        $('.ajaxreload').empty();
        $(".ajaxreload").prepend('<div style="padding:10px; text-align:center;"><p><img src="{{ url("") }}/assets/loading-spinner-default.gif"></p></div>');
        var xhr = $(".ajaxreload").load(reloadurl, function (response, status, xhr) {
            e.preventDefault();
            var responseText = xhr.responseText;
        });

//        xhr.abort();

        $('.reload').show();
    });
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
    });
</script>
@endpush