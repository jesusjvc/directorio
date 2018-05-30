<div class="row">
    <div class="col-md-12">
        <label>{{ trans('app.select_a_service_option') }} <span class="required"> * </span></label>
        <div class="form-group">
            <select class="form-control select2" style="width:100%;" id="subscription_package_id" name="subscription_package_id" required>
                <option value="">{{ trans('app.select_an_option') }}</option>
                @foreach ($subscriptionplans as $option)
                    <option value="{{ $option->id }}" @if(old('subscription_package_id') == $option->id) selected @endif>{{ $option->name }} @ {{ number_format($option->monthly_charge_per_profile,2) }} {{ Session::get('profile_settings')->profile_billing->default_currency }} /{{ trans('app.month') }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <label>{{ trans('app.tax_configuration') }} <span
                    class="required"> * </span></label>
        <div class="form-group">
            <select name="tax_configuration_id" class="form-control select2" style="width:100%;"
                    required>
                <option value="">
                    {{ trans('app.select_a_selectwhat',["selectwhat" => trans('app.tax_configuration')]) }}
                </option>
                @foreach($tax_configurations as $tax_configuration)
                    <option value="{{ $tax_configuration->id }}" @if(old('tax_configuration_id') == $tax_configuration->id) selected @endif>
                        {{ $tax_configuration->title }}
                        : {{ $tax_configuration->percentage }}%
                    </option>
                @endforeach
            </select>
            <div class="help-block with-errors"></div>
        </div>
    </div>
</div>