<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.edit_subscription_plan') }}: {{ $package->name }}</h4>
</div>
<form role="form" method="POST" action="{{ url(Session::get('guard') . '/service_packages/'.$package->id . '/update') }}" id="idForm"
      reloadurl="{{ url(Session::get('guard') . '/service_packages') }}">
    <div class="modal-body">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <p>
            {{trans('app.note_if_you_change_the_item_price_of_this_item_upcoming_subscriptions_will_adapt_the_price_change_automatically_unless_a_custom_subscription_price_has_been_set')}}
        </p>
        <hr>
        <div class="form-body">
            <div class="form-group">
                <label>{{ trans('app.name') }} <span
                            class="required"> * </span></label>
                <input type="text" maxlength="100" name="name" value="{{ $package->name }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label>{{ trans('app.description') }} <span
                            class="required"> * </span></label>
                <input type="text" maxlength="150" name="description" value="{{ $package->description }}" class="form-control" required>
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <input type="checkbox" value="1" id="adminonly"
                           name="adminonly" @if($package->adminonly == 1) checked @endif>
                    <label for="adminonly">
                        {{ trans('app.allow_this_plan_to_be_used_in_the_administration_section_only') }}
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label>{{ trans('app.trial_accounts_days_to_expire') }} <span
                            class="required"> * </span>
                    <small><i>{{trans('app.for_no_expiry_set_this_value_to_0')}}</i></small>
                </label>
                <div class="input-group">
                    <input type="number" min="0" max="365" value="{{ $package->expire_in_x_days }}" name="expire_in_x_days" value="0" class="form-control"
                           required>
                    <div class="input-group-addon">{{ trans('app.days') }}</div>
                </div>
            </div>
            <div class="form-group">
                <label>{{ trans('app.maximum_customer_accounts') }} <span
                            class="required"> * </span>
                    <small><i>{{trans('app.for_no_limit_set_the_value_to_0')}}</i></small>
                </label>
                <div class="input-group">
                    <input type="number" min="0" name="limit_customer_accounts" value="{{ $package->limit_customer_accounts }}" class="form-control"
                           required>
                    <div class="input-group-addon">{{ trans('app.accounts') }}</div>
                </div>
            <div class="form-group">
                <label>{{ trans('app.maximum_professional_providers') }} <span
                            class="required"> * </span>
                    <small><i>{{trans('app.for_no_limit_set_the_value_to_0')}}</i></small>
                </label>
                <div class="input-group">
                    <input type="number" min="0" name="limit_professional_accounts" value="{{ $package->limit_professional_accounts }}" class="form-control"
                           required>
                    <div class="input-group-addon">{{ trans('app.providers') }}</div>
                </div>
            </div>
            <div class="form-group">
                <label>{{ trans('app.monthly_charge_in_currency_per_profile_account',["currency" => Session::get('profile_settings')->profile_billing->default_currency]) }}
                    <span
                            class="required"> * </span><small>{{ trans('app.tax_exclusive') }}</small></label>
                <div class="input-group">
                    <input type="number" step="0.01" value="{{ $package->monthly_charge_per_profile }}" name="monthly_charge_per_profile" class="form-control"
                           required>
                    <div class="input-group-addon">{{ Session::get('profile_settings')->profile_billing->default_currency }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('app.save') }}</button>
    </div>
</form>