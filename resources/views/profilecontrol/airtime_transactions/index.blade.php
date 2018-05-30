@extends(Session::get('guard') . '.layouts.app') @section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.subscription_billing') }}: {{ trans('app.airtime_transactions') }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    @include('profilecontrol.airtime_transactions.ajaxpaginate.records')
@endsection @push('head')
@endpush
@push('javascript')
@endpush