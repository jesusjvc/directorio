<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.register_a_new_service_item') }}</h4>
</div>
<form role="form" method="POST" action="{{ url(Session::get('guard') . '/service_items') }}" id="idForm">
    <div class="modal-body">
        {{ csrf_field() }}
        <div class="form-body">
            <input type="hidden" name="service_category_id" value="0">
            <input type="hidden" name="units" value="1">
            <div class="form-group">
                <label>{{ trans('app.select_a_category') }} <span class="required"> * </span></label>
                <select class="form-control" name="service_category_id" id="service_category_id" required>
                    <option value="">{{ trans('app.select_an_option') }}</option>
                    @foreach ($service_categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>{{ trans('app.item_name') }} <span class="required"> * </span></label>
                <input type="text" maxlength="100" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>{{ trans('app.amount') }} <span class="required"> * </span>
                    <small>{{ trans('app.tax_exclusive') }}</small>
                </label>
                <div class="input-group">
                    <input type="number" min="0" step="0.01" placeholder="0.00" name="amount" class="form-control"
                           required>
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