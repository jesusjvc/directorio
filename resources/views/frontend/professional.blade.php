@extends('frontend.layout.layout')
@section('pagetitle')
    {{ ucwords(trans('app.' . $professional->prefix) . ' ' . $professional->firstname . ' ' . $professional->lastname) }}
@endsection
@section('content')
    <div style="margin-top:30px;">
        @include('frontend.professional.provider')
    </div>
@endsection
@push('head')
@endpush
@push('javascript')
@if($map != null)
    {!! $map['js'] !!}
@endif
@endpush