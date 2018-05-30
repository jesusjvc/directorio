<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.edit_service_item') }}: {{ $itemdata->name }}</h4>
</div>

<form role="form" method="POST" action="{{ url(Session::get('guard') . '/service_items/'.$itemdata->id) }}" id="idForm" reloadurl="{{ url(Session::get('guard') . '/service_items') }}">
    <div class="modal-body">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <p>
            {{trans('app.note_if_you_change_the_item_price_of_this_item_upcoming_subscriptions_will_adapt_the_price_change_automatically_unless_a_custom_subscription_price_has_been_set')}}
        </p>
        <hr>
        <div class="form-body">
            <input type="hidden" name="service_category_id" value="0">
            <input type="hidden" name="units" value="1">
            <div class="form-group">
                <label>{{ trans('app.select_a_category') }} <span class="required"> * </span></label>
                <select class="form-control" name="service_category_id" required>
                    <option value="">{{ trans('app.select_an_option') }}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                                @if($itemdata->service_category_id == $category->id) selected @endif>{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>{{ trans('app.item_name') }} <span class="required"> * </span></label>
                <input type="text" maxlength="100" name="name" value="{{ $itemdata->name }}" class="form-control"
                       required>
            </div>
            <div class="form-group">
                <label>{{ trans('app.amount') }} <span class="required"> * </span><small>{{ trans('app.tax_exclusive') }}</small></label>
                <div class="input-group">
                    <input type="number" min="0" step="0.01" placeholder="0.00" value="{{ round($itemdata->amount,2) }}"
                           name="amount" class="form-control" required>
                    <div class="input-group-addon">{{ Session::get('profile_settings')->profile_billing->default_currency }}</div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('app.save') }}</button>
    </div>
</form>