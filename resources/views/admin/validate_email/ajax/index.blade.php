@php $sectiontoreload = mt_rand(10000,99999) @endphp
<div class="{{ $sectiontoreload }}">
    <form role="form" method="POST" action="{{ url(Session::get('guard') . '/validate_email') }}" id="idForm" data-toggle="validator"
          reloadiv="{{ $sectiontoreload }}" reloadurl="{{ url(Session::get('guard') . '/validate_email') }}">
        {{ csrf_field() }}
        <div class="panel-body">
            <p class="text-muted m-b-30 font-13"> {{ trans('app.if_you_want_to_ensure_that_your_email_settings_are_configured_correctly_then_enter_your_email_address_below_and_click_on_the_test_email_connection_button_to_attempt_to_send_a_test_email') }} </p>
            <div class="form-group">
                <label>{{ trans('app.email_address') }} <span class="required"> * </span></label>
                <div class="help-block with-errors"></div>
                <div class="input-group m-t-10">
                    <input type="email" name="email_address" maxlength="100" value="{{ Auth::user()->email }}"
                           class="form-control" required>
                    <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                </div>
            </div>
        </div>
        <div class="panel-footer text-right">
            <button class="btn btn-primary">{{ trans('app.test_email_connection') }}</button>
        </div>
    </form>
</div>