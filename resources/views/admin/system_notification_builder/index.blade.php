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
                    {{ trans('app.system_notification_builder') }}
                </div>
                @include(Session::get('guard') . '.system_notification_builder.ajax.index')
            </div>
        </div>
    </div>
@endsection @push('head') @endpush @push('javascript') @endpush