<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    @if($category == null)
        <h4 class="modal-title" id="myModalLabel">{{ trans('app.register_a_new_parent_category') }}</h4>
    @else
        <h4 class="modal-title" id="myModalLabel">
            {{ trans('app.register_a_child_category') }}
            <br>
            <small>{{ ucwords($category->title) }}</small>
        </h4>
    @endif
</div>
<form role="form" method="POST" action="{{ url(Session::get('guard') . '/media_manager_categories/create') }}" id="idForm"
      reloadiv="reload" reloadurl="{{ url(Session::get('guard') . '/media_manager') }}">
    @if($category != null)
        <input type="hidden" value="{{ $category->id }}" name="parent_id">
    @endif
    <div class="modal-body">
        {{ csrf_field() }}
        <div class="form-body">
            <div class="form-group">
                <label>{{ trans('app.category_name') }} <span
                            class="required"> * </span></label>
                <input type="text" maxlength="50" name="title" class="form-control" required>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('app.save') }}</button>
    </div>
</form>