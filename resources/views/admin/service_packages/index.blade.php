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
                    {{ trans('app.service_subscription_packages') }}
                    <div class="pull-right">
                        <span class="btn btn-xs btn-warning" data-toggle="collapse" data-target="#collapse"
                              aria-expanded="false" aria-controls="collapse">
                            {{ trans('app.service_package_explanation') }}
                        </span>
                        <span class="btn btn-xs btn-primary" data-toggle="modal" data-target="#ajaxmodel"
                                data-remote="{{ url(Session::get('guard') . '/service_packages/create') }}">
                            {{ trans('app.register_a_new_subscription_plan') }}
                        </span>
                    </div>
                </div>
                @include(Session::get('guard') . '.service_packages.ajaxpaginate.records')
            </div>
        </div>
    </div>
@endsection @push('head') @endpush @push('javascript') @endpush