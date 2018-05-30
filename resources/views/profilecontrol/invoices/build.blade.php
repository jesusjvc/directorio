@extends(Session::get('guard') . '.layouts.app') @section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.invoices') }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.invoice') }} #{{ $invoice->invoice_no }}
                    @if((date('Y-m-d') > date('Y-m-d',strtotime($invoice->due_date))) && ($invoice->status != 0))
                        <span class="label label-danger">{{ trans('app.pass_due_date') }}</span>
                    @endif
                    @php
                        $backlink = url(Session::get('guard') . '/invoices');
                    if(URL::previous() != null):
                        $backlink = URL::previous();
                        $button = trans('app.go_back');
                    endif;
                    if((preg_match('/create/', URL::previous()) == true) || (preg_match('/.js/', URL::previous()) == true)):
                    $backlink = url(Session::get('guard') . '/invoices');
                    $button = trans('app.go_to_invoices');
                    endif;
                    @endphp
                    <div class="pull-right">
                        <a href="{{ $backlink }}">
                            <span class="btn btn-xs btn-primary">
                                {{ $button }}
                            </span>
                        </a>
                        <span class="btn btn-xs btn-warning" data-toggle="collapse" data-target="#collapse"
                              aria-expanded="false" aria-controls="collapse">
                                {!! trans('app.notice_current_status_is_currentstatus_click_to_read_more',["currentstatus" => "<i>" . trans('app.draft') . "</i>"]) !!}
                            </span>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="collapse" id="collapse">
                        <div class="text-muted">{!! trans('descriptions.invoice_status_draft') !!}</div>
                        <hr>
                    </div>
                    <form role="form" method="POST"
                          action="{{ url(Session::get('guard') . '/invoices/'. $invoice->id .'/build') }}"
                          class="autosave">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="row">
                            @php
                                $customernames = ucwords($invoice->customer->prefix . ' ' . $invoice->customer->firstname . ' ' . $invoice->customer->lastname)
                            @endphp
                            <div class="col-md-6">
                                <label class="col-md-12">{{ trans('app.customer') }} <span
                                            class="required"> * </span></label>
                                <div class="form-group">
                                    <select name="find_id" class="form-control customer_search"
                                            required>
                                        <option value="{{ $invoice->customer->id }}"
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
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="col-md-12">{{ trans('app.invoice_date') }} <span
                                                    class="required"> * </span></label>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose"
                                                       placeholder="YYYY-MM-DD" name="invoice_date"
                                                       value="{{ $invoice->invoice_date }}" readonly
                                                       required>
                                                <span class="input-group-addon"><i class="icon-calender"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-md-12">{{ trans('app.due_date') }} <span
                                                    class="required"> * </span></label>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-autoclose"
                                                       placeholder="YYYY-MM-DD"
                                                       name="due_date"
                                                       value="{{ $invoice->due_date }}"
                                                       readonly required>
                                                <span class="input-group-addon"><i class="icon-calender"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-md-12">{{ trans('app.currency') }} <span
                                                    class="required"> * </span></label>
                                        <div class="form-group">
                                            <select name="currency" id="currency" class="form-control select2" required>
                                                @foreach ($currencies as $currency)
                                                    <optgroup
                                                            label="{{ strtoupper($currency->code) }} : {{ $currency->symbol }}">
                                                        <option value="{{ $currency->code }}"
                                                                @if($invoice->currency == $currency->code) selected @endif>{{ strtoupper($currency->name) }}</option>
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-md-12">{{ trans('app.purchase_order_no') }}</label>
                                        <div class="form-group">
                                            <input type="text" name="purchase_order_no"
                                                   value="{{ $invoice->purchase_order_no }}" maxlength="150"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div style="display:none;" id="validateCurrencyDifference">
                                        <div class="col-md-12">
                                            <div class="alert alert-danger"> {!! trans('descriptions.quote_exchange_rate',["profilecurrency" => "<b>".$profile->profile_billing->default_currency."</b>"]) !!} </div>
                                        </div>
                                    </div>
                                        <div class="col-md-12">
                                            <label class="col-md-12">{{ trans('app.tax_configuration') }} <span
                                                        class="required"> * </span>
                                                <small>{{trans('app.will_be_displayed_on_pdf_documents')}}</small>
                                            </label>
                                            <div class="form-group">
                                                <select name="tax_configuration_id" class="form-control" required>
                                                    <option value="">
                                                        {{ trans('app.select_a_selectwhat',["selectwhat" => trans('app.tax_configuration')]) }}
                                                    </option>
                                                    @foreach ($tax_configurations as $tax_configuration)
                                                        <option value="{{ $tax_configuration->id }}"
                                                                @if($invoice->tax_configuration_id == $tax_configuration->id) selected @endif>{{ $tax_configuration->title }}
                                                            : {{ $tax_configuration->percentage }}%
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    <div class="col-md-12">
                                        <label class="col-md-12">{{ trans('app.optional_reference') }}</label>
                                        <div class="form-group">
                                            <input type="text" name="optional_reference"
                                                   value="{{ $invoice->optional_reference }}" maxlength="150"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    @if($profile->custom_invoice_fields != null)
                                        @foreach($profile->custom_invoice_fields as $invoicefield)
                                            @php
                                                $fieldvalue = $invoice->custom_invoice_field_values->where('custom_invoice_field_id', $invoicefield->id)->first();
                                                if($fieldvalue != null):
                                                $fieldvalue = $fieldvalue->field_value;
                                                else:
                                                $fieldvalue = null;
                                                endif;
                                            @endphp
                                            <div class="col-md-6">
                                                <label class="col-md-12">{{ $invoicefield->field_name }} @if($invoicefield->required == 'yes')
                                                        * @endif </label>
                                                <div class="form-group">
                                                    @if($invoicefield->type == 'text')
                                                        <input type="text" name="customfield[{{ $invoicefield->id }}]"
                                                               value="{{ $fieldvalue }}"
                                                               class="form-control"
                                                               @if($invoicefield->required == 'yes') required @endif>
                                                    @endif
                                                    @if($invoicefield->type == 'number')
                                                        <input type="number" name="customfield[{{ $invoicefield->id }}]" value="{{ $fieldvalue }}"
                                                               class="form-control"
                                                               @if($invoicefield->required == 'yes') required @endif>
                                                    @endif
                                                    @if($invoicefield->type == 'menu')
                                                        @php
                                                            $menuoptions = explode(',', $invoicefield->menu_options);
                                                        @endphp
                                                        @if(count($menuoptions) > 0)
                                                            <select name="customfield[{{ $invoicefield->id }}]"
                                                                    class="form-control"
                                                                    @if($invoicefield->required == 'yes') required @endif>
                                                                <option value="">
                                                                    {{ trans('app.select_an_option') }}
                                                                </option>
                                                                @foreach ($menuoptions as $menuoption)
                                                                    <option value="{{ $menuoption }}" @if($fieldvalue == $menuoption) selected @endif>
                                                                        {{ $menuoption }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-right">
                                <a class="fetchajaxpage"
                                   href="{{ url(Session::get('guard') . '/invoices/' . $invoice->id . '/add_item') }}">
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
                <span class="buildlinks">

                </span>
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
<script type="text/javascript">
    jQuery('.datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd'
    });

    $(".customer_search").on("change", function (e) {

        var customer_id = $(this).find("option:selected").val();
        var reloadurl = '{{ url(Session::get('guard') . '/ajaxdata/customer_search_view') }}/' + customer_id;

        $('.ajaxreload').empty();
        $(".ajaxreload").prepend('<div style="padding:10px; text-align:center;"><p><img src="{{ url("") }}/assets/loading-spinner-default.gif"></p></div>');
        var xhr = $(".ajaxreload").load(reloadurl, function (response, status, xhr) {
            e.preventDefault();
            var responseText = xhr.responseText;
        });

//        xhr.abort();
    });

    function validateCurrencyDifference() {
        if ($("#currency").val() != "{{ $profile->profile_billing->default_currency }}") {
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

        var buildlinks = $(".buildlinks").load("{{ url(Session::get('guard') . '/invoices/' . $invoice->id . '/buildlinks') }}", function (response, status, buildlinks) {

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
        getBuildLinks

        // load default ajax items
        if (ajax_items) {
            ajax_items.abort();
        }
        $(".reload").empty(); // empty parent page div and show loader to load
        $(".reload").prepend('<p class="text-center">{{ trans("app.fetching_data") }}</p>');

        var ajax_items = $(".reload").load("{{ url(Session::get('guard') . '/invoices/' . $invoice->id . '/items') }}", function (response, status, ajax_items) {

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


        $(".customer_search").select2({
            ajax: {
                url: '{{ url(Session::get('guard') . '/ajaxdata/customer_search') }}',
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