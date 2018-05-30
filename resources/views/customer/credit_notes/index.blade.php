@extends(Session::get('guard') . '.layouts.app')

@section('pagetitle')
    {{ trans('app.credit_notes') }} : : {{ $profile->business_name }}
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ $profile->business_name }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
        @include('customer.credit_notes.ajaxpaginate.records')
@endsection @push('head')
@endpush
@push('javascript')
@endpush