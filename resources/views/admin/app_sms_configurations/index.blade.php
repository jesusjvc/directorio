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
                    {{ trans('app.sms_voice_gateway_provider_configuration') }}
                    <div class="pull-right sectionbuttons">
                        <span class="btn btn-xs btn-primary" data-toggle="modal" data-target="#ajaxmodel"
                                data-remote="{{ url(Session::get('guard') . '/sms_provider_configurations/create') }}">
                            {{ trans('app.create_a_new_configuration') }}
                        </span>
                    </div>
                </div>
                @include(Session::get('guard') . '.app_sms_configurations.ajax.index')
            </div>
        </div>
    </div>
@endsection @push('head') @endpush @push('javascript') @endpush