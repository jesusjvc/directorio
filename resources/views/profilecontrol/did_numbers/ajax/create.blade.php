<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.buy_a_did_number') }} <br>
        <small> {{ $profile->business_name }} </small>
    </h4>
</div>
@if($profile->accountbalance <= 0)
    <div class="modal-body">
        <p class="text-muted">
            {{ trans('app.you_have_insufficient_credit_to_buy_anything_please_top_up_your_account_balance_then_try_again') }}
        </p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
    </div>
@else
<form role="form" method="POST" action="{{ url(Session::get('guard') . '/did_numbers') }}" id="idForm">
    @if(count($available_dids) > 0)
        <div class="modal-body">
            {{ csrf_field() }}
            <p class="text-muted">{{ trans('app.remember_to_take_note_of_the_number_capabilities_in_order_to_send_sms_texts_the_assigned_number_has_to_be_sms_enabled_in_order_to_make_andor_receive_voice_calls_please_ensure_that_the_assigned_number_is_voice_enabled') }}</p>
            <p class="text-muted">{{ trans('app.take_note_that_an_automated_subscription_entry_as_well_as_an_invoice_will_be_created_once_the_did_has_been_assigned_to_the_profile_of_whosprofile',["whosprofile" => $profile->business_name]) }}</p>
            <hr>
            <div class="form-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{ trans('app.select_one_number_you_would_like_to_purchase') }} <span
                                        class="required"> * </span>
                                <small>
                                    @if(($tax_configuration != null) && ($tax_configuration->percentage > 0))
                                        <i>
                                            {{ trans('app.taxrate_tax_will_be_applied_to_your_purchase', ["taxrate" => $tax_configuration->percentage]) }}
                                        </i>
                                    @endif
                                </small>
                            </label>
                            <select class="form-control select2" name="app_sms_did_number_id" required>
                                <option value="">{{ trans('app.select_an_option') }}</option>
                                @foreach ($available_dids as $available_did)
                                    @if($profile->accountbalance >= $available_did->sell_per_month)
                                        <optgroup
                                                label="{{ $available_did->country }}: {{ number_format($available_did->sell_per_month,2) }} {{ Session::get('profile_settings')->profile_billing->default_currency }} {{ trans('app.per_month') }}">
                                            <option value="{{ $available_did->id }}">+{{ $available_did->did_number }}
                                                , {{ trans('app.features') }}: {{ $available_did->features }}</option>
                                        </optgroup>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
            <button type="submit" class="btn btn-primary">{{ trans('app.buy') }}</button>
        </div>
    @else
        <div class="modal-body">
            <p>{{ trans('app.unfortunately_no_did_numbers_are_available_to_purchase_however_the_system_has_just_notified_the_systems_administrator_about_the_situation_seconds_seconds_ago_please_try_again_soon', ["seconds" => "0." . mt_rand(10,99)]) }}</p>
        </div>
    @endif
</form>
@endif
<div class="loadjs">
    @if (Request::ajax())
        <script type="text/javascript">
            $(document).ready(function () {
                $(".select2").select2();
            });
        </script>
    @endif
</div>