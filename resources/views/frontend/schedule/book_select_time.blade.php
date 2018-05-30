@extends('frontend.layout.layout')
@section('pagetitle')
    {{ ucwords(trans('app.' . $professional->prefix) . ' ' . $professional->firstname . ' ' . $professional->lastname) }}
@endsection
@section('content')
    <div style="margin-top:30px;">
        <div class="row">
            <div class="col-md-3 col-xs-12">
                @include('frontend.professional.sidepanel')
            </div>
            <div class="col-md-9 col-xs-12">
                <div class="white-box">
                    <h4>{{ trans('app.select_a_suitable_time') }}</h4>
                    <p class="text-muted">
                        {{ trans('app.you_are_about_to_schedule_an_appointment_at_provider_for_datelong', ["provider" => ucwords(trans('app.' . $professional->prefix) . ' ' . $professional->firstname . ' ' . $professional->lastname), "datelong" => CustomHelper::dateLong($date)]) }}
                    </p>
                    <hr>

                    <form role="form" method="POST"
                          action="{{ url('/' . str_slug($professional->firstname . ' ' . $professional->lastname) . '/' . $agenda->sharecode . '/confirm.html') }}">
                        {{ csrf_field() }}

                        @foreach($availableslots as $slot)

                            <div class="radio radio-info text-left">
                                <input type="radio"
                                       name="slot"
                                       id="{{ $slot }}"
                                       value="{{ $branch->id }}_{{ $agenda->sharecode }}_{{ $date }}_{{ $service_item->id }}_{{ $slot }}"
                                       required>
                                <label for="{{ $slot }}"> {{ date('H:i', $slot) }} </label>
                            </div>

                            <hr>

                        @endforeach

                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ url('/' . str_slug($professional->firstname . ' ' . $professional->lastname) . '/' . $agenda->sharecode . '.html') }}"
                                   class="btn btn-sm btn-danger dropdown-toggle waves-effect waves-light btn-block">
                                    {{ trans('app.cancel') }}
                                </a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit"
                                        class="btn btn-sm btn-primary dropdown-toggle waves-effect waves-light btn-block">
                                    {{ trans('app.proceed') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('head')
@endpush
@push('javascript')
@endpush