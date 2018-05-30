@extends(Session::get('guard') . '.layouts.app') @section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.customers') }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div>
        @include('global.customers.navigation.subnav')
    </div>
    <div class="reload"> <!-- sub navigation -->
        @include('global.customers.show.default')
    </div>
@endsection @push('head') @endpush @push('javascript') @endpush