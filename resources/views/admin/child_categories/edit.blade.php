<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.edit_child_category') }}: {{ $childcategory->name }}</h4>
</div>
<form role="form" method="POST" action="{{ url(Session::get('guard') . '/child_categories/'.$childcategory->id) }}" id="idForm" reloadurl="{{ url(Session::get('guard') . '/child_categories') }}">
    <div class="modal-body">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-body">
            <input type="hidden" name="units" value="1">
            <div class="form-group">
                <label>{{ trans('app.select_a_category') }} <span class="required"> * </span></label>
                <select class="form-control" name="category_division_id" required>
                    <option value="">{{ trans('app.select_an_option') }}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                                @if($childcategory->category_division_id == $category->id) selected @endif>{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>{{ trans('app.child_category_title') }} <span
                            class="required"> * </span></label>
                <input type="text" maxlength="100" placeholder="{{ trans('app.enter_the_title_in_singular_form_eg_eye_specialist_and_not_eye_specialists') }}" name="title" value="{{ $childcategory->title }}"
                       class="form-control" required>
            </div>
        </div>
    </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('app.save') }}</button>
    </div>
</form>