<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.cancel_a_did_number_at') }} {{ ucwords($configuration->static_sms_provider->sms_gateway_provider) }}</h4>
</div>
<form role="form" method="POST"
      action="{{ url(Session::get('guard') . '/sv_gateway_providers/'.$configuration->id.'/cancel_numbers/'.Request::segment(5)) }}">
    <div class="modal-body">
        {{ csrf_field() }}
        <div class="form-body">
            @if(count($ownedNumbers) > 0)
                <div class="form-group">
                    <label>{{ trans('app.select_a_number_you_would_like_to_cancel') }} <span
                                class="required"> * </span></label>

                    @foreach ($ownedNumbers as $instance)
                        <div class="radio">
                            <input type="radio" name="msisdn" value="{{ $instance->msisdn }}" id="{{ $instance->msisdn }}">
                            <label for="{{ $instance->msisdn }}">
                                <input type="hidden" name="country[{{ $instance->msisdn }}]"
                                       value="{{ $instance->country }}">
                                +{{ $instance->msisdn }}
                            </label>
                        </div>
                    @endforeach
                </div>
            @else
                {{ trans('app.no_data_found') }}
            @endif
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('app.submit') }}</button>
    </div>
</form>