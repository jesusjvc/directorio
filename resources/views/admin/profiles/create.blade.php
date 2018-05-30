@extends(Session::get('guard') . '.layouts.app') @section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.profile_management') }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.profile_accounts') }}
                </div>
                <div class="panel-group wiz-aco" id="accordion" role="tablist"
                     aria-multiselectable="true">
                    <form method="POST" action="{{ url(Session::get('guard') . '/profiles') }}" enctype="multipart/form-data"
                          id="validation">
                        {{ csrf_field() }}

                        <div class="panel panel-info">
                            <div class="panel-heading" role="tab" id="headingOne"
                                 style="background-color: #03a9f3;">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                       aria-expanded="true"
                                       aria-controls="collapseOne">
                                        {{ trans('app.business_information') }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                 aria-labelledby="headingOne">
                                <div class="panel-body">
                                    @include(Session::get('guard') . '.profiles.create.profile')
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-info">
                            <div class="panel-heading" role="tab" id="headingTwo" style="background-color: #03a9f3;">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseTwo"
                                       aria-expanded="false" aria-controls="collapseTwo">
                                        {{ trans('app.business_address') }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    @include(Session::get('guard') . '.profiles.create.profile_address')
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-info">
                            <div class="panel-heading" role="tab" id="headingTwo" style="background-color: #03a9f3;">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseFour"
                                       aria-expanded="false" aria-controls="collapseFour">
                                        {{ trans('app.shipping_and_billing_address') }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingFour">
                                <div class="panel-body">
                                    @include(Session::get('guard') . '.profiles.create.shipping_and_billing_address')
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-info">
                            <div class="panel-heading" role="tab" id="headingFive" style="background-color: #03a9f3;">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseFive"
                                       aria-expanded="false" aria-controls="collapseFive">
                                        {{ trans('app.locale_settings') }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingFive">
                                <div class="panel-body">
                                    @include(Session::get('guard') . '.profiles.create.profile_settings')
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-info">
                            <div class="panel-heading" role="tab" id="headingSix" style="background-color: #03a9f3;">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseSix"
                                       aria-expanded="false" aria-controls="collapseSix">
                                        {{ trans('app.profile_billing_settings') }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseSix" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingSix">
                                <div class="panel-body">
                                    @include(Session::get('guard') . '.profiles.create.profile_billing_settings')
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-info">
                            <div class="panel-heading" role="tab" id="headingSeven" style="background-color: #03a9f3;">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseSeven"
                                       aria-expanded="false" aria-controls="collapseSeven">
                                        {{ trans('app.profile_logo') }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingSeven">
                                <div class="panel-body">
                                    @include(Session::get('guard') . '.profiles.create.profile_logo')
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-info">
                            <div class="panel-heading" role="tab" id="headingEight" style="background-color: #03a9f3;">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEight"
                                       aria-expanded="false" aria-controls="collapseEight">
                                        {{ trans('app.primary_user_information') }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
                                <div class="panel-body">
                                    @include(Session::get('guard') . '.profiles.create.primary_user')
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-info">
                            <div class="panel-heading" role="tab" id="headingNine" style="background-color: #03a9f3;">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseNine"
                                       aria-expanded="false" aria-controls="collapseNine">
                                        {{ trans('app.subscription_plan') }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseNine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNine">
                                <div class="panel-body">
                                    @include(Session::get('guard') . '.profiles.create.subscription_plan')
                                </div>
                            </div>
                        </div>
                        @if (Session::get('app_settings')->disable_sms == 0)
                        <div class="panel panel-info">
                            <div class="panel-heading" role="tab" id="headingTen" style="background-color: #03a9f3;">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTen"
                                       aria-expanded="false" aria-controls="collapseTen">
                                        {{ trans('app.did_number_allocation') }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTen">
                                <div class="panel-body">
                                    @include(Session::get('guard') . '.profiles.create.did_number_allocation')
                                </div>
                            </div>
                        </div>
                            @endif
                    </form>
                </div>
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
@endsection
@push('head')
<link rel="stylesheet" href="{{ url('assets') }}/plugins/bower_components/dropify/dist/css/dropify.min.css">
<link href="{{ url('assets') }}/plugins/bower_components/summernote/dist/summernote.css" rel="stylesheet"/>
@endpush
@push('javascript')
@include(Session::get('guard') . '.profiles.js')
@endpush