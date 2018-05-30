<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.edit_gateway_configuration') }}
        : {{ $configuration->configuration_nickname }}</h4>
</div>
<form role="form" method="POST" action="{{ url(Session::get('guard') . '/sms_provider_configurations/'.$configuration->id) }}" id="idForm"
      reloadurl="{{ url(Session::get('guard') . '/sms_provider_configurations') }}">
    <div class="modal-body">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-body">
            <div class="form-group">
                <label>{{ trans('app.configuration_nickname') }} <span
                            class="required"> * </span></label>
                <input type="text" maxlength="100" name="configuration_nickname" class="form-control"
                       value="{{ $configuration->configuration_nickname }}"
                       placeholder="{{ trans('app.example_twilio_for_usa') }}" required>
            </div>
            <div class="form-group">
                <label>{{ trans('app.global_sms_provider') }} <span
                            class="required"> * </span></label>
                <select class="form-control" name="static_sms_provider_id" style="width:100%;" required>
                    <option value="">{{ trans('app.select_an_option') }}</option>
                    @if(count($static_providers) > 0)
                        @foreach($static_providers as $provider)
                            <optgroup value="{{ $provider->id }}" label="{{ $provider->sms_gateway_provider }}">
                                <option value="{{ $provider->id }}"
                                        @if($configuration->static_sms_provider_id == $provider->id) selected @endif>{{ $provider->sms_gateway_api_variables }}</option>
                            </optgroup>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label>{{ trans('app.your_sms_gateway_account_values') }} <span
                            class="required"> * </span></label>
                <input type="text" maxlength="100" name="sms_gateway_api_values" class="form-control"
                       value="{{ $configuration->sms_gateway_api_values }}"
                       placeholder="{{ trans('app.example_api_nameusernamepassword') }}" required>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('app.save') }}</button>
    </div>
</form>