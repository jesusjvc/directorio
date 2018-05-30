@extends(Session::get('guard') . '.layouts.app') @section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.public_portal') }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.child_categories') }}
                    <div class="pull-right">
                        <span class="btn btn-xs btn-success" data-toggle="modal" data-target="#ajaxmodel"
                                data-remote="{{ url(Session::get('guard') . '/child_categories/create') }}">
                            {{ trans('app.register_a_new_child_category') }}
                        </span>
                    </div>
                </div>
                @include(Session::get('guard') . '.child_categories.ajax.index')
            </div>
        </div>
    </div>
@endsection @push('head') @endpush @push('javascript') @endpush