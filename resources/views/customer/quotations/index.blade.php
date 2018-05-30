@extends(Session::get('guard') . '.layouts.app')

@section('pagetitle')
    {{ trans('app.quotations') }} : : {{ $profile->business_name }}
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ $profile->business_name }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
        @include('customer.quotations.ajaxpaginate.records')
@endsection @push('head')
@endpush
@push('javascript')
@endpush