@extends('frontend.layout.layout')
@section('pagetitle')
    {{ CustomHelper::plaintext($page->title) }}
@endsection
@section('content')
    @if(Auth::guard('customer')->user() == null)
        <div style="padding:50px;"></div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div style="width: 80%; margin:0 10%;">
                <div class="white-box">
                    <h3 class="box-title">{{ CustomHelper::plaintext($page->title) }}</h3>
                    {!! $page->body !!}
                </div>
            </div>
        </div>
    </div>

@endsection @push('head') @endpush @push('javascript') @endpush