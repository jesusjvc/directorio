<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.configure_a_new_payment_gateway') }} @if(isset($profile))<br><small> {{ $profile->business_name }} </small> @endif </h4>
</div>
@php
    if(isset($profile)):
    $modifylink = $profile->id . '/profile_';
    else:
    $modifylink = null;
    endif;
@endphp
<form role="form" method="POST" action="{{ url(Session::get('guard') . '/' . $modifylink . 'payment_gateways') }}" id="idForm">
    <div class="modal-body">
        {{ csrf_field() }}
        <div class="form-body">
            <div class="form-group">
                <label>{{ trans('app.payment_gateway') }} <span class="required"> * </span></label>
                <select class="form-control" name="static_payment_gateway_id" id="static_payment_gateway_id" required>
                    <option value="" populate="">{{ trans('app.select_an_option') }}</option>
                    @foreach ($static_gateways as $gateway)
                        <option value="{{ $gateway->id }}" populate="{{ $gateway->required_variables }}"
                                simtitle="{{ trans('app.' . preg_replace("/ /", '_', strtolower($gateway->gateway_name))) }}">{{ trans('app.' . preg_replace("/ /", '_', strtolower($gateway->gateway_name))) }}</option>
                    @endforeach
                </select>
            </div>
            <div style="display:none" id="additionalinfodiv" class="form-group">
                <div class="form-group">
                    <label>{{ trans('app.required_variables') }} </label>
                    <input type="text" id="additionalinfo" name="none" class="form-control" readonly>
                </div>
            </div>
            <div class="form-group">
                <label>{{ trans('app.gateway_title') }} <span
                            class="required"> * </span></label>
                <input type="text" maxlength="100" name="payment_method_name" id="payment_method_name"
                       class="form-control" required>
            </div>
            <div class="form-group">
                <label>{{ trans('app.variable_values') }} </label>
                <input type="text" id="variable_values" maxlength="1500" name="variable_values"
                       placeholder="{{ trans('app.leave_blank_for_offline_payments_such_as_bank_payment') }}"
                       class="form-control">
            </div>
            <div class="form-group">
                <label>{{ trans('app.payment_instructions') }}</label>
                <textarea class="form-control" rows="5" name="instructions"
                          placeholder="{{ trans('app.this_is_ideal_for_cases_where_you_need_to_provide_additional_payment_instructions_such_as_bank_account_details_for_bank_payments_leave_blank_if_you_do_not_want_to_provide_any_payment_instructions') }}"></textarea>
            </div>
            {{--<div class="form-group">--}}
                {{--<label>--}}
                    {{--<input name="include_instructions_in_notification" value="1"--}}
                           {{--type="checkbox"> {{ trans('app.include_payment_instructions_in_the_notification_emailsms') }}--}}
                {{--</label>--}}
            {{--</div>--}}
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('app.save') }}</button>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        $("#static_payment_gateway_id").on("change", function () {
            $("#additionalinfo").val($(this).find("option:selected").attr("populate"));
            $("#payment_method_name").val($(this).find("option:selected").attr("simtitle"));
            $("#additionalinfodiv").show();
        })
    });
</script>