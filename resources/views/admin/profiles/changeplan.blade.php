<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title"
        id="myModalLabel">{{ trans('app.upgrade_downgrade_the_current_service_plan') }}
        <br>
        <small> {{ $profile->business_name }} </small>
    </h4>
</div>
<form role="form" method="POST" action="{{ url(Session::get('guard') . '/profiles/' . $profile->id . '/changeplan') }}" id="idForm"
      reloadurl="{{ url(Session::get('guard') . '/profiles/' . $profile->id . '/serviceoptions') }}" reloadiv="{{ Request::segment(5) }}">
    @if(count($subscriptionpackages) > 0)
        <div class="modal-body">
            {{ csrf_field() }}

            <p class="text-muted">
                {!! trans('app.profilename_is_currently_subscribed_to_packagename', ["profilename"  =>  $profile->business_name, "packagename"  =>  "<strong><i>". $profile->subscription_package->name . "</i></strong>"]) !!}
            </p>

            <p class="text-muted">{{ trans('app.important_once_you_change_the_service_plan_profilename_is_linked_to_the_features_related_to_the_new_plan_will_be_in_effect_immediately_the_billing_cycle_bill_date_as_well_as_the_tax_configuration_chosen_remains_the_same_the_monthly_rate_of_the_newly_selected_plan_will_take_affect_with_the_next_bill_date', ["profilename"    =>  $profile->business_name]) }}</p>
            <hr>
            <div class="form-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{ trans('app.select_a_service_option') }} <span class="required"> * </span></label>
                            <select class="form-control select2" id="subscription_package_id" name="subscription_package_id" required>
                                <option value="">{{ trans('app.select_an_option') }}</option>
                                @foreach ($subscriptionpackages as $option)
                                    <option value="{{ $option->id }}">{{ $option->name }} @ {{ number_format($option->monthly_charge_per_profile,2) }} {{ Session::get('profile_settings')->profile_billing->default_currency }} /{{ trans('app.month') }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
            <button type="submit" class="btn btn-primary">{{ trans('app.update_service_plan') }}</button>
        </div>
    @else
        <div class="modal-body">
            <p>{{ trans('app.besides_the_current_saas_service_plan_selected_there_are_no_other_plans_available_unable_to_proceed') }}</p>
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