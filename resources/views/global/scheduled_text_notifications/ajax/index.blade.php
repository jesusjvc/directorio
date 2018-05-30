<div class="reload">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.scheduled_text_notifications') }}: {{ $branch->branch_name }}
                    <div class="pull-right">
                        <a href="{{ url(Session::get('guard') . '/scheduled_text_notifications/' . $branch->id . '/create') }}" class="fetchajaxpage">
                            <span class="btn btn-xs btn-success">
                            {{ trans('app.create_a_new_text_notification') }}
                            </span>
                        </a>
                        <a @if(Session::get('guard') == 'profilecontrol') href="{{ url(Session::get('guard') . '/branches/' . $branch->id) }}" @else href="{{ url(Session::get('guard') . '/' . $profile->id . '/branches/' . $branch->id) }}" @endif class="fetchajaxpage">
                            <span class="btn btn-xs btn-primary">
                            {{ trans('app.go_back') }}
                            </span>
                        </a>
                    </div>
                </div>
                @php
                    $scheduled_text_notifications = $branch->scheduled_text_notifications;
                @endphp
                <div class="panel-body">

                    <p class="text-muted m-b-15 font-13 text-left">
                        {!! trans('app.note_scheduled_notifications_can_be_individually_selected_at_the_time_of_scheduling_an_appointment_for_front_end_appointments_notification_messages_marked_as_what_will_be_sent_when_an_appointment_is_made', ["what"    =>  strtoupper(trans('app.by_default'))]) !!}
                    </p>

                    <hr>

                    @if(count($scheduled_text_notifications) > 0)

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="oneline">
                                    {{ ucwords(trans('app.by_default')) }}
                                </th>
                                <th class="text-center oneline">
                                    {{ trans('app.days_before') }}
                                </th>
                                <th class="oneline">
                                    {{ trans('app.notification') }}
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($scheduled_text_notifications as $notification)
                                <tr>
                                    <td class="text-left">
                                        @if($notification->bydefault == 1)
                                            {{ trans('app.yes') }}
                                        @else
                                            -
                                        @endif

                                    </td>
                                    <td class="text-center">
                                        {{ $notification->days_before }}
                                    </td>
                                    <td>
                                        {{ $notification->notification_message }}
                                    </td>

                                    <td>
                                        <a href="{{ url(Session::get('guard') . '/scheduled_text_notifications/' . $branch->id . '/edit/'. $notification->id) }}"
                                           class="fetchajaxpage">
                                                    <span class="hand btn btn-primary btn-xs">
                                                        {{ trans('app.edit') }}
                                                    </span>
                                        </a>
                                    </td>
                                    <td>
                                            <span class="hand btn btn-danger btn-xs postconfirm"
                                                  data-title="{{ trans('app.delete_notification_instance') }}"
                                                  data-description="{{ trans('app.are_you_sure_you_want_to_delete_this_notification_instance') }}"
                                                  data-reloadurl="{{ url(Session::get('guard') . '/scheduled_text_notifications/' . $branch->id) }}"
                                                  data-posturl="{{ url(Session::get('guard') . '/scheduled_text_notifications/' . $branch->id . '/delete/'. $notification->id) }}">
                                                            {{ trans('app.delete') }}
                                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <p align="center">
                            {{ trans('app.no_records_found') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>