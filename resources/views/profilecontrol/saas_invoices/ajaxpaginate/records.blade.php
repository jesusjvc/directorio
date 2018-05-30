<section class="records">
    <div class="reload" id="ajaxpaginateblock">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.invoices') }}
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-left oneline">
                                        #
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
                                        {{ trans('app.total_homecurrency',["homecurrency" => Session::get('profile_settings')->profile_billing->default_currency]) }}
                                        <small>{{ trans('app.incl') }}</small>
                                    </th>
                                </tr>
                                </thead>
                                @if(count($invoices) > 0)
                                    <tbody>
                                    @foreach ($invoices as $invoice)
                                            <tr>
                                                <td class="oneline">
                                                    <a class="btn btn-default btn-xs"
                                                       href="{{ url('documents/invoice/' . $invoice->thumbprint) }}"
                                                       target="_blank" title="{{ trans('app.print_or_view') }}"
                                                       class="tableicon">#{{ $profile->profile_billing->invoice_number_prefix }}{{ $invoice->invoice_no }}
                                                    </a>
                                                </td>
                                                <td class="text-center oneline">
                                                    <span class="label label-info">{{ $invoice->invoice_items->count() }}</span>
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
                                                    {{ number_format($invoice->total_amount,2) }}
                                                </td>
                                            </tr>
                                    @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>
                        <div class="panel-footer">
                            @if(method_exists($invoices,'links'))
                                <div align="center">
                                    @if($invoices->links())
                                        <div align="center">
                                            {{ $invoices->links() }}
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