<div class="reload">
    <form role="form" method="POST" action="{{ url(Session::get('guard') . '/sms_provider_charge_configuration') }}" id="idForm">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.charge_per_inbound_sms') }} <span class="required"> * </span><small>{{ trans('app.tax_exclusive') }}</small></label>
                        <div class="input-group">
                            <input type="text" step="0.00001" min="0" name="charge_per_inbound_sms"
                                   value="{{ $settings->charge_per_inbound_sms }}" class="form-control" required>
                            <div class="input-group-addon">{{ Session::get('profile_settings')->profile_billing->default_currency }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.profit_per_outbound_sms') }}
                            <small><i>{{ trans('app.160_characters') }}</i></small>
                            <span class="required"> * </span></label>
                        <div class="input-group">
                            <input type="number" min="0" name="profit_per_outbound_sms"
                                   value="{{ $settings->profit_per_outbound_sms }}" class="form-control" required>
                            <div class="input-group-addon">%</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.profit_per_outbound_call') }}<span class="required"> * </span></label>
                        <div class="input-group">
                            <input type="number" min="0" name="profit_per_outbound_call"
                                   value="{{ $settings->profit_per_outbound_call }}" class="form-control" required>
                            <div class="input-group-addon">%</div>
                        </div>
                    </div>
                </div>
                {{--<div class="col-md-6">--}}
                    {{--<div class="form-group">--}}
                        {{--<label>{{ trans('app.profit_per_extended_number_validation') }} <span--}}
                                    {{--class="required"> * </span></label>--}}
                        {{--<div class="input-group">--}}
                            {{--<input type="number" min="0" name="profit_per_extended_number_validation"--}}
                                   {{--value="{{ $settings->profit_per_extended_number_validation }}" class="form-control"--}}
                                   {{--required>--}}
                            {{--<div class="input-group-addon">%</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
        <div class="panel-footer text-right">
            <button class="btn btn-primary">{{ trans('app.save') }}</button>
        </div>
    </form>
</div>