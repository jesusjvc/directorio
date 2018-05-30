@extends('frontend.layout.layout')
@section('pagetitle')
    {{ trans('app.page_not_found') }}
@endsection
@section('content')
    @if(Auth::guard('customer')->user() == null)
        <div style="padding:50px;"></div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div style="width: 80%; margin:0 10%;">
                <div class="white-box">
                    <h3 class="box-title">{{ trans('app.page_not_found') }}</h3>
                    <p>
                        {{ trans('app.yikes_the_page_you_are_looking_for_could_not_be_found') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection @push('head') @endpush @push('javascript') @endpush