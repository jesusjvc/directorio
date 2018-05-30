@extends(Session::get('guard') . '.layouts.app') @section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.configuration') }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.system_profile_settings') }}
                </div>
                <div class="panel-group wiz-aco" id="accordion" role="tablist"
                     aria-multiselectable="true">
                    <form method="POST" action="{{ url(Session::get('guard') . '/profile_settings') }}" enctype="multipart/form-data" id="validation" class="validation">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <div class="panel panel-info">
                            <div class="panel-heading" role="tab" id="headingOne" style="background-color: #03a9f3;">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true"
                                       aria-controls="collapseOne">
                                        {{ trans('app.business_information') }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    @include(Session::get('guard') . '.profiles.edit.profile')
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-info">
                            <div class="panel-heading" role="tab" id="headingTwo" style="background-color: #03a9f3;">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                                       aria-expanded="false" aria-controls="collapseTwo">
                                        {{ trans('app.business_address') }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    @include(Session::get('guard') . '.profiles.edit.profile_address')
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-info">
                            <div class="panel-heading" role="tab" id="headingThree" style="background-color: #03a9f3;">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree"
                                       aria-expanded="false" aria-controls="collapseThree">
                                        {{ trans('app.profile_settings') }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    @include(Session::get('guard') . '.profiles.edit.profile_settings')
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-info">
                            <div class="panel-heading" role="tab" id="headingFour" style="background-color: #03a9f3;">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour"
                                       aria-expanded="false" aria-controls="collapseThree">
                                        {{ trans('app.profile_billing_settings') }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                <div class="panel-body">
                                    @include(Session::get('guard') . '.profiles.edit.profile_billing_settings')
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-info">
                            <div class="panel-heading" role="tab" id="headingFive" style="background-color: #03a9f3;">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive"
                                       aria-expanded="false" aria-controls="collapseThree">
                                        {{ trans('app.profile_logo') }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                                <div class="panel-body">
                                    @include(Session::get('guard') . '.profiles.edit.profile_logo')
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('head')
<link rel="stylesheet" href="{{ url('assets') }}/plugins/bower_components/dropify/dist/css/dropify.min.css">
@endpush
@push('javascript')
@include(Session::get('guard') . '.profiles.js')
@include('global.includes.editor')@endpush