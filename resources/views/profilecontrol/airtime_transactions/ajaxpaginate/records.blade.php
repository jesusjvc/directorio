<section class="records">
    <div class="reload" id="ajaxpaginateblock">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.airtime_transactions') }}
                        <div class="pull-right">
                            <span class="btn btn-xs btn-warning" data-toggle="collapse" data-target="#collapse"
                                  aria-expanded="false" aria-controls="collapse">
                                {!! trans('app.airtime_explained') !!}
                            </span>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="collapse" id="collapse">
                            <div class="text-muted">{!! trans('descriptions.airtime_explained_alt') !!}</div>
                            <hr>
                        </div>
                        <div class="text-muted">
                            {{ trans('app.account_balance') }}
                            : {{ number_format($profile->accountbalance,2) }} {{ Session::get('profile_settings')->profile_billing->default_currency }}
                            <br>
                            {{ trans('app.airtime_balance') }}
                            : {{ number_format($profile->airtimebalance,2) }} {{ Session::get('profile_settings')->profile_billing->default_currency }}
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th class="text-left">
                                        {{ trans('app.date') }}
                                    </th>
                                    <th class="text-left">
                                        {{ trans('app.invoice') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('app.sms') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('app.call') }}
                                    </th>
                                    <th class="text-right">
                                        {{ trans('app.airtime_credited') }}
                                    </th>
                                    <th class="text-right">
                                        {{ trans('app.transaction_amount') }}
                                    </th>
                                </tr>
                                </thead>
                                @if(count($transactions) > 0)
                                    <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>
                                                {{ $transaction->created_at }}
                                            </td>
                                            <td>
                                                @if($transaction->invoice != null)
                                                    <a class="btn btn-default btn-xs"
                                                       href="{{ url('documents/invoice/' . $transaction->invoice->thumbprint) }}"
                                                       target="_blank" title="{{ trans('app.print_or_view') }}"
                                                       class="tableicon">
                                                        #{{ Session::get('profile_settings')->profile_billing->invoice_number_prefix }}{{ $transaction->invoice->invoice_no }}
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($transaction->sms_log != null)
                                                    <span data-toggle="tooltip" data-trigger="click" data-placement="top" title="{{ $transaction->sms_log->message }}" data-original-title="{{ $transaction->sms_log->message }}">
                                                    <i class="fa fa-eye"></i>
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($transaction->call_log != null)
                                                    <span data-toggle="tooltip" data-trigger="click" data-placement="top" title="{{ $transaction->call_log->message }}" data-original-title="{{ $transaction->call_log->message }}">
                                                    <i class="fa fa-eye"></i>
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                @if($transaction->invoice != null)
                                                    {{ number_format($transaction->total_amount,2) }}
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                @if($transaction->total_amount != null)
                                                    {{ number_format($transaction->total_amount,2) }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>
                        <div class="panel-footer">
                            @if(method_exists($transactions,'links'))
                                <div align="center">
                                    @if($transactions->links())
                                        <div align="center">
                                            {{ $transactions->links() }}
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