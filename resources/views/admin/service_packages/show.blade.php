<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ $package->name }} <br>
        <small>{{ trans('app.subscription_package') }}</small>
    </h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <dl>
                <dt>{{ trans('app.package_description') }}</dt>
                <dd>{{ $package->description }}</dd>
                <dt>{{ trans('app.monthly_charge_in_currency_per_profile_account', ["currency" =>  Session::get('profile_settings')->profile_billing->default_currency]) }}</dt>
                <dd>{{ number_format($package->monthly_charge_per_profile,2) }}</dd>
                <dt>{{ trans('app.monthly_charge_in_currency_per_user_account', ["currency" =>  Session::get('profile_settings')->profile_billing->default_currency]) }}</dt>
                <dd>{{ number_format($package->monthly_charge_per_user,2) }}</dd>
                <dt>{{ trans('app.days_after_service_will_be_suspended') }}</dt>
                <dd>{{ $package->expire_in_x_days }}</dd>
                <dt>{{ trans('app.customer_limit') }}</dt>
                <dd>@if($package->limit_customer_accounts == 0) {{ trans('app.unlimited') }} @else {{ $package->limit_customer_accounts }} @endif</dd>
                <dt>{{ trans('app.professionals_limit') }}</dt>
                <dd>@if($package->limit_professional_accounts == 0) {{ trans('app.unlimited') }} @else {{ $package->limit_professional_accounts }} @endif</dd>
                @if($package->tax_configuration != null)
                    <dt>{{ trans('app.tax_configuration') }}</dt>
                    <dd>{{ $package->tax_configuration->title }}: {{ $package->tax_configuration->percentage }}%</dd>
                @endif
            </dl>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
</div>