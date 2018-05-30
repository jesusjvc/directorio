<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ trans('app.business_name') }} <span class="required"> * </span></label>
            <input type="text" maxlength="100" name="business_name" class="form-control"
                   value="{{ old('business_name') }}" required>
        </div>
        <div class="form-group">
            <label>{{ trans('app.business_email_address') }} <span class="required"> * </span></label>
            <input type="email" maxlength="100" name="business_email" class="form-control"
                   value="{{ old('business_email') }}" required>
            <div class="help-block with-errors"></div>
        </div>
        @php
            $oldbusinessphone = null;
            if((old('business_phone')) && ((old('business_phone_prefix')))):
            $oldbusinessphone = substr(old('business_phone'),strlen(old('business_phone_prefix')));
            endif;
        @endphp
        <div class="form-group">
            <label>{{ trans('app.contact_number') }} <span class="required"> * </span></label>
            <div class="row">
                <div class="col-md-4">
                    <select class="form-control select2" name="business_phone_prefix" required>
                        @foreach ($countryCodes as $countryCode)
                            <option value="{{ $countryCode->code }}"
                                    @if($countryCode->code == old('business_phone_prefix')) selected @endif>
                                +{{ $countryCode->code }} {{ $countryCode->country }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-8">
                    <input type="text" maxlength="100" name="business_phone"
                           @if($oldbusinessphone != null) value="{{ $oldbusinessphone }}" @endif class="form-control"
                           required>
                </div>
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ trans('app.web_url') }}</label>
            <input type="text" maxlength="100" name="business_url" value="{{ old('business_url') }}"
                   placeholder="http://www.yourbusiness.com" class="form-control">
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <label>{{ trans('app.default_sms_country_code') }} <span class="required"> * </span></label>
            <select class="form-control select2" name="default_sms_country_code" required>
                @foreach ($countryCodes as $countryCode)
                    <option value="{{ $countryCode->code }}"
                            @if(old('default_sms_country_code') == $countryCode->code) selected @endif>
                        +{{ $countryCode->code }} {{ $countryCode->country }}</option>
                @endforeach
            </select>
            <div class="help-block with-errors"></div>
        </div>
    </div>
</div>