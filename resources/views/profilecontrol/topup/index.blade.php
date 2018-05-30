@if(count($gateways) > 0)
    <h4>
        {{ trans('app.payment_options') }}
    </h4>
    @foreach($gateways as $gateway)
        <a href="{{ url('payment/add-funds/' . str_slug(strtolower($gateway->static_payment_gateway->gateway_name)) . '/' . Session::get('profile_settings')->thumbprint) }}" class="fetchajaxpage" data-reloaddiv="topup">
        <span class="btn btn-primary" style="width:100%; margin: 5px 0;">
            {{ $gateway->payment_method_name }}
        </span>
        </a>
    @endforeach
@endif
<a href="{{ url(Session::get('guard') . '/dashboard') }}">
        <span class="btn btn-danger" style="width:100%; margin: 5px 0;">
    {{ trans('app.cancel') }}
</span>
</a>