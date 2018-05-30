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
                    <h4>{{ trans('app.thank_you') }}</h4>
                    <p class="text-muted">
                        {!!
                         trans('app.your_appointment_reference_has_been_scheduled_for_datetime_at_provider_branch_customer_please_take_note_that_your_appointment_status_is_currently_pending_you_will_be_notified_once_your_appointment_has_been_approved',
                        [
                        "provider" => '<strong>' . ucwords(trans('app.' . $professional->prefix) . ' ' . $professional->firstname . ' ' . $professional->lastname) . '</strong>',
                        "datetime" => '<strong>' . CustomHelper::dateTimeLong($appointment->date) . '</strong>',
                        "reference" => '<strong>#' . $appointment->reference . '</strong>',
                        "branch" => '<strong>' . $appointment->branch->branch_name . '</strong>',
                        "customer" => '' . $appointment->customer->firstname . ''
                        ])
                         !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('head')
@endpush
@push('javascript')
@endpush