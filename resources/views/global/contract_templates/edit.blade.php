<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.edit_contract_template') }}: {{ $template->title }}</h4>
</div>

<form role="form" method="POST" action="{{ url(Session::get('guard') . '/contract_templates/'.$template->id) }}" id="idForm"
      reloadurl="{{ url(Session::get('guard') . '/contract_templates') }}">
    <div class="modal-body">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-body">
            <div class="form-group">
                <label>{{ trans('app.title') }} <span
                            class="required"> * </span></label>
                <input type="text" maxlength="100" name="title" class="form-control" value="{{ $template->title }}"
                       required>
            </div>
            <div class="form-group">
                <label>{{ trans('app.variable_relation') }} <span class="required"> * </span></label>
                <select class="form-control" name="static_variable_relation_id" id="static_variable_relation_id"
                        required>
                    <option value="" populate="">{{ trans('app.select_an_option') }}</option>
                    @foreach ($relations as $relation)
                        <option value="{{ $relation->id }}"
                                @if($relation->id == $template->static_variable_relation_id) selected
                                @endif populate="{{ $relation->module }}"
                                simtitle="{{ $relation->module }}">{{ $relation->module }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>{{ trans('app.contract_contents') }} <span
                            class="required"> * </span></label>
                <input type="text" maxlength="100" name="contract" value="{{ $template->contract }}"
                       class="form-control" required>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('app.save') }}</button>
    </div>
</form>
@include('global.includes.editor')