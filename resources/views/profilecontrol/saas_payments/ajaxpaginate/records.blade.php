<section class="records">
    <div class="reload" id="ajaxpaginateblock">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.payments') }}
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-left oneline">
                                        #
                                    </th>
                                    <th class="text-left oneline">
                                        {{ trans('app.date') }}
                                    </th>
                                    <th class="text-left oneline">
                                        {{ trans('app.payment_gateway') }}
                                    </th>
                                    <th class="text-right oneline">
                                        {{ trans('app.total_homecurrency',["homecurrency" => Session::get('profile_settings')->profile_billing->default_currency]) }}
                                    </th>
                                </tr>
                                </thead>
                                @if(count($payments) > 0)
                                    <tbody>
                                    @foreach ($payments as $payment)
                                            <tr>
                                                <td class="oneline">
                                                    <a href="{{ url('documents/payment/' . $payment->thumbprint) }}"
                                                       target="_blank" title="{{ trans('app.print_or_view') }}"
                                                       class="tableicon">
                                                        <span class="btn btn-default btn-xs">
                                                            #{{ $profile->profile_billing->payment_number_prefix }}{{ $payment->payment_no }}
                                                        </span>
                                                    </a>
                                                </td>
                                                <td class="text-left oneline">
                                                    {{ $payment->payment_date }}
                                                </td>
                                                <td class="text-left oneline">
                                                    {{ $payment->payment_gateway->payment_method_name }}
                                                </td>
                                                <td class="text-right oneline">
                                                    {{ number_format($payment->total_amount,2) }}
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