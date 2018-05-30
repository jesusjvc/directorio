<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.edit_media_category_category', ["category"  =>  $category->title]) }}</h4>
</div>
<form role="form" method="POST" action="{{ url(Session::get('guard') . '/media_manager_categories/edit/' . $category->id) }}" id="idForm"
      reloadiv="reload" reloadurl="{{ url(Session::get('guard') . '/media_manager') }}">
    <div class="modal-body">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-body">
            <div class="form-group">
                <label>{{ trans('app.category_name') }} <span
                            class="required"> * </span></label>
                <input type="text" maxlength="50" name="title" value="{{ $category->title }}" class="form-control" required>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('app.save') }}</button>
    </div>
</form>