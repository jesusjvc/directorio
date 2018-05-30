<section class="records">
    <div class="reload" id="ajaxpaginateblock">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.payments') }}
                        @php
                            $createlink = url(Session::get('guard') . '/payments/create/');
                        if(($class == 'CustomersController') && ($customer != null)):
                            $createlink = url(Session::get('guard') . '/payments/create/c' . $customer->id);
                        endif;
                        if(($class == 'ProfilesController') && ($profile != null)):
                            $createlink = url(Session::get('guard') . '/payments/create/p' . $profile->id);
                        endif;
                        @endphp
                        <div class="pull-right">
                            <a href="{{ $createlink }}">
                        <span class="btn btn-xs btn-success">
                            {{ trans('app.process_a_payment') }}
                        </span>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(count($payments) > 0)
                            @if($class == 'PaymentsController')
                                <form method="GET" id="q" action="{{ url(Session::get('guard') . '/payments/search') }}">
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
                                @if(count($payments) > 0)
                                    @if(last(explode('/',url()->current())) == 'search')
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="text-center">
                                                    <p>
                                                        {{ $payments->total() }} {{ trans_choice('app.result_foundresults_found',count($payments)) }}
                                                        <mark>{{ Request::input('q') }}</mark>
                                                    </p>
                                                    <p>
                                                        <a href="{{ url(Session::get('guard') . '/credit_notes') }}"
                                                           class="fetchajaxpage">{{ trans('app.reset_search') }}</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
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
                                    @if($class == 'PaymentsController')
                                        <th class="text-center oneline">
                                            {{ trans('app.customer_type') }}
                                        </th>
                                        <th>
                                            {{ trans('app.customer') }}
                                        </th>
                                    @endif
                                    <th class="text-left oneline">
                                        {{ trans('app.date') }}
                                    </th>
                                    <th class="text-left oneline">
                                        {{ trans('app.invoice') }}
                                    </th>
                                    <th class="text-left oneline">
                                        {{ trans('app.payment_gateway') }}
                                    </th>
                                    <th class="text-right oneline">
                                        {{ trans('app.total_homecurrency',["homecurrency" => Auth::guard(Session::get('guard'))->user()->profile->profile_billing->default_currency]) }}
                                    </th>
                                    <th class="text-center">

                                    </th>
                                </tr>
                                </thead>
                                @if(count($payments) > 0)
                                    <tbody>
                                    @foreach ($payments as $payment)
                                            @php
                                                $customernames = ucwords($payment->customer->prefix . ' ' . $payment->customer->firstname . ' ' . $payment->customer->lastname)
                                            @endphp
                                            <tr>
                                                <td>
                                                    @if($payment->status == 0)
                                                        <a href="{{ url(Session::get('guard') . '/payments/' . $payment->id . '/build') }}">
                                <span class="btn btn-outline btn-primary btn-xs">
                                #{{ $profile->profile_billing->payment_number_prefix }}{{ $payment->payment_no }}
                                </span>
                                                        </a>
                                                    @else
                                                        <a href="{{ url('documents/payment/' . $payment->thumbprint) }}"
                                                           target="_blank" title="{{ trans('app.print_or_view') }}"
                                                           class="tableicon">
                                                        <span class="btn btn-default btn-xs">
                                                            #{{ $profile->profile_billing->payment_number_prefix }}{{ $payment->payment_no }}
                                                        </span>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="text-left">
                                                    @if($payment->status == 0)
                                                        <span class="yellowbg"
                                                              style="background-color:#ffff83;"><i
                                                                    class="fa fa-unlock"></i> {{ $payment->textStatus }}</span>
                                                    @else
                                                        <i class="fa fa-lock"></i> {{ $payment->textStatus }}
                                                    @endif
                                                </td>
                                                @if($class == 'PaymentsController')
                                                    <td class="text-center">
                                <span class="label label-primary">
                                    {{ trans('app.customer') }}
                                </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url(Session::get('guard') . '/customers/' . $payment->customer->id) }}">
                                <span class="btn btn-outline btn-info btn-xs">
                                {{ $customernames }}
                                </span>
                                                        </a>
                                                    </td>
                                                @endif
                                                <td class="text-left">
                                                    {{ $payment->payment_date }}
                                                </td>
                                                <td class="text-left">
                                                    @if($payment->invoice != null)
                                                        #{{ $profile->profile_billing->invoice_number_prefix }}{{ $payment->invoice->invoice_no }}
                                                    @endif
                                                </td>
                                                <td class="text-left">
                                                    {{ $payment->payment_gateway->payment_method_name }}
                                                </td>
                                                <td class="text-right">
                                                    {{ number_format($payment->total_amount,2) }}
                                                </td>
                                                <td class="text-right">
                                                    <a href="{{ url(Session::get('guard') . '/payments/' . $payment->id . '/preview') }}"
                                                       target="_blank" title="{{ trans('app.print_or_view') }}"
                                                       class="tableicon">
                                                        <i class="fa fa-print"></i>
                                                    </a>
                                                    <a href="{{ url(Session::get('guard') . '/payments/' . $payment->id . '/download') }}"
                                                       target="_blank" title="{{ trans('app.download') }}"
                                                       class="tableicon">
                                                        <i class="fa fa-cloud-download"></i>
                                                    </a>
                                                    @if($payment->status == 1)
                                                        <a class="postconfirm hand tableicon"
                                                           data-title="{{ trans('app.email_payment_confirmation') }}"
                                                           title="{{ trans('app.email_payment_confirmation') }}"
                                                           data-description="{{  trans('app.do_you_want_to_email_payment_payment_no_to_whereto',["payment_no" => $profile->profile_billing->payment_number_prefix.$payment->payment_no,"whereto" => $customernames]) }}"
                                                           data-reloaddiv="reload"
                                                           @if($class == 'CustomersController')
                                                           data-reloadurl="{{ url(Session::get('guard') . '/customers/' . $payment->customer->id . '/payments') }}"
                                                           @else
                                                           data-reloadurl="{{ url(Session::get('guard') . '/payments') }}"
                                                           @endif
                                                           data-posturl="{{ url(Session::get('guard') . '/payments/' . $payment->id . '/email') }}">
                                                            <i class="fa fa-envelope"></i>
                                                        </a>
                                                        {{--<a href="{{ url(Session::get('guard') . '/payments/' . $payment->id . '/email_history') }}"--}}
                                                           {{--target="_blank"--}}
                                                           {{--title="{{ trans('app.email_history') }}"--}}
                                                           {{--class="tableicon">--}}
                                                            {{--<i class="fa fa-history"></i>--}}
                                                        {{--</a>--}}
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
                                @if((count($payments) == 0) && (last(explode('/',url()->current())) != 'search'))
                                    {{ trans('app.no_data_found') }}
                                @endif
                                @if((last(explode('/',url()->current())) == 'search') && (count($payments) > 0))
                                    <a href="{{ url(Session::get('guard') . '/payments') }}"
                                       class="fetchajaxpage">{{ trans('app.reset_search') }}</a>
                                @elseif((last(explode('/',url()->current())) == 'search') && (count($payments) == 0))
                                    <a href="{{ url(Session::get('guard') . '/payments') }}"
                                       class="fetchajaxpage">{{ trans('app.no_results_found_reset_search') }}</a>
                                @endif
                            </div>
                            @if(method_exists($payments,'links'))
                                <div align="center">
                                    @if($payments->links())
                                        <div align="center">
                                            @if(Request::get('q'))
                                                {{ $payments->appends(['q' => Request::get('q')])->links() }}
                                            @else
                                                {{ $payments->links() }}
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