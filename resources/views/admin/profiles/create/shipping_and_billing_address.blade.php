<div class="row">
    <div class="col-md-12">
        <i>{!! trans('descriptions.business_shipping_billing_address',["BUSINESSNAME" => Session::get('profile_settings')->business_name]) !!}</i>
        <hr>
    </div>

    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <small><label><input name="copyBusinessAddress" type="checkbox" onclick="FillShipping(this.form)"> {{ trans('app.copy_business_address') }}</label></small>
                <h4>{{ trans_choice('app.billing_address',1) }} </h4>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('app.address_1') }} <span class="required"> * </span></label>
                    <input type="text" maxlength="100" name="billing_address_1" value="{{ old('billing_address_1') }}" class="form-control" required>
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('app.address_2') }}</label>
                    <input type="text" maxlength="100" name="billing_address_2" value="{{ old('billing_address_2') }}" class="form-control">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('app.city') }} <span class="required"> * </span></label>
                    <input type="text" maxlength="100" name="billing_city" value="{{ old('billing_city') }}" class="form-control" required>
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('app.state') }}</label>
                    <input type="text" maxlength="100" name="billing_state" value="{{ old('billing_state') }}" class="form-control">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('app.postal_code') }}</label>
                    <input type="text" maxlength="100" name="billing_zip" value="{{ old('billing_zip') }}" class="form-control">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans_choice('app.country',1) }} <span class="required"> * </span></label>
                    <select name="billing_country" id="billing_country" class="form-control select2" style="width:100%;" required>
                        @foreach ($countryList as $country)
                            <option value="{{ $country->code }}" @if(old('billing_country') == $country->code) selected @endif>{{ $country->country }}</option>
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
                <small><label><input name="copyBillingAddress" type="checkbox" onclick="FillBilling(this.form)"> {{ trans('app.copy_billing_address') }}</label></small>
                <h4>{{ trans_choice('app.shipping_address',1) }}</h4>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('app.address_1') }} <span class="required"> * </span></label>
                    <input type="text" maxlength="100" name="shipping_address_1" value="{{ old('shipping_address_1') }}" class="form-control" required>
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('app.address_2') }}</label>
                    <input type="text" maxlength="100" name="shipping_address_2" value="{{ old('shipping_address_2') }}" class="form-control">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('app.city') }} <span class="required"> * </span></label>
                    <input type="text" maxlength="100" name="shipping_city" value="{{ old('shipping_city') }}" class="form-control" required>
                    <div class="help-block with-errors"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('app.state') }}</label>
                    <input type="text" maxlength="100" name="shipping_state" value="{{ old('shipping_state') }}" class="form-control">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('app.postal_code') }}</label>
                    <input type="text" maxlength="100" name="shipping_zip" value="{{ old('shipping_zip') }}" class="form-control">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans_choice('app.country',1) }} <span class="required"> * </span></label>
                    <select name="shipping_country" id="shipping_country" class="form-control select2" style="width:100%;" required>
                        @foreach ($countryList as $country)
                            <option value="{{ $country->code }}" @if(old('shipping_country') == $country->code) selected @endif>{{ $country->country }}</option>
                        @endforeach
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
    </div>
</div>