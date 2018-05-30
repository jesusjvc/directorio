<div class="row">
    <div class="col-md-3 col-lg-3 col-xs-12">
        <div class="white-box">
            <h3 class="box-title">{{ trans('app.total_sales') }} {{ trans('app.in_currency', ["currency" => Auth::guard(Session::get('guard'))->user()->profile->profile_billing->default_currency]) }}</h3>
            <div id="totalsales"></div>
        </div>
    </div>
    <div class="col-md-3 col-lg-3 col-xs-12">
        <div class="white-box">
            <h3 class="box-title">{{ trans('app.total_quotations') }} {{ trans('app.in_currency', ["currency" => Auth::guard(Session::get('guard'))->user()->profile->profile_billing->default_currency]) }}</h3>
            <div id="totalquotations"></div>
        </div>
    </div>
    <div class="col-md-3 col-lg-3 col-xs-12">
        <div class="white-box">
            <h3 class="box-title">{{ trans('app.total_payments') }} {{ trans('app.in_currency', ["currency" => Auth::guard(Session::get('guard'))->user()->profile->profile_billing->default_currency]) }}</h3>
            <div id="total_payments"></div>
        </div>
    </div>
    <div class="col-md-3 col-lg-3 col-xs-12">
        <div class="white-box">
            <h3 class="box-title">{{ trans('app.total_credit_notes') }} {{ trans('app.in_currency', ["currency" => Auth::guard(Session::get('guard'))->user()->profile->profile_billing->default_currency]) }}</h3>
            <div id="total_credit_notes"></div>
        </div>
    </div>
</div>