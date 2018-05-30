<table class="table table-hover">
    <thead>
    <tr>
        <th>{{ trans('app.item_description') }}</th>
        <th class="text-right">{{ trans('app.item_amount') }}</th>
        <th class="text-center">{{ trans('app.quantity') }}</th>
        <th class="text-right">{{ trans('app.total') }}</th>
    </tr>
    </thead>
    <tbody>
    @if($invoice_items->count() > 0)
        @foreach($invoice_items as $item)
            @php
                if(preg_match("/\|\|/",$item->description)):
                    $breakapart = explode('||',$item->description);
                    if(isset($breakapart[0])):
                        $item->description = $breakapart[0];
                    endif;
                    if(isset($breakapart[1])):
                        $item->description .= "<small><i>" . implode(' / ',array_splice($breakapart, 1)) . "</i></small>";
                    endif;
                endif;
            @endphp
            <tr>
                <td>
                    <a class="postconfirm hand tableicon"
                       data-title="{{ trans('app.remove_item') }}"
                       title="{{ trans('app.remove_item') }}"
                       data-description="{!! trans('app.are_you_sure_you_want_to_remove_the_item_theitem',["theitem" => '<strong>' . $item->description . '</strong>']) !!}"
                       data-reloaddiv="reload"
                       data-reloadurl="{{ url(Session::get('guard') . '/invoices/' . $invoice->id . '/items') }}"
                       data-posturl="{{ url(Session::get('guard') . '/invoices/' . $invoice->id . '/items/' . $item->id . '/remove') }}">
                        <span type="button" class="btn btn-danger btn-xs btn-circle"><i class="fa fa-times"></i>
                        </span>
                    </a>
                    {!! $item->description !!}
                </td>
                <td class="text-right">{{ number_format($item->item_amount, $donumberformat) }}</td>
                <td class="text-center">{{ $item->quantity }}</td>
                <td class="text-right">{{ number_format($item->total_amount, $donumberformat) }}</td>
            </tr>
        @endforeach
        <tr>
            <th></th>
            <th class="text-right"></th>
            <th class="text-right">{{ strtoupper(trans('app.total_in_currency',["currency" => $invoice_currency->code])) }} @if($profile->profile_billing->tax_enabled == 1) <i><small>{{ trans('app.excl_tax') }}</small></i> @endif</th>
            @if(strlen($invoice_currency->symbol) > 2)
                <th class="text-right">{{ $invoice_currency->code }} {{ $doc_total }}</th>
            @else
                <th class="text-right">{{ $invoice_currency->symbol }}{{ $doc_total }}</th>
            @endif
        </tr>
        @if(substr(CustomHelper::getDecimals(str_replace(',','',$doc_total)),2))
            <tr>
                <th></th>
                <th class="text-right"></th>
                <th class="text-right">{{ strtoupper(trans('app.rounded_total')) }} @if($profile->profile_billing->tax_enabled == 1) <i><small>{{ trans('app.excl_tax') }}</small></i> @endif</th>
                @if(strlen($invoice_currency->symbol) > 2)
                    <th class="text-right">{{ number_format(str_replace(',','',$doc_total),2) }} {{ $invoice_currency->code }}</th>
                @else
                    <th class="text-right">{{ $invoice_currency->symbol }}{{ number_format(str_replace(',','',$doc_total),2) }}</th>
                @endif
            </tr>
        @endif
    @endif
    </tbody>
</table>
<script type="text/javascript">
    getBuildLinks();
</script>