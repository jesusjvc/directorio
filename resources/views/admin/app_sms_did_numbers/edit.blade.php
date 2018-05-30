<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.edit_did_number') }}: +{{ $number->did_number }}</h4>
</div>
<form role="form" method="POST" action="{{ url(Session::get('guard') . '/sms_did_numbers/'.$number->id) }}" id="idForm"
      reloadurl="{{ url(Session::get('guard') . '/sms_did_numbers') }}">
    <div class="modal-body">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <p>
            {{trans('app.note_if_you_change_the_item_price_of_this_item_upcoming_subscriptions_will_adapt_the_price_change_automatically_unless_a_custom_subscription_price_has_been_set')}}
        </p>
        <hr>

        <div class="form-body">
            <div class="form-group">
                <label>{{ trans('app.cost_per_month') }} <span class="required"> * </span></label>
                <div class="input-group">
                    <input type="number" step="0.01" min="0" name="cost_per_month" class="form-control"
                           value="{{ $number->cost_per_month }}" required>
                    <div class="input-group-addon">{{ Session::get('profile_settings')->profile_billing->default_currency }}</div>
                </div>
            </div>
            <div class="form-group">
                <label>{{ trans('app.sell_per_month') }} <span class="required"> * </span><small>{{ trans('app.tax_exclusive') }}</small></label>
                <div class="input-group">
                    <input type="number" step="0.01" min="0" name="sell_per_month" class="form-control"
                           value="{{ $number->sell_per_month }}" required>
                    <div class="input-group-addon">{{ Session::get('profile_settings')->profile_billing->default_currency }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('app.save') }}</button>
    </div>
</form>