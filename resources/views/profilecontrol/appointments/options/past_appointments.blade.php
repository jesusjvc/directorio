<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.past_appointments') }}</h4>
</div>
<div class="modal-body">
    <div class="form-body">
        @if(count($appointments) > 0)
            <ul class="linelist col-md-12">
                @foreach($appointments as $instance)
                    <li>
                        <span>#{{ $instance->reference }}:</span> {{ trans('app.' . $instance->status) }}
                        / {{ CustomHelper::dateTimeLong($instance->date) }}
                    </li>
                @endforeach
            </ul>
            <div class="clearfix"></div>
        @else
            <p class="text-muted text-left">
                {{ trans('app.no_data_found') }}
            </p>
        @endif
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
</div>