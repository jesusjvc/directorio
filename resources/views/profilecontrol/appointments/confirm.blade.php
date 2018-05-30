@extends(Session::get('guard') . '.layouts.app') @section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.appointments_of_agendaname', ["agendaname" => ucwords(trans('app.' . $agenda->user->prefix) . ' ' . $agenda->user->firstname . ' ' . $agenda->user->lastname)]) }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <form role="form" method="POST" action="{{ url('profilecontrol/appointments/schedule/' . $reference) }}">
        {{ csrf_field() }}
        <input type="hidden" name="customer_id" value="{{ $customer->id }}">
        <input type="hidden" name="branch_id" value="{{ $branch->id }}">
        <input type="hidden" name="agenda_sharecode" value="{{ $agenda->sharecode }}">
        <input type="hidden" name="timeslot" value="{{ $timeslot }}">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if($reschedule == null)
                            {{ trans('app.schedule_an_appointment_at_publicname_for_date', ["publicname"  =>  ucwords(trans('app.' . $agenda->user->prefix) . ' ' . $agenda->user->firstname . ' ' . $agenda->user->lastname), "date"  =>  CustomHelper::dateTimeShort(date('Y-m-d H:i:s', $timeslot))]) }}
                        @else
                            {{ trans('app.reschedule_appointment_reference_at_publicname_to_date', ["reference"  =>  $reschedule->reference, "publicname"  =>  ucwords(trans('app.' . $agenda->user->prefix) . ' ' . $agenda->user->firstname . ' ' . $agenda->user->lastname), "date"  =>  CustomHelper::dateTimeShort(date('Y-m-d H:i:s', $timeslot))]) }}
                        @endif
                        <div class="pull-right">
                            <a href="{{ url('profilecontrol/appointments/' . $agenda->sharecode) }}">
                            <span class="btn btn-xs btn-primary">
                            {{ trans('app.cancel_and_go_back') }}
                            </span>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <input type="hidden" name="slot" value="{{ Request::get('slot') }}">

                        <h4>
                            {{ trans('app.customer_information') }}
                        </h4>

                        <address>
                            <strong>{{ ucwords(trans('app.' . $customer->prefix) . ' ' . $customer->firstname . ' ' . $customer->lastname) }}</strong>
                            <br>
                            {{ trans('app.email_address') }}: {{ $customer->email }}
                            <br>
                            {{ trans('app.mobile_number') }}: +{{ $customer->mobile_no }}
                        </address>

                        <hr>

                        <h4>
                            {{ trans('app.appointment_information') }}
                        </h4>

                        <address>
                            {!! trans('app.appointment_to_be_booked_for_date_with_a_duration_of_duration', ["date"   =>  "<strong>" . CustomHelper::dateTimeLong(date('Y-m-d H:i',explode(',',Request::get('slot'))[0])) . "</strong>", "duration"   =>  "<strong>" . CustomHelper::durationTime(explode(',',Request::get('slot'))[1]) . "</strong>"]) !!}
                            @ <strong>{{ $branch->branch_name }}</strong>
                        </address>

                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>
                                    {{ trans('app.immediate_text_notifications') }}
                                    <br>
                                    <small>
                                        {{ trans('app.these_will_be_added_to_the_initial_what_notification', ["what" => strtolower(trans('app.schedule'))]) }}
                                    </small>
                                </h4>
                            </div>
                            <div class="col-md-6">
                                <div class="pull-right">
                                    <div class="form-group form-inline">
                                        <div class="checkbox checkbox-default">
                                            <input id="notify_email" type="checkbox" name="notify_email" value="1"
                                                   checked>
                                            <label for="notify_email">
                                                {{ trans('app.send_as_email') }}
                                            </label>
                                        </div>
                                        @if (Session::get('app_settings')->disable_sms == 0)
                                            <div class="checkbox checkbox-default">
                                                <input id="notify_sms" type="checkbox" name="notify_sms" value="1"
                                                       checked>
                                                <label for="notify_sms">
                                                    {{ trans('app.send_as_sms') }}
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        @foreach($branch->appointment_text_notifications as $instance)
                            <div class="form-group">
                                <div class="checkbox checkbox-primary">
                                    <input id="at{{ $instance->id*12345 }}" type="checkbox"
                                           name="at[{{ $instance->id*12345 }}]" value="1">
                                    <label for="at{{ $instance->id*12345 }}">
                                        <small>{{ $instance->notification_message }}</small>
                                    </label>
                                </div>
                            </div>
                        @endforeach

                        @if (Session::get('app_settings')->disable_sms == 0)

                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <h4>
                                    {{ trans('app.immediate_call_notification_phrases') }}
                                    <br>
                                    <small>
                                        {{ trans('app.these_phrases_will_be_added_to_the_initial_what_text_to_speech_voice_call_notification', ["what" => strtolower(trans('app.schedule'))]) }}
                                    </small>
                                </h4>
                            </div>
                            <div class="col-md-6">
                                <div class="pull-right">
                                    <div class="form-group form-inline">
                                        <div class="checkbox checkbox-default">
                                            <input id="notify_call" type="checkbox" name="notify_call" value="1">
                                            <label for="notify_call">
                                                {{ trans('app.send_as_call') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @foreach($branch->appointment_call_notifications as $instance)
                            <div class="form-group">
                                <div class="checkbox checkbox-primary">
                                    <input id="ac{{ $instance->id*12345 }}" type="checkbox"
                                           name="ac[{{ $instance->id*12345 }}]" value="1">
                                    <label for="ac{{ $instance->id*12345 }}">
                                        <small>{{ $instance->notification_message }}</small>
                                    </label>
                                </div>
                            </div>
                        @endforeach

                        <hr>

                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <h4>
                                    {{ trans('app.post_dated_text_notifications') }}
                                </h4>
                            </div>
                            <div class="col-md-6">
                                <div class="pull-right">
                                    <div class="form-group form-inline">
                                        <div class="checkbox checkbox-default">
                                            <input id="pd_notify_email" type="checkbox" name="pd_notify_email" value="1"
                                                   checked>
                                            <label for="pd_notify_email">
                                                {{ trans('app.send_as_email') }}
                                            </label>
                                        </div>
                                        @if (Session::get('app_settings')->disable_sms == 0)
                                            <div class="checkbox checkbox-default">
                                                <input id="pd_notify_sms" type="checkbox" name="pd_notify_sms" value="1"
                                                       checked>
                                                <label for="pd_notify_sms">
                                                    {{ trans('app.send_as_sms') }}
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        @foreach($branch->scheduled_text_notifications as $instance)
                            @if($instance->days_before > 0)
                                {{ trans('app.days_plural_before_appointment', ["days" => $instance->days_before, "plural" => trans_choice('app.choice_day',$instance->days_before)]) }}
                            @else
                                {{ trans('app.on_the_day_of_the_appointment') }}
                            @endif
                            <div class="form-group">
                                <div class="checkbox checkbox-primary">
                                    <input id="st{{ $instance->id*12345 }}" type="checkbox"
                                           name="st[{{ $instance->id*12345 }}]" value="1"
                                           @if($instance->bydefault == 1) checked @endif>
                                    <label for="st{{ $instance->id*12345 }}">
                                        <small>{{ $instance->notification_message }}</small>
                                    </label>
                                </div>
                            </div>
                        @endforeach

                        <hr>

                        <h4>
                            {{ trans('app.post_dated_call_notifications') }}
                        </h4>

                        @foreach($branch->scheduled_call_notifications as $instance)
                            @if($instance->days_before > 0)
                                {{ trans('app.days_plural_before_appointment', ["days" => $instance->days_before, "plural" => trans_choice('app.choice_day',$instance->days_before)]) }}
                            @else
                                {{ trans('app.on_the_day_of_the_appointment') }}
                            @endif
                            <div class="form-group">
                                <div class="checkbox checkbox-primary">
                                    <input id="sc{{ $instance->id*12345 }}" type="checkbox"
                                           name="sc[{{ $instance->id*12345 }}]" value="1"
                                           @if($instance->bydefault == 1) checked @endif>
                                    <label for="sc{{ $instance->id*12345 }}">
                                        <small>{{ $instance->notification_message }}</small>
                                    </label>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="panel-footer text-right">
                        @if ($reschedule != null)
                            <button class="btn btn-primary"
                                    typ="submit">{{ trans('app.reschedule_appointment') }}</button>
                        @else
                            <button class="btn btn-primary"
                                    type="submit">{{ trans('app.schedule_appointment') }}</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('head')
@endpush
@push('javascript')
@endpush