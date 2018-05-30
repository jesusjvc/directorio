@if(count($gateways) > 0)
    <h4>
        {{ trans('app.payment_options') }}
    </h4>
        @foreach($gateways as $gateway)
            <a href="{{ url('payment/add-funds/' . str_slug(strtolower($gateway->static_payment_gateway->gateway_name)) . '/' . $profile->thumbprint) }}"
               class="fetchajaxpage" data-reloaddiv="topup">
        <span class="btn btn-primary" style="width:100%; margin: 5px 0;">
            {{ $gateway->payment_method_name }}
        </span>
            </a>
        @endforeach
@else
    <p class="text-muted">
        {{ trans('app.there_are_currently_no_available_online_payment_options') }}
    </p>
@endif
<a href="{{ url('/') }}">
        <span class="btn btn-danger" style="width:100%; margin: 5px 0;">
    {{ trans('app.cancel') }}
</span>
</a>