@extends(Session::get('guard') . '.layouts.app') @section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.administrator_user_management') }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.user_accounts') }}
                    <div class="pull-right">
                        <span class="btn btn-xs btn-success" data-toggle="modal" data-target="#ajaxmodel"
                              data-remote="{{ url(Session::get('guard') . '/users/create') }}">
                            {{ trans('app.register_a_new_user') }}
                        </span>
                    </div>
                </div>
                @include(Session::get('guard') . '.admin_users.ajax.index')
            </div>
        </div>
    </div>
@endsection @push('head') @endpush @push('javascript') @endpush