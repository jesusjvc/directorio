<section class="records">
    <div class="reload">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            {{ trans('app.viewing_appointments_of_agenda', ["agenda"  =>  ucwords(trans('app.' . $agenda->user->prefix) . ' ' . $agenda->user->firstname . ' ' . $agenda->user->lastname)]) }}
                        </div>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST"
                              action="{{ url(Session::get('guard') . '/appointments/daterange/' . $agenda->id) }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">{{ trans('app.show_calendar_from') }}</span>
                                        <select class="form-control" name="from">
                                            @foreach($timeArray as $instance)
                                            <option value="{{ $instance }}" @if($cookiejar[0] == $instance) selected @endif>{{ $instance }}</option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-addon">{{ strtolower(trans('app.to')) }}</span>
                                        <select class="form-control" name="to">
                                            @foreach($timeArray as $instance)
                                                @if($instance != '00:00')
                                                <option value="{{ $instance }}" @if($cookiejar[1] == $instance) selected @endif>{{ $instance }}</option>
                                                @endif
                                            @endforeach
                                            <option value="23:59" @if($cookiejar[1] == '23:59') selected @endif>24:00</option>
                                        </select>
                                    <span class="input-group-addon">{{ strtolower(trans('app.from_date')) }}</span>
                                        <input type="text" class="form-control datepicker-autoclose"
                                               placeholder="YYYY-MM-DD" name="date"
                                               value="{{ Session::get('dr')['date'] }}" readonly
                                               required>
                                        <span class="input-group-addon"><i class="icon-calender"></i></span>
                                        <input type="number" min="1" max="30" class="form-control"
                                               name="days"
                                               value="{{ $cookiejar[2] }}"
                                               required>
                                        <span class="input-group-addon"
                                              style="text-transform: lowercase;">{{ trans('app.days') }}</span>
                                        <span class="input-group-btn">
                                            <button type="submit"
                                                    class="btn waves-effect waves-light btn-info">{{ trans('app.go') }}</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="m-t-30">
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
                                        {{ date('H:i', strtotime($entry->from)) }} &bullet; {{ date('H:i', strtotime($entry->to)) }} &bullet;
                                        <code style="font-size: 105%;">{{ strtoupper($entry->branch->branch_name) }}</code>  &bullet;

                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                           aria-haspopup="true" aria-expanded="false">
                                            {{ ucwords(trans('app.' . $entry->customer->prefix) . ' ' . $entry->customer->firstname . ' ' . $entry->customer->lastname) }}
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a role="menuitem" tabindex="-1" class="hand fetchajaxpage"
                                                   href="{{ url('profilecontrol/appointments/' . $agenda->id . '/reschedule/' . $entry->reference) }}">
                                                    {{ trans('app.reschedule_appointment') }}
                                                </a>
                                            </li>
                                            @if($entry->appointment_status != 'pending')
                                            <li>
                                                <a role="menuitem" tabindex="-1">
                                                <span class="hand" data-toggle="modal" data-target="#ajaxmodel"
                                                      data-remote="{{ url('profilecontrol/appointments/' . $agenda->id . '/change_status/' . $entry->appointment_id) }}">
                                                    {{ trans('app.change_appointment_status') }}
                                                </span>
                                                </a>
                                            </li>
                                            @endif
                                            <li>
                                                <a role="menuitem" tabindex="-1">
                                                <span class="hand" data-toggle="modal" data-target="#ajaxmodel"
                                                      data-remote="{{ url('profilecontrol/appointments/' . $agenda->id . '/appointment_information/' . $entry->appointment_id) }}">
                                                    {{ trans('app.appointment_information') }}
                                                </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a role="menuitem" tabindex="-1">
                                                <span class="hand" data-toggle="modal" data-target="#ajaxmodel"
                                                      data-remote="{{ url('profilecontrol/appointments/' . $agenda->id . '/notification_history/' . $entry->appointment_id) }}">
                                                    {{ trans('app.notification_history') }}
                                                </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a role="menuitem" tabindex="-1">
                                                <span class="hand" data-toggle="modal" data-target="#ajaxmodel"
                                                      data-remote="{{ url('profilecontrol/appointments/' . $agenda->id . '/past_appointments/' . $entry->customer->id) }}">
                                                    {{ trans('app.past_appointments') }}
                                                </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a role="menuitem" tabindex="-1">
                                                <span class="hand" data-toggle="modal" data-target="#ajaxmodel"
                                                      data-remote="{{ url('profilecontrol/appointments/' . $agenda->id . '/upcoming_appointments/' . $entry->customer->id) }}">
                                                    {{ trans('app.upcoming_appointments') }}
                                                </span>
                                                </a>
                                            </li>
                                            @if(($entry->appointment_status != 'pending') && ($entry->appointment_status != 'attended') && ($entry->appointment_status != 'billed'))
                                            <li>
                                                <a class="hand postconfirm" role="menuitem" tabindex="-1"
                                                   data-title="{{ trans('app.cancel_appointment') }}"
                                                   data-description="{{  trans('app.are_you_sure_you_want_to_cancel_the_appointment_for_customernames', ["customernames" => ucwords(trans('app.' . $entry->customer->prefix) . ' ' . $entry->customer->firstname . ' ' . $entry->customer->lastname)]) }}"
                                                   data-posturl="{{ url(Session::get('guard') . '/appointments/' . $entry->agenda->id . '/cancel/' . $entry->reference) }}"
                                                   data-reloadurl="{{ url(Session::get('guard') . '/appointments/' . $entry->agenda->sharecode) }}">
                                                    {{ trans('app.cancel_appointment') }}
                                                </a>
                                            </li>
                                                @endif
                                        </ul>
                                        @if($entry->customer->company != null)
                                            ({{ $entry->customer->company }})
                                        @endif
                                        <div class="pull-right bold">
                                            @if($entry->appointment_status == 'pending')
                                                <span class="btn btn-danger btn-xs postconfirm"
                                                      data-title="{{ trans('app.reject') }}"
                                                      data-description="{{ trans('app.are_you_sure_you_want_to_reject_this_appointment_scheduled_for_customernames', ["customernames" => ucwords(trans('app.' . $entry->customer->prefix) . ' ' . $entry->customer->firstname . ' ' . $entry->customer->lastname)]) }}"
                                                      data-posturl="{{ url(Session::get('guard') . '/appointments/' . $entry->agenda->id . '/reject/' . $entry->reference) }}"
                                                      data-reloadurl="{{ url(Session::get('guard') . '/appointments/' . $entry->agenda->sharecode) }}">
                                                    {{ trans('app.reject') }}
                                                </span>
                                                <span class="btn btn-success btn-xs postconfirm"
                                                      data-title="{{ trans('app.accept') }}"
                                                      data-description="{{ trans('app.are_you_sure_you_want_to_accept_this_appointment_scheduled_for_customernames', ["customernames" => ucwords(trans('app.' . $entry->customer->prefix) . ' ' . $entry->customer->firstname . ' ' . $entry->customer->lastname)]) }}"
                                                      data-posturl="{{ url(Session::get('guard') . '/appointments/' . $entry->agenda->id . '/accept/' . $entry->reference) }}"
                                                      data-reloadurl="{{ url(Session::get('guard') . '/appointments/' . $entry->agenda->sharecode) }}">
                                                    {{ trans('app.accept') }}
                                                </span>
                                            @else
                                            {{ ucwords(trans('app.' . $entry->appointment_status)) }}
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="dropdown col-md-12 slot-status slot-vacant">
                                        {{ date('H:i', strtotime($entry->from)) }} &bullet;
                                        {{--{{ date('H:i', strtotime($entry->from)) }} &bullet; {{ date('H:i', strtotime($entry->to)) }}--}}
                                        <div class="pull-right">
                                            {{--                                        @if($entry->from >= date('Y-m-d H:i'))--}}
                                            {{--else if works great but wont work with different timezones unless user selects timezone everytime--}}
                                            <a href="{{ url('profilecontrol/appointments/' . $agenda->id . '/schedule/' . strtotime($entry->from)) }}"
                                               class="btn btn-xs btn-info uppercase fetchajaxpage">{{ trans('app.schedule') }}
                                            </a>
                                            {{--@endif--}}
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
    </div>
</section>