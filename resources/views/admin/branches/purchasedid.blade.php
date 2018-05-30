<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.assign_an_inbound_number') }} @if(isset($profile))<br>
        <small> {{ $profile->business_name }} </small> @endif</h4>
</div>
<form role="form" method="POST" action="{{ url(Session::get('guard') . '/' . $profile->id . '/did_number/' . $branch->id) }}" id="idForm">
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
                            <label>{{ trans('app.select_a_category') }} <span class="required"> * </span></label>
                            <select class="form-control" name="app_sms_did_number_id" required>
                                <option value="">{{ trans('app.select_an_option') }}</option>
                                @foreach ($available_dids as $available_did)
                                    <optgroup
                                            label="{{ strtoupper($available_did->static_sms_provider->sms_gateway_provider) }}: {{ $available_did->country }}">
                                        <option value="{{ $available_did->id }}">+{{ $available_did->did_number }}
                                            , {{ trans('app.features') }}: {{ $available_did->features }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if($class != 'System_didController')
                        <div class="col-md-12">
                            <label>{{ trans('app.tax_configuration') }} <span
                                        class="required"> * </span></label>
                            <div class="form-group">
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
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
            <button type="submit" class="btn btn-primary">{{ trans('app.assign_did') }}</button>
        </div>
    @else
        <div class="modal-body">
            <p>{{ trans('app.no_available_did_numbers_could_be_found_please_purchase_inbound_numbers_from_your_gateway_providers_then_try_again') }}</p>
            <p>{{ trans('app.remember_that_you_should_preferably_assign_a_did_number_for_each_service_provider_configured_in_addition_to_this_please_take_note_of_the_number_capabilities_in_order_to_send_sms_texts_the_assigned_number_has_to_be_sms_enabled') }}</p>
        </div>
    @endif
</form>
<div class="loadjs">
    @if (Request::ajax())
        <script type="text/javascript">
            $(document).ready(function () {
                $(".select2").select2();
            });
        </script>
    @endif
</div>