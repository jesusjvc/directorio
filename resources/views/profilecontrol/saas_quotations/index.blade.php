@extends(Session::get('guard') . '.layouts.app') @section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.subscription_billing') }}: {{ trans('app.quotations') }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
        @include('profilecontrol.saas_quotations.ajaxpaginate.records')
@endsection @push('head')
@endpush
@push('javascript')
@endpush