<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ trans('app.business_name') }} <span class="required"> * </span></label>
            <input type="text" maxlength="100" name="business_name" class="form-control"
                   value="{{ $profile->business_name }}" required>
        </div>
        <div class="form-group">
            <label>{{ trans('app.business_email_address') }} <span class="required"> * </span> <i class="fa fa-info-circle" data-toggle="tooltip" title="{{ trans('app.this_email_address_will_be_used_to_send_mail_from') }}"></i></label>
            <input type="email" maxlength="100" name="business_email" class="form-control"
                   value="{{ $profile->business_email }}" required>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <label>{{ trans('app.contact_number') }} <span class="required"> * </span></label>
            <div class="input-group">
                <span class="input-group-addon">+</span>
                <input type="text" maxlength="100" name="business_phone" value="{{ $profile->business_phone }}"
                       placeholder="{{ trans('app.cellphone_and_landline_numbers_must_be_in_an_e164_format_18001010') }}"
                       class="form-control" required>
            </div>
            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ trans('app.web_url') }}</label>
            <input type="text" maxlength="100" name="business_url" value="{{ $profile->business_url }}"
                   placeholder="http://www.yourbusiness.com" class="form-control">
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <label>{{ trans('app.default_sms_country_code') }} <span class="required"> * </span></label>
            <select class="form-control select2" name="default_sms_country_code" required>
                @foreach ($countryCodes as $countryCode)
                    <option value="{{ $countryCode->code }}"
                            @if($profile->default_sms_country_code == $countryCode->code) selected @endif>
                        +{{ $countryCode->code }} {{ $countryCode->country }}</option>
                @endforeach
            </select>
            <div class="help-block with-errors"></div>
        </div>
    </div>
</div>