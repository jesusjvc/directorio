@extends(Session::get('guard') . '.layouts.app')

@section('pagetitle')
    {{ trans('app.contact_numbers') }}
@endsection

@section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.additional_contact_numbers') }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="reload">
        @include('customer.contact_numbers.ajax.index')
    </div>
@endsection @push('head')
@endpush
@push('javascript')
@endpush