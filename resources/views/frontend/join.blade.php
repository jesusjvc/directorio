@extends('frontend.layout.layout')
@section('pagetitle')
    {{ trans('app.sign_up_as_a_professional_service_provider') }}
@endsection
@section('content')
    @if(Auth::guard('customer')->user() == null)
        <div style="padding:30px;"></div>
    @endif
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.sign_up_as_a_professional_service_provider') }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <form method="POST" action="{{ url('/join') }}" enctype="multipart/form-data"
                      id="validation">
                    {{ csrf_field() }}
                    <div class="panel-body">
                    <h3 class="box-title">{{ trans('app.how_it_works') }}</h3>
                    <p class="text-muted">
                        {{ trans('descriptions.join_how_it_works') }}
                    </p>

                    <hr>

                    <div class="row">
                        @php $i = 1; @endphp
                        @foreach($subscription_options as $option)
                            <div class="col-md-12">
                                <label><input type="radio" name="subscription_package_id"
                                              value="{{ $option->id }}"
                                              @if(($plan != null) && ($plan->id == $option->id)) checked @endif>
                                    <span class="hand" data-container="body" title=""
                                          data-toggle="popover" data-placement="top"
                                          data-content="{{ $option->description }}"
                                          data-original-title="">{{ $option->name }} @ {{ number_format($option->monthly_charge_per_profile,2) }} {{ Session::get('profile_settings')->profile_billing->default_currency }}
                </span> </label>
                            </div>
                            @php $i++; @endphp
                        @endforeach
                    </div>

                    <hr>

                    <h4>
                        {{ trans('app.tax_rate') }}
                    </h4>

                    <label>{{ trans('app.select_your_country_from_the_list_below_if_your_country_is_not_in_the_list_below_select_the_zero_tax_option') }}
                        <span
                                class="required"> * </span></label>
                    <div class="form-group">
                        <select name="tax_configuration_id" class="form-control select2" style="width:100%;"
                                required>
                            <option value="">
                                {{ trans('app.select_a_selectwhat',["selectwhat" => trans('app.tax_configuration')]) }}
                            </option>
                            @foreach($tax_configurations as $tax_configuration)
                                <option value="{{ $tax_configuration->id }}"
                                        @if(old('tax_configuration_id') == $tax_configuration->id) selected @endif>
                                    {{ $tax_configuration->title }}
                                    : {{ $tax_configuration->percentage }}%
                                </option>
                            @endforeach
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>

                    <hr>

                    <h4>
                        {{ trans('app.business_information') }}
                    </h4>

                    @include('admin.profiles.create.profile')
                    <hr>

                    <h4>
                        {{ trans('app.business_address') }}
                    </h4>

                    @include('admin.profiles.create.profile_address')
                    <hr>

                    <h4>
                        {{ trans('app.shipping_and_billing_address') }}
                    </h4>

                    @include('admin.profiles.create.shipping_and_billing_address')
                    <hr>

                    <h4>
                        {{ trans('app.locale_settings') }}
                    </h4>

                    @include('admin.profiles.create.profile_settings')
                    <hr>

                    <h4>
                        {{ trans('app.profile_billing_settings') }}
                    </h4>

                    @include('admin.profiles.create.profile_billing_settings')
                    <hr>

                    <h4>
                        {{ trans('app.profile_logo') }}
                    </h4>

                    @include('admin.profiles.create.profile_logo')
                    <hr>

                    <h4>
                        {{ trans('app.primary_user_information') }}
                    </h4>

                    @include('admin.profiles.create.primary_user')

                    <div class="clearfix"></div>

                    </div>

                    <div class="panel-footer">
                        <div class="pull-right">
                            @php
                                $captchaarray = implode(' + ',$captcha);
                            @endphp
                            <div class="form-group">
                                <label>{{ trans('app.captcha', ["sum" => $captchaarray]) }} <span class="required"> * </span></label>
                                <input type="number" min="0" max="50" maxlength="100" name="captcha"
                                       class="form-control" style="width:100%" required>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-footer">
                        <div class="pull-right" id="accept">
                            <button type="submit" class="btn btn-primary">
                                {{ trans('app.register_as_a_professional') }}
                            </button>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        function FillBilling(f) {
            if (f.copyBillingAddress.checked == true) {
                f.shipping_address_1.value = f.billing_address_1.value;
                f.shipping_address_2.value = f.billing_address_2.value;
                f.shipping_city.value = f.billing_city.value;
                f.shipping_state.value = f.billing_state.value;
                f.shipping_country.value = f.billing_country.value;
                f.shipping_zip.value = f.billing_zip.value;
                $('#shipping_country').val(f.billing_country.value).trigger('change');
            }
        }
        function FillShipping(f) {
            if (f.copyBusinessAddress.checked == true) {
                f.billing_address_1.value = f.business_address_1.value;
                f.billing_address_2.value = f.business_address_2.value;
                f.billing_city.value = f.business_city.value;
                f.billing_state.value = f.business_state.value;
                f.billing_country.value = f.business_country.value;
                f.billing_zip.value = f.business_zip.value;
                $('#billing_country').val(f.business_country.value).trigger('change');
            }
        }
    </script>
    <script type="text/javascript">
//        var button = document.getElementById('accept')
//        button.addEventListener('click', hideshow, true);
//
//        function hideshow() {
//            document.getElementById('accept').style.display = 'block';
//            this.style.display = 'none';
//        }
    </script>
@endsection
@push('head')
<link rel="stylesheet" href="{{ url('assets') }}/plugins/dropify/dist/css/dropify.min.css">
@endpush
@push('javascript')
<script src="{{ url('assets') }}/plugins/dropify/dist/js/dropify.min.js"></script>
@push('head')
<link rel="stylesheet" href="{{ url('assets') }}/plugins/bower_components/dropify/dist/css/dropify.min.css">
<link href="{{ url('assets') }}/plugins/bower_components/summernote/dist/summernote.css" rel="stylesheet"/>
@endpush
@push('javascript')
@endpush