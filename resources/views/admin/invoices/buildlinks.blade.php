@if(count($invoice->invoice_items) > 0)
    <div class="panel-footer text-right">
        <a href="{{ url(Session::get('guard') . '/invoices/' . $invoice->id . '/download') }}" target="_blank">
            <span class="btn btn-info btn-sm ">{{ trans('app.download') }}</span>
        </a>
        <a href="{{ url(Session::get('guard') . '/invoices/' . $invoice->id . '/preview') }}" target="_blank">
            <span class="btn btn-info btn-sm">{{ trans('app.preview_print') }}</span>
        </a>
        <span class="btn btn-info btn-sm postconfirm" data-title="{{ trans('app.email_invoice') }}"
              data-description="{{  trans('app.do_you_want_to_email_this_invoice') }}"
              data-reloaddiv="reload"
              data-reloadurl="{{ url(Session::get('guard') . '/invoices/' . $invoice->id . '/items') }}"
              data-posturl="{{ url(Session::get('guard') . '/invoices/' . $invoice->id . '/email') }}">
                        {{ trans('app.email') }}
                        </span>
        @if ($invoice->status == 0)
            <span class="btn btn-info btn-sm postconfirm" data-title="{{ trans('app.lock_this_invoice') }}"
                  data-description="{{  trans('app.are_you_sure_you_want_to_lock_this_invoice_invoices_should_be_locked_after_final_editing_and_changes_has_been_made') }}"
                  data-reloaddiv="reload"
                  data-redirect="{{ url(Session::get('guard') . '/invoices') }}"
                  data-reloadurl="{{ url(Session::get('guard') . '/invoices/' . $invoice->id . '/items') }}"
                  data-posturl="{{ url(Session::get('guard') . '/invoices/' . $invoice->id . '/lockinvoice') }}">
                        {{ trans('app.lock_this_invoice') }}
                        </span>
        @endif
        @if ($invoice->status == 0)
            <span class="btn btn-info btn-sm postconfirm" data-title="{{ trans('app.process_cash_payment') }}"
                  data-description="{{  trans('app.are_you_sure_you_want_to_process_a_cash_receipt_for_this_invoice_note_that_the_invoice_will_be_locked_and_no_further_editing_will_be_possible') }}"
                  data-reloaddiv="reload"
                  data-redirect="{{ url(Session::get('guard') . '/invoices') }}"
                  data-reloadurl="{{ url(Session::get('guard') . '/invoices/' . $invoice->id . '/items') }}"
                  data-posturl="{{ url(Session::get('guard') . '/invoices/' . $invoice->id . '/cashreceipt') }}">
                        {{ trans('app.process_cash_payment') }}
                        </span>
        @endif
    </div>
@endif
<script type="text/javascript">



</script>