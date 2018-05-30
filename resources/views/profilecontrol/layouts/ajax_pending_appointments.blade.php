    <ul class="nav navbar-top-links pull-left">
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i
                            class="fa fa-calendar"></i>
                    <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
                </a>
                <ul class="dropdown-menu mailbox">
                    <li>
                        <div class="drop-title">{{ trans('app.pending_appointments') }}
                            <br>
                            <i><small>{!! trans_choice('app.you_have_count_pending_appointments',count($appointments)) !!}</small></i>
                        </div>
                    </li>
                    @foreach($appointments as $appointment)
                        <li>
                            <div class="message-center">
                                <a>
                                    <div class="mail-contnet">
                                    <span style="font-size:12px;display:block;margin:5px 0;color:#2b2b2b">
                                        {{ trans('app.customer') }} <strong>{{ trans('app.' . $appointment->customer->prefix) }} {{ $appointment->customer->firstname }} {{ $appointment->customer->lastname }}</strong>
                                        {!! trans('app.booked_for_date_at_provider_with_an_appointment_reference_of_reference', [
                                        "date" => "<strong>" . CustomHelper::dateTimeLong($appointment->date) . "</strong>",
                                        "provider" => "<strong>" . trans('app.' . $appointment->customer->prefix) . ' ' . $appointment->customer->firstname . ' ' . $appointment->customer->lastname . "</strong>",
                                        "reference" => "<strong>#" . $appointment->reference . "</strong>"
                                        ]) !!}
                                    </span>
                                    </div>
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <!-- /.dropdown-messages -->
            </li>
    </ul>