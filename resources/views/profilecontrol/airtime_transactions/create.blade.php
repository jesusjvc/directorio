<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">
        {{ trans('app.buy_airtime') }}
    </h4>
</div>
<form role="form" method="POST" action="{{ url('profilecontrol/airtime/buy') }}">
    <div class="modal-body">
        {{ csrf_field() }}
        @if(($tax_configuration != null) && ($tax_configuration->percentage > 0))
        <p class="text-muted">
            {{ trans('app.taxrate_tax_will_be_applied_to_your_purchase', ["taxrate" => $tax_configuration->percentage]) }}
        </p>
        <hr>
        @endif
        <div class="form-body">
            <label>{{ trans('app.airtime_amount') }} </label>
            <div class="form-group">
                <div class="input-group">
                    <input type="number" min="1" step="0.01" name="total_amount"
                           class="form-control">
                    <div class="input-group-addon">{{ Session::get('profile_settings')->profile_billing->default_currency }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
        <button type="submit" id="process" class="btn btn-primary">{{ trans('app.process') }}</button>
    </div>
</form>
<script type="text/javascript">
    var button = document.getElementById('process')
    button.addEventListener('click', hideshow, true);

    function hideshow() {
        document.getElementById('process').style.display = 'block';
        this.style.display = 'none';
    }
</script>