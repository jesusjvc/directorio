<h4>
        {{ $merchantData->payment_method_name }}
</h4>
<p class="text-muted">
    {!! $merchantData->instructions !!}
</p>
<p class="text-muted">
    @if(Session::get('guard') == 'profilecontrol')
        {!! trans('app.always_use_your_account_number_number_as_payment_reference', ["number" => "<strong>" . Auth::guard(Session::get('guard'))->user()->profile->account_number . "</strong>"]) !!}
    @else
        {!! trans('app.always_use_your_email_address_address_as_payment_reference', ["address" => "<strong>" . Auth::guard(Session::get('guard'))->user()->email . "</strong>"]) !!}
    @endif
</p>
<a href="{{ url(Session::get('guard') . '/dashboard') }}">
        <span class="btn btn-danger" style="width:100%; margin: 5px 0;">
    {{ trans('app.go_back') }}
</span>
</a>