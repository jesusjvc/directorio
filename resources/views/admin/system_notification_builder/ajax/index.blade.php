<div class="reload">
    <form role="form" method="POST" action="{{ url(Session::get('guard') . '/system_notification_builder') }}" id="idForm">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="panel-body">
            <p align="center">{{ trans('app.important_all_values_should_be_comma_separated') }}</p>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.days_before_trial_accounts_expire_to_send_a_notice') }} <span
                                    class="required"> * </span></label>
                        <input type="text"maxlength=30 name="trial_accounts_expiry_days"
                               value="{{ $configuration->trial_accounts_expiry_days }}" class="form-control"
                               required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.days_before_electronic_signature_tokens_expire_to_send_a_notice') }} <span
                                    class="required"> * </span></label>
                        <input type="text"maxlength="30" name="token_expiry_days"
                               value="{{ $configuration->token_expiry_days }}" class="form-control"
                               required>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer text-right">
            <button class="btn btn-primary">{{ trans('app.save') }}</button>
        </div>
    </form>
</div>