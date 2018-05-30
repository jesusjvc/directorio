<div class="row">
    <div class="col-md-12">
        <i>{!! trans('descriptions.business_address') !!}</i>
        <hr>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ trans('app.address_1') }} <span class="required"> * </span></label>
            <input type="text" maxlength="100" name="business_address_1" value="{{ $profile->business_address_1 }}" class="form-control" required>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <label>{{ trans('app.address_2') }}</label>
            <input type="text" maxlength="100" name="business_address_2" value="{{ $profile->business_address_2 }}" class="form-control">
        </div>
        <div class="form-group">
            <label>{{ trans('app.city') }} <span class="required"> * </span></label>
            <input type="text" maxlength="100" name="business_city" value="{{ $profile->business_city }}" class="form-control" required>
            <div class="help-block with-errors"></div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>{{ trans('app.state') }}</label>
            <input type="text" maxlength="100" name="business_state" value="{{ $profile->business_state }}" class="form-control">
        </div>
        <div class="form-group">
            <label>{{ trans('app.postal_code') }}</label>
            <input type="text" maxlength="100" name="business_zip" value="{{ $profile->business_zip }}" class="form-control">
        </div>
        <div class="form-group">
            <label>{{ trans_choice('app.country',1) }} <span class="required"> * </span></label>
            <select name="business_country" class="form-control select2" style="width:100%" required>
                @foreach ($countryList as $country)
                    <option value="{{ $country->code }}" @if($profile->business_country == $country->code) selected @endif>{{ $country->country }}</option>
                @endforeach
            </select>
            <div class="help-block with-errors"></div>
        </div>
    </div>
</div>