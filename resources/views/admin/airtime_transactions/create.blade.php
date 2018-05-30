<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">
        {{ trans('app.buy_airtime') }}
        <br>
        <small>
            {{ trans('app.on_behalf_of_profile', ["profile"    =>  $profile->business_name]) }}. <i>{{ trans('app.account_balance') }}: {{ number_format($profile->accountbalance,2) }} {{ Auth::guard(Session::get('guard'))->user()->profile->profile_billing->default_currency }}</i>
        </small>
    </h4>
</div>
<form role="form" method="POST" action="{{ url(Session::get('guard') . '/' . $profile->id . '/airtime/buy') }}" id="idForm"
      reloadurl="{{ url(Session::get('guard') . '/' . $profile->id . '/airtime') }}">
    <div class="modal-body">
        {{ csrf_field() }}
        <div class="form-body">
            <label>{{ trans('app.airtime_amount') }} </label>
            <div class="form-group">
            <div class="input-group">
                <input type="number" min="1" step="0.01" name="total_amount"
                       class="form-control">
                <div class="input-group-addon">{{ Session::get('profile_settings')->profile_billing->default_currency }}</div>
            </div>
            </div>
            <div class="form-group">
                <label>{{ trans('app.tax_configuration') }} </label>
                <select name="tax_configuration_id" class="form-control"
                        required>
                    <option value="">
                        {{ trans('app.select_a_selectwhat',["selectwhat" => trans('app.tax_configuration')]) }}
                    </option>
                    @foreach($tax_configurations as $tax_configuration)
                        <option value="{{ $tax_configuration->id }}">
                            {{ $tax_configuration->title }}
                            : {{ $tax_configuration->percentage }}%
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('app.process') }}</button>
    </div>
</form>