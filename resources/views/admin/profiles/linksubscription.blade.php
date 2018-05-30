<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title"
        id="myModalLabel">{{ trans('app.create_a_new_service_subscription') }}
        <br>
        <small> {{ $profile->business_name }} </small>
    </h4>
</div>
<form role="form" method="POST" action="{{ url(Session::get('guard') . '/profiles/' . $profile->id . '/linksubscription') }}" id="idForm"
      reloadurl="{{ url(Session::get('guard') . '/profiles/' . $profile->id . '/serviceoptions') }}" reloadiv="{{ Request::segment(5) }}">
    @if(count($subscriptionpackages) > 0)
        <div class="modal-body">
            {{ csrf_field() }}
            <p class="text-muted">{{ trans('app.important_a_new_subscription_instance_for_profilename_will_be_created_as_well_as_an_invoice_billed_as_per_the_selected_subscription_package_option', ["profilename"    =>  $profile->business_name]) }}</p>
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
                    <div class="col-md-12">
                        <label>{{ trans('app.tax_configuration') }} <span
                                    class="required"> * </span></label>
                        <div class="form-group">
                            <select name="tax_configuration_id" class="form-control select2"
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
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
            <button type="submit" class="btn btn-primary">{{ trans('app.link_subscription') }}</button>
        </div>
    @else
        <div class="modal-body">
            <p>{{ trans('app.yikes_your_system_has_no_subscription_packages') }}</p>
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