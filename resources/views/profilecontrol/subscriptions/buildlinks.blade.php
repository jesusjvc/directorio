@if($subscription->status == 0)
    <div class="panel-footer">
        <div class="pull-left">
            <p class="text-muted">
                <i>{!! trans('descriptions.note_subscriptions') !!}</i>
            </p>
        </div>
        <div class="pull-right">
            @if($subscription->status == 0)
                <span class="btn btn-info btn-sm postconfirm" data-title="{{ trans('app.activate_this_subscription') }}"
                      data-description="{{  trans('app.are_you_sure_you_want_to_activate_this_subscription') }} {{ trans('app.once_activated_a_subscription_can_not_be_updated_or_de_activated_but_deleted_only') }}"
                      data-reloaddiv="buildlinks"
                      data-redirect="{{ url(Session::get('guard') . '/subscriptions') }}"
                      data-reloadurl="{{ url(Session::get('guard') . '/subscriptions/' . $subscription->id . '/buildlinks') }}"
                      data-posturl="{{ url(Session::get('guard') . '/subscriptions/' . $subscription->id . '/activate') }}">
                        {{ trans('app.activate_this_subscription') }}
                        </span>
            @endif
        </div>
        <div class="clear"></div>
    </div>
@endif
<script type="text/javascript">


</script>