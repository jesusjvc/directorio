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
                    <h4>{{ trans('app.confirm_your_appointment') }}</h4>
                    <p class="text-muted">
                        {{ ucwords(Auth::guard('customer')->user()->prefix) }} {{ ucwords(Auth::guard('customer')->user()->firstname) }} {{ ucwords(Auth::guard('customer')->user()->lastname) }}
                        ,
                        {{ trans('app.you_are_about_to_schedule_an_appointment_at_provider_at_branch_for_datelong_at_time_your_service_selected_is_servicename_to_be_scheduled_at_a_rate_of_rate',
                        [
                        "provider" => ucwords(trans('app.' . $professional->prefix) . ' ' . $professional->firstname . ' ' . $professional->lastname),
                        "branch" => $branch->branch_name,
                        "datelong" => CustomHelper::dateLong($date),
                        "time" => date('H:i', $slot_selected),
                        "servicename" => $service_item->name,
                        "rate" => number_format($service_item->amount,2) . ' ' . $profile->profile_billing->default_currency
                        ]) }}
                    </p>

                    <hr>

                    <form role="form" method="POST"
                          action="{{ url('/' . str_slug($professional->firstname . ' ' . $professional->lastname) . '/' . $agenda->sharecode . '/process.html') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="confirm"
                               value="{{ $branch->id }}_{{ $agenda->sharecode }}_{{ $date }}_{{ $service_item->id }}_{{ $slot_selected }}">


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
                                    {{ trans('app.confirm') }}
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