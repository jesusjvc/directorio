<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.create_a_new_sms_voice_gateway_configuration') }}</h4>
</div>
<form role="form" method="POST" action="{{ url(Session::get('guard') . '/sms_provider_configurations') }}" id="idForm">
    <div class="modal-body">
        {{ csrf_field() }}
        <div class="form-body">
            <div class="form-group">
                <label>{{ trans('app.configuration_nickname') }} <span
                            class="required"> * </span></label>
                <input type="text" maxlength="100" name="configuration_nickname" class="form-control"
                       placeholder="{{ trans('app.example_twilio_for_usa') }}" required>
            </div>
            <div class="form-group">
                <label>{{ trans('app.do_you_want_to_set_this_configuration_as_the_default_sms_gateway') }}<span
                            class="required"> * </span></label>
                <select class="form-control" name="isdefault" style="width:100%;" required>
                    <option value="1">{{ trans('app.yes') }}</option>
                    <option value="0">{{ trans('app.no') }}</option>
                </select>
            </div>
            <div class="form-group">
                <label>{{ trans('app.global_sms_provider') }} <span
                            class="required"> * </span></label>
                <select class="form-control" name="static_sms_provider_id" style="width:100%;" required>
                    <option value="">{{ trans('app.select_an_option') }}</option>
                    @if(count($static_providers) > 0)
                        @foreach($static_providers as $provider)
                            <optgroup value="{{ $provider->id }}" label="{{ $provider->sms_gateway_provider }}">
                                <option value="{{ $provider->id }}">{{ $provider->sms_gateway_api_variables }}</option>
                            </optgroup>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label>{{ trans('app.your_sms_gateway_account_values') }} <span
                            class="required"> * </span></label>
                <input type="text" maxlength="100" name="sms_gateway_api_values" class="form-control"
                       placeholder="{{ trans('app.example_api_nameusernamepassword') }}" required>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('app.save') }}</button>
    </div>
</form>