@extends('frontend.layout.layout')
@section('pagetitle')
    home
@endsection
@section('mainsearch')
    @include('frontend.index.mainsearch')
@endsection
@section('content')
    @include('frontend.index.top_rated_providers')
@endsection