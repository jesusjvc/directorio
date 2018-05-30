@extends(Session::get('guard') . '.layouts.app') @section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.branches') }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    @include(Session::get('guard') . '.branches.ajax.index')
@endsection @push('head') @endpush
@push('javascript')
@endpush