<div class="reload">
    <div class="panel panel-default">
        <div class="panel-heading">
            {{ trans('app.select_the_appointment_duration') }}
            <div class="pull-right">
                <a href="{{ url('profilecontrol/appointments/' . $agenda->sharecode) }}">
                            <span class="btn btn-xs btn-primary">
                            {{ trans('app.cancel_and_go_back') }}
                            </span>
                </a>
            </div>
            <br>
            @if($reschedule == null)
                <small>
                    {{ trans('app.schedule_an_appointment_at_publicname_for_date', ["publicname"  =>  ucwords(trans('app.' . $agenda->user->prefix) . ' ' . $agenda->user->firstname . ' ' . $agenda->user->lastname) . ' @ ' . $branch->branch_name, "date"  =>  CustomHelper::dateTimeShort(date('Y-m-d H:i:s', $timeslot))]) }}
                </small>
            @else
                <small>
                    {{ trans('app.reschedule_appointment_reference_at_publicname_to_date', ["reference"  =>  $reschedule, "publicname"  =>  ucwords(trans('app.' . $agenda->user->prefix) . ' ' . $agenda->user->firstname . ' ' . $agenda->user->lastname), "date"  =>  CustomHelper::dateTimeShort(date('Y-m-d H:i:s', $timeslot))]) }}
                </small>
            @endif
        </div>
        <form role="form" method="POST"
              action="{{ url('profilecontrol/appointments/confirm/' . $reschedule) }}">
            {{ csrf_field() }}
            <input type="hidden" value="{{ $agenda->sharecode }}" name="agenda_sharecode">
            <input type="hidden" value="{{ $customer->id }}" name="customer_id">
            <input type="hidden" value="{{ $branch->id }}" name="branch_id">
            <input type="hidden" value="{{ $timeslot }}" name="timeslot">
            <div class="panel-body">
                @if(count($timeslots) > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>
                                    {{ trans('app.time') }}
                                </th>
                                <th class="text-right">
                                    &nbsp;{{ trans('app.duration') }}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach($timeslots as $slot)
                                @if((!isset($timeslots[$i-1])) || ((isset($timeslots[$i-1])) && ((date('Y-m-d', strtotime($timeslots[$i-1]->from))) != (date('Y-m-d', strtotime($timeslots[$i]->from))))))
                                    <tr>
                                        <td colspan="5">
                                            <strong>
                                                {{ strtoupper(CustomHelper::dateLong($slot->from)) }}
                                            </strong>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td style="vertical-align: middle; display: table-cell;">
                                        {{ date('H:i', strtotime($timeslots[0]->from)) }}
                                        - {{ date('H:i', strtotime($slot->to)) }}
                                    </td>
                                    <td class="text-right">
                                        @if($slot->duration != null)
                                            <div class="radio radio-success">
                                                <input type="radio" name="slot" id="slot{{ $i }}"
                                                       value="{{ strtotime($timeslots[0]->from) . ',' . $slot->duration }}"
                                                       @if($i == 0) checked @endif
                                                       required>
                                                <label for="slot{{ $i }}">
                                                    {{--                                                        {{ CustomHelper::durationTime($slot->duration) }}--}}
                                                    {{ $slot->duration }} {{ trans('app.minutes') }}
                                                </label>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>{{ trans('app.no_data_found') }}</p>
                @endif
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-info" type="submit">
                    {{ trans('app.next') }}
                </button>
            </div>
        </form>
    </div>
</div>