@if($payment->status == 0)
    <div class="panel-footer">
        <div class="pull-right">
        <a href="{{ url(Session::get('guard') . '/payments/' . $payment->id . '/download') }}" target="_blank">
            <span class="btn btn-info btn-sm ">{{ trans('app.download') }}</span>
        </a>
        <a href="{{ url(Session::get('guard') . '/payments/' . $payment->id . '/preview') }}" target="_blank">
            <span class="btn btn-info btn-sm">{{ trans('app.preview_print') }}</span>
        </a>
        <span class="btn btn-info btn-sm postconfirm" data-title="{{ trans('app.lock_this_payment') }}"
              data-description="{{  trans('app.are_you_sure_you_want_to_lock_this_payment_payments_should_be_locked_after_final_editing_and_changes_has_been_made') }}"
              data-reloaddiv="buildlinks"
              data-redirect="{{ url(Session::get('guard') . '/payments') }}"
              data-reloadurl="{{ url(Session::get('guard') . '/payments/' . $payment->id . '/buildlinks') }}"
              data-posturl="{{ url(Session::get('guard') . '/payments/' . $payment->id . '/lock') }}">
                        {{ trans('app.lock_this_payment') }}
                        </span>
        </div>
        <div class="clear"></div>
    </div>
@endif
<script type="text/javascript">


</script>