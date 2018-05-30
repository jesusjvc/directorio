<section class="records">
    <div class="reload" id="ajaxpaginateblock">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.invoices') }}
                        @php
                            $createlink = url(Session::get('guard') . '/invoices/create/');
                        if(($class == 'CustomersController') && ($customer != null)):
                            $createlink = url(Session::get('guard') . '/invoices/create/c' . $customer->id);
                        endif;
                        @endphp
                        <div class="pull-right">
                            <a href="{{ $createlink }}">
                        <span class="btn btn-xs btn-success">
                            {{ trans('app.create_a_new_invoice') }}
                        </span>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(count($invoices) > 0)
                            @if($class == 'InvoicesController')
                                <form method="GET" id="q"
                                      action="{{ url(Session::get('guard') . '/invoices/search') }}">
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
                                                    {{ $invoices->total() }} {{ trans_choice('app.result_foundresults_found',count($invoices)) }}
                                                    <mark>{{ Request::input('q') }}</mark>
                                                </p>
                                                <p>
                                                    <a href="{{ url(Session::get('guard') . '/invoices') }}"
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
                                    @if($class == 'InvoicesController')
                                        <th class="text-center oneline">
                                            {{ trans('app.customer_type') }}
                                        </th>
                                        <th>
                                            {{ trans('app.customer') }}
                                        </th>
                                    @endif
                                    <th class="text-center oneline">
                                        {{ trans('app.paid') }}
                                    </th>
                                    <th class="text-center oneline">
                                        {{ trans('app.items') }}
                                    </th>
                                    <th class="text-left oneline">
                                        {{ trans('app.date') }}
                                    </th>
                                    <th class="text-left oneline">
                                        {{ trans('app.due_date') }}
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
                                @if(count($invoices) > 0)
                                    <tbody>
                                    @foreach ($invoices as $invoice)
                                        @if($invoice->customer != null)
                                            @php
                                                $customernames = ucwords($invoice->customer->prefix . ' ' . $invoice->customer->firstname . ' ' . $invoice->customer->lastname)
                                            @endphp
                                            <tr>
                                                <td class="oneline">
                                                    @if($invoice->status == 0)
                                                        <a href="{{ url(Session::get('guard') . '/invoices/' . $invoice->id . '/build') }}">
                                <span class="btn btn-outline btn-primary btn-xs">
                                #{{ $profile->profile_billing->invoice_number_prefix }}{{ $invoice->invoice_no }}
                                </span>
                                                        </a>
                                                    @else
                                                        <a class="btn btn-default btn-xs"
                                                           href="{{ url(Session::get('guard') . '/invoices/' . $invoice->id . '/preview') }}"
                                                           target="_blank" title="{{ trans('app.print_or_view') }}"
                                                           class="tableicon">#{{ $profile->profile_billing->invoice_number_prefix }}{{ $invoice->invoice_no }}
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="text-left oneline">
                                                    @if($invoice->status == 0)
                                                        <span class="yellowbg"
                                                              style="background-color:#ffff83;"><i
                                                                    class="fa fa-unlock"></i> {{ $invoice->text_status }}</span>
                                                    @else
                                                        <i class="fa fa-lock"></i> {{ $invoice->text_status }}
                                                    @endif
                                                </td>
                                                @if($class == 'InvoicesController')
                                                    <td class="text-center">
                                <span class="label label-primary">
                                    {{ trans('app.customer') }}
                                </span>
                                                    </td>
                                                    <td class="oneline">
                                                        <a href="{{ url(Session::get('guard') . '/customers/' . $invoice->customer->id) }}">
                                <span class="btn btn-outline btn-info btn-xs">
                                {{ $customernames }}
                                </span>
                                                        </a>
                                                    </td>
                                                @endif
                                                <td class="text-center oneline">
                                                    @if($invoice->status == "0")
                                                        <span class="label label-warning">{{ trans('app.draft') }}</span>
                                                    @else
                                                        @if($invoice->payment_transaction == null)
                                                            <span class="label label-danger">{{ trans('app.no') }}</span>
                                                        @else
                                                            <span class="label label-info">{{ trans('app.yes') }}</span>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($invoice->invoice_items->count() == 0)
                                                        <span class="label label-danger">{{ $invoice->invoice_items->count() }}</span>
                                                    @else
                                                        <span class="label label-info">{{ $invoice->invoice_items->count() }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-left oneline">
                                                    {{ $invoice->invoice_date }}
                                                </td>
                                                <td class="text-left oneline">
                                                    {{ $invoice->due_date }}
                                                </td>
                                                <td class="text-center oneline">
                                                    {{ $invoice->currency }}
                                                </td>
                                                <td class="text-center oneline">
                                                    {{ $invoice->tax_configuration->percentage }}%
                                                </td>
                                                <td class="text-right oneline">
                                                    {{ number_format($invoice->total_amount,$donumberformat) }}
                                                </td>
                                                <td class="text-right oneline">
                                                    @if($invoice->invoice_items->count() > 0)
                                                        @if($invoice->status == "1")
                                                            @if(($invoice->cash_receipt == null) && ($invoice->payment_transaction == null))
                                                                <a class="postconfirm hand tableicon"
                                                                   data-title="{{ trans('app.process_cash_payment') }}"
                                                                   title="{{ trans('app.process_cash_payment') }}"
                                                                   data-description="{!! trans('app.are_you_sure_you_want_to_process_a_cash_receipt_for_invoice_invoice_no',["invoice_no" => "<strong>#" . $profile->profile_billing->invoice_number_prefix.$invoice->invoice_no . "</strong>", "amount" => "<strong>" . $profile->profile_billing->default_currency . number_format($invoice->total_amount,2) . "</strong>"]) !!}"
                                                                   data-reloaddiv="reload"
                                                                   @if($class == 'ProfilesController')
                                                                   data-reloadurl="{{ url(Session::get('guard') . '/' . $invoice->profile_customer->id . '/invoices') }}"
                                                                   @else
                                                                   data-reloadurl="{{ url(Session::get('guard') . '/invoices') }}"
                                                                   @endif
                                                                   data-posturl="{{ url(Session::get('guard') . '/invoices/' . $invoice->id . '/cashreceipt') }}">
                                                                    <i class="fa fa-dollar"></i>
                                                                </a>
                                                            @else
                                                                @if($invoice->cash_receipt != null)
                                                                    <a title="{{ trans('app.view_cash_receipt') }}"
                                                                       href="{{ url('/documents/cash_receipt/' . $invoice->cash_receipt->thumbprint) }}"
                                                                       target="_blank">
                                                                        <i class="fa fa-dollar text-danger"></i>
                                                                    </a>
                                                                @endif
                                                            @endif
                                                        @endif
                                                        <a href="{{ url(Session::get('guard') . '/invoices/' . $invoice->id . '/preview') }}"
                                                           target="_blank" title="{{ trans('app.print_or_view') }}"
                                                           class="tableicon">
                                                            <i class="fa fa-print"></i>
                                                        </a>
                                                        <a href="{{ url(Session::get('guard') . '/invoices/' . $invoice->id . '/download') }}"
                                                           target="_blank" title="{{ trans('app.download') }}"
                                                           class="tableicon">
                                                            <i class="fa fa-cloud-download"></i>
                                                        </a>
                                                        <a class="postconfirm hand tableicon"
                                                           data-title="{{ trans('app.email_invoice') }}"
                                                           title="{{ trans('app.email_invoice') }}"
                                                           data-description="{{  trans('app.do_you_want_to_email_invoice_invoiceno_to_whereto',["invoiceno" => $profile->profile_billing->invoice_number_prefix.$invoice->invoice_no,"whereto" => $customernames]) }}"
                                                           data-reloaddiv="reload"
                                                           @if($class == 'CustomersController')
                                                           data-reloadurl="{{ url(Session::get('guard') . '/customers/' . $invoice->customer->id . '/invoices') }}"
                                                           @else
                                                           data-reloadurl="{{ url(Session::get('guard') . '/invoices') }}"
                                                           @endif
                                                           data-posturl="{{ url(Session::get('guard') . '/invoices/' . $invoice->id . '/email') }}">
                                                            <i class="fa fa-envelope"></i>
                                                        </a>
                                                        {{--<a href="{{ url(Session::get('guard') . '/invoices/' . $invoice->id . '/email_history') }}"--}}
                                                        {{--target="_blank"--}}
                                                        {{--title="{{ trans('app.email_history') }}"--}}
                                                        {{--class="tableicon">--}}
                                                        {{--<i class="fa fa-history"></i>--}}
                                                        {{--</a>--}}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>
                        <div class="panel-footer">
                            <div class="text-center">
                                @if((count($invoices) == 0) && (last(explode('/',url()->current())) != 'search'))
                                    {{ trans('app.no_data_found') }}
                                @endif
                                @if((last(explode('/',url()->current())) == 'search') && (count($invoices) > 0))
                                    <a href="{{ url(Session::get('guard') . '/invoices') }}"
                                       class="fetchajaxpage">{{ trans('app.reset_search') }}</a>
                                @elseif((last(explode('/',url()->current())) == 'search') && (count($invoices) == 0))
                                    <a href="{{ url(Session::get('guard') . '/invoices') }}"
                                       class="fetchajaxpage">{{ trans('app.no_results_found_reset_search') }}</a>
                                @endif
                            </div>
                            @if(method_exists($invoices,'links'))
                                <div align="center">
                                    @if($invoices->links())
                                        <div align="center">
                                            @if(Request::get('q'))
                                                {{ $invoices->appends(['q' => Request::get('q')])->links() }}
                                            @else
                                                {{ $invoices->links() }}
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