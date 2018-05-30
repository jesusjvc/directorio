<section class="records">
    <div class="reload">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.reschedule_appointment_reference', ["reference" => $reschedule->reference]) }}
                        <br>
                        <small>
                            {{ trans('app.select_a_new_timeslot') }}
                        </small>
                        <div class="pull-right">
                            <a href="{{ url('profilecontrol/appointments/' . $agenda->sharecode) }}">
                            <span class="btn btn-xs btn-primary">
                            {{ trans('app.cancel_and_go_back') }}
                            </span>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        @php
                            $i = 0;
                        @endphp
                        @foreach($calendar as $entry)
                            @if((!isset($calendar[$i-1])) || ((isset($calendar[$i-1])) && ((date('Y-m-d', strtotime($calendar[$i-1]->from))) != (date('Y-m-d', strtotime($calendar[$i]->from))))))
                                @if($i > 0) <br> @endif
                                <h5>
                                    {{ strtoupper(CustomHelper::dateLong($entry->from)) }}
                                </h5>
                                <hr>
                            @endif
                            <div class="row slot">
                                @if($entry->status == 1)
                                    <div class="dropdown col-md-12 slot-status slot-{{ $entry->appointment_status }}">
                                        {{ trans('app.occupied') }}
                                    </div>
                                @else
                                    <div class="dropdown col-md-12 slot-status slot-vacant">
                                        {{ date('H:i', strtotime($entry->from)) }} &bullet;
                                        <div class="pull-right">
                                            <a href="{{ url('profilecontrol/appointments/' . $agenda->id . '/branch/' . strtotime($entry->from) . '/customer/' . $reschedule->customer_id . '/' . $reschedule->reference) }}"
                                               class="btn btn-xs btn-info uppercase fetchajaxpage">{{ trans('app.select') }}
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>