<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.register_a_new_tax_rate') }} @if(isset($profile))<br><small> {{ $profile->business_name }} </small> @endif </h4>
</div>
@php
    if(isset($profile)):
    $reloaddiv = Request::segment(5);
    $modifylink = $profile->id . '/profile_';
    else:
    $reloaddiv = Request::segment(4);
    $modifylink = null;
    endif;
@endphp
<form role="form" method="POST" action="{{ url(Session::get('guard') . '/' . $modifylink . 'tax_configurations') }}" id="idForm">
    <div class="modal-body">
        {{ csrf_field() }}
        <div class="form-body">
            <div class="form-group">
                <label>{{ trans('app.title') }} <span
                            class="required"> * </span></label>
                <input type="text" maxlength="100" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label>{{ trans('app.taxvat_percentage') }} <span class="required"> * </span></label>
                <div class="input-group">
                    <input type="number" step="0.01" min="0" name="percentage" class="form-control" required>
                    <div class="input-group-addon">%</div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('app.save') }}</button>
    </div>
</form>