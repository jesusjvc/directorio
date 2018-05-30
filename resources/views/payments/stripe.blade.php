<form role="form" method="POST" action="{{ url('payment/add-funds/stripe/' . $profile->id) }}">
    {{ csrf_field() }}
    <h4>
        {{ $merchantData->payment_method_name }}
    </h4>
    <div class="form-body">
        <label>{{ trans('app.amount') }} </label>
        <div class="form-group">
            <div class="input-group">
                <input type="number" min="1" step="1" name="amount" placeholder="0.00"
                       class="form-control input-sm" required>
                <div class="input-group-addon">{{ $profile->profile_billing->default_currency }}</div>
            </div>
        </div>
        <label>{{ trans('app.credit_card_number') }} </label>
        <div class="form-group">
                <input type="text" name="card_no" placeholder="1234567891234567"
                       class="form-control input-sm" required>
        </div>
        <label>{{ trans('app.expiry_date') }} </label>
        <div class="form-group">
            <div class="input-group">
                <input type="text" min="01" max="12" step="1" name="ccExpiryMonth" placeholder="MM"
                       class="form-control input-sm" required>
                <div class="input-group-addon">/</div>
                <input type="text" min="{{ date('Y') }}" step="1" name="ccExpiryYear" placeholder="YY"
                       class="form-control input-sm" required>
            </div>
        </div>
        <label>{{ trans('app.ccv_number') }} </label>
        <div class="form-group">
                <input type="number" max="999" step="1" name="cvvNumber" placeholder="123"
                       class="form-control input-sm" required>
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