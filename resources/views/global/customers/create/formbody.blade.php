<div class="panel-body">
    <div class="row">
        <div class="col-md-12">
            <h4>{{ trans('app.customer_information') }} </h4>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>{{ trans('app.prefix') }} <span class="required"> * </span></label>
                <select class="form-control" name="prefix" required>
                    @foreach ($prefixes as $prefix)
                        <option value="{{ $prefix->prefix }}"
                                @if($prefix->prefix == old('prefix')) selected @endif>{{ trans('app.'.$prefix->prefix) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>{{ trans('app.firstname') }} <span class="required"> * </span></label>
                <input type="text" maxlength="100" name="firstname" value="{{ old('firstname') }}"
                       class="form-control" required>
            </div>
            <div class="form-group">
                <label>{{ trans('app.lastname') }} <span class="required"> * </span></label>
                <input type="text" maxlength="100" name="lastname" value="{{ old('lastname') }}"
                       class="form-control" required>
            </div>
            <div class="form-group">
                <label>{{ trans('app.email_address') }} <span class="required"> * </span></label>
                <input type="email" maxlength="100" name="email" value="{{ old('email') }}"
                       class="form-control"
                       required>
            </div>
        </div>
        <div class="col-md-6">
            @php
                $oldcontact_number = null;
                if((old('mobile_no')) && ((old('mobile_no_prefix')))):
                $oldcontact_number = substr(old('mobile_no'),strlen(old('mobile_no_prefix')));
                endif;
            @endphp
            <div class="form-group">
                <label>{{ trans('app.cellphone_number') }} <span class="required"> * </span></label>
                <div class="row">
                    <div class="col-md-4">
                        <select class="form-control select2" name="mobile_no_prefix" required>
                            @foreach ($countryCodes as $countryCode)
                                <option @if($countryCode->code == old('mobile_no_prefix')) selected
                                        @endif value="{{ $countryCode->code }}">
                                    +{{ $countryCode->code }} {{ $countryCode->country }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-8">
                        <input type="text" maxlength="100" name="mobile_no"
                               @if($oldcontact_number != null) value="{{ $oldcontact_number }}"
                               @endif class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>{{ trans('app.timezone') }} <span class="required"> * </span></label>
                <select name="timezone" class="form-control select2" required>
                    @foreach ($timezones as $timezone)
                        <option value="{{ $timezone }}" @if(old('timezone') == $timezone) selected
                                @elseif($profile->timezone == $timezone) selected @endif>{{ str_replace("_", " ", $timezone) }}</option>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <label>{{ trans('app.default_currency') }} <span class="required"> * </span>
                </label>
                <select name="default_currency" class="form-control select2" required>
                    @foreach ($currencies as $currency)
                        <optgroup
                                label="{{ strtoupper($currency->code) }} : {{ $currency->symbol }}">
                            <option value="{{ $currency->code }}"
                                    @if(old('default_currency') == $currency->code) selected
                                    @elseif($currency->code == $profile->profile_billing->default_currency) selected @endif>{{ strtoupper($currency->name) }}</option>
                        </optgroup>
                    @endforeach
                </select>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <label>{{ trans('app.tax_number') }} <span class="required"> <i>{{ trans('app.optional') }}</i> </span></label>
                <input type="text" maxlength="100" name="tax_number" value="{{ old('tax_number') }}"
                       class="form-control">
            </div>
            <div class="form-group">
                <label>{{ trans('app.paper_size') }} <span class="required"> * </span></label>
                <select class="form-control" name="paper_size" required>
                    <option value="A4" @if(old('paper_size') == 'A4') selected
                            @elseif ($profile->paper_size == 'A4') selected @endif>A4
                    </option>
                    <option value="Letter" @if(old('paper_size') == 'Letter') selected
                            @elseif ($profile->paper_size == 'Letter') selected @endif>Letter
                    </option>
                </select>
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <h4>{{ trans_choice('app.billing_address',1) }} </h4>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.address_1') }} <span
                                    class="required"> * </span></label>
                        <input type="text" maxlength="100" name="billing_address_1"
                               value="{{ old('billing_address_1') }}" class="form-control" required>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.address_2') }}</label>
                        <input type="text" maxlength="100" name="billing_address_2"
                               value="{{ old('billing_address_2') }}" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.city') }} <span class="required"> * </span></label>
                        <input type="text" maxlength="100" name="billing_city"
                               value="{{ old('billing_city') }}" class="form-control" required>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.state') }}</label>
                        <input type="text" maxlength="100" name="billing_state"
                               value="{{ old('billing_state') }}" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.postal_code') }}</label>
                        <input type="text" maxlength="100" name="billing_zip"
                               value="{{ old('billing_zip') }}" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans_choice('app.country',1) }} <span class="required"> * </span></label>
                        <select name="billing_country" class="form-control select2" required>
                            @foreach ($countryList as $country)
                                <option value="{{ $country->code }}"
                                        @if(old('billing_country') == $country->code) selected @endif>{{ $country->country }}</option>
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
                    <h4>{{ trans_choice('app.shipping_address',1) }}
                        <small><label><input name="copyBillingAddress" type="checkbox"
                                             onclick="FillBilling(this.form)"> {{ trans('app.copy_billing_address') }}
                            </label></small>
                    </h4>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.address_1') }} <span
                                    class="required"> * </span></label>
                        <input type="text" maxlength="100" name="shipping_address_1"
                               value="{{ old('shipping_address_1') }}" class="form-control"
                               required>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.address_2') }}</label>
                        <input type="text" maxlength="100" name="shipping_address_2"
                               value="{{ old('shipping_address_2') }}" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.city') }} <span class="required"> * </span></label>
                        <input type="text" maxlength="100" name="shipping_city"
                               value="{{ old('shipping_city') }}" class="form-control" required>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.state') }}</label>
                        <input type="text" maxlength="100" name="shipping_state"
                               value="{{ old('shipping_state') }}" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.postal_code') }}</label>
                        <input type="text" maxlength="100" name="shipping_zip"
                               value="{{ old('shipping_zip') }}" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans_choice('app.country',1) }} <span class="required"> * </span></label>
                        <select name="shipping_country" class="form-control select2" id="shipping_country" required>
                            @foreach ($countryList as $country)
                                <option value="{{ $country->code }}"
                                        @if(old('shipping_countryshipping_country') == $country->code) selected @endif>{{ $country->country }}</option>
                            @endforeach
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>