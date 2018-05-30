<div class="row">
    <div class="col-md-12">
        <i>{!! trans('descriptions.business_shipping_billing_address',["BUSINESSNAME" => Session::get('profile_settings')->business_name]) !!}</i>
        <hr>
    </div>

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <h4>{{ trans_choice('app.billing_address',1) }}</h4>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('app.address_1') }} <span class="required"> * </span></label>
                    <input type="text" maxlength="100" name="billing_address_1" value="{{ $profile_billing_address->billing_address_1 }}" class="form-control" required>
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('app.address_2') }}</label>
                    <input type="text" maxlength="100" name="billing_address_2" value="{{ $profile_billing_address->billing_address_2 }}" class="form-control">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('app.city') }} <span class="required"> * </span></label>
                    <input type="text" maxlength="100" name="billing_city" value="{{ $profile_billing_address->billing_city }}" class="form-control" required>
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('app.state') }}</label>
                    <input type="text" maxlength="100" name="billing_state" value="{{ $profile_billing_address->billing_state }}" class="form-control">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('app.postal_code') }}</label>
                    <input type="text" maxlength="100" name="billing_zip" value="{{ $profile_billing_address->billing_zip }}" class="form-control">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans_choice('app.country',1) }} <span class="required"> * </span></label>
                    <select name="billing_country" class="form-control select2" required>
                        @foreach ($countryList as $country)
                            <option value="{{ $country->code }}" @if($profile_billing_address->billing_country == $country->code) selected @endif>{{ $country->country }}</option>
                        @endforeach
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <h4>{{ trans_choice('app.shipping_address',1) }}</h4>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('app.address_1') }} <span class="required"> * </span></label>
                    <input type="text" maxlength="100" name="shipping_address_1" value="{{ $profile_shipping_address->shipping_address_1 }}" class="form-control" required>
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('app.address_2') }}</label>
                    <input type="text" maxlength="100" name="shipping_address_2" value="{{ $profile_shipping_address->shipping_address_2 }}" class="form-control">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('app.city') }} <span class="required"> * </span></label>
                    <input type="text" maxlength="100" name="shipping_city" value="{{ $profile_shipping_address->shipping_city }}" class="form-control" required>
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('app.state') }}</label>
                    <input type="text" maxlength="100" name="shipping_state" value="{{ $profile_shipping_address->shipping_state }}" class="form-control">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('app.postal_code') }}</label>
                    <input type="text" maxlength="100" name="shipping_zip" value="{{ $profile_shipping_address->shipping_zip }}" class="form-control">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans_choice('app.country',1) }} <span class="required"> * </span></label>
                    <select name="shipping_country" class="form-control select2" required>
                        @foreach ($countryList as $country)
                            <option value="{{ $country->code }}" @if($profile_shipping_address->shipping_country == $country->code) selected @endif>{{ $country->country }}</option>
                        @endforeach
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
    </div>
</div>