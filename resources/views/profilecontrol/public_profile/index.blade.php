@extends(Session::get('guard') . '.layouts.app') @section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.public_presence') }}: {{ trans('app.' . Auth::guard(Session::get('guard'))->user()->prefix) . ' ' . Auth::guard(Session::get('guard'))->user()->firstname . ' ' . Auth::guard(Session::get('guard'))->user()->lastname }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.public_profile') }}
                </div>
                @include('profilecontrol.public_profile.ajax.index')
            </div>
        </div>
    </div>
@endsection @push('head') @endpush @push('javascript') @endpush