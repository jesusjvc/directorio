<form role="form" method="POST" action="{{ url('payment/add-funds/paypal/' . $profile->id) }}">
    {{ csrf_field() }}
    <h4>
        {{ $merchantData->payment_method_name }}
    </h4>
    <div class="form-body">
        <label>{{ trans('app.amount') }} </label>
        <div class="form-group">
            <div class="input-group">
                <input type="number" min="1" step="1" name="amount"
                       class="form-control" required>
                <div class="input-group-addon">{{ $profile->profile_billing->default_currency }}</div>
            </div>
        </div>
    </div>
    <button type="submit" id="proceed" class="btn btn-primary" style="width:100%; margin: 5px 0;">
        {{ trans('app.proceed') }}
    </button>
</form>
<a href="{{ url(Session::get('guard') . '/dashboard') }}">
        <span class="btn btn-danger" style="width:100%; margin: 5px 0;">
    {{ trans('app.cancel') }}
</span>
</a>
<script type="text/javascript">
    var button = document.getElementById('proceed')
    button.addEventListener('click', hideshow, true);

    function hideshow() {
        document.getElementById('proceed').style.display = 'none';
        document.getElementById('cancel').style.display = 'block';
        this.style.display = 'none';
    }
</script>