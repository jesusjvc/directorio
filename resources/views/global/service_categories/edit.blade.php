<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.edit_service_category') }}
        : {{ $categorydata->category_name }}</h4>
</div>

<form role="form" method="POST" action="{{ url(Session::get('guard') . '/service_categories/'.$categorydata->id) }}" reloadiv="reloadservicecategories" id="idForm" reloadurl="{{ url(Session::get('guard') . '/service_categories') }}">
    <div class="modal-body">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-body">
            <div class="form-group">
                <label>{{ trans('app.gateway_title') }} <span
                            class="required"> * </span></label>
                <input type="text" maxlength="100" name="category_name" value="{{ $categorydata->category_name }}"
                       class="form-control" required>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('app.save') }}</button>
    </div>
</form>