<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.configure_a_new_service_category') }}</h4>
</div>
<form role="form" method="POST" action="{{ url(Session::get('guard') . '/service_categories') }}" id="idForm" reloadiv="reloadservicecategories" reloadurl="{{ url(Session::get('guard') . '/service_categories') }}">
    <div class="modal-body">
        {{ csrf_field() }}
        <div class="form-body">
            <div class="form-group">
                <label>{{ trans('app.service_category') }} <span
                            class="required"> * </span></label>
                <input type="text" maxlength="100" name="category_name" class="form-control" required>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('app.save') }}</button>
    </div>
</form>