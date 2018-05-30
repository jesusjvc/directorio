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
                    {{ trans('app.service_items') }}
                    <div class="pull-right">
                        <span class="btn btn-xs btn-warning" data-toggle="collapse" data-target="#collapse"
                                aria-expanded="false" aria-controls="collapse">
                            {{ trans('app.service_items_example') }}
                        </span>
                        <span class="btn btn-xs btn-success" data-toggle="modal" data-target="#ajaxmodel"
                                data-remote="{{ url(Session::get('guard') . '/service_items/create') }}">
                            {{ trans('app.register_a_new_service_item') }}
                        </span>
                    </div>
                </div>
                @include('global.service_items.ajax.index')
            </div>
        </div>
    </div>
@endsection @push('head') @endpush @push('javascript') @endpush