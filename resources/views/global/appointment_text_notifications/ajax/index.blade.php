<div class="reload">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.appointment_text_notifications') }}: {{ $branch->branch_name }}
                    <div class="pull-right">
                        <a href="{{ url(Session::get('guard') . '/appointment_text_notifications/' . $branch->id . '/create') }}" class="fetchajaxpage">
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
                    $appointment_text_notifications = $branch->appointment_text_notifications;
                @endphp
                <div class="panel-body">
                    <p class="text-muted m-b-15 font-13 text-left" style="font-size: 85%;">
                        {{ trans('app.these_are_the_notification_messages_sent_at_the_time_of_scheduling_an_appointment_with_each_appointment_the_user_can_individually_select_which_of_these_messages_should_send_with_the_notification') }}
                    </p>
                    @if(count($appointment_text_notifications) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>
                                        {{ trans('app.type') }}
                                    </th>
                                    <th>
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
                                @foreach($appointment_text_notifications as $notification)
                                    <tr>
                                        <td>
                                <span class="oneline" style="font-size: 85%;">
                                    @if($notification->schedule == 1)
                                        {{ trans('app.on_schedule') }}
                                    @elseif($notification->schedule_pending == 1)
                                        {{ trans('app.on_pending') }}
                                    @elseif($notification->reschedule == 1)
                                        {{ trans('app.on_re_schedule') }}
                                    @elseif($notification->cancel == 1)
                                        {{ trans('app.on_cancel') }}
                                    @elseif($notification->accept == 1)
                                        {{ trans('app.on_accept') }}
                                    @elseif($notification->reject == 1)
                                        {{ trans('app.on_reject') }}
                                    @else
                                        {{ trans('app.optional') }}
                                    @endif
                                </span>
                                        </td>
                                        <td>
                            <span style="font-size: 85%;">
                                {{ $notification->notification_message }}
                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ url(Session::get('guard') . '/appointment_text_notifications/' . $branch->id . '/edit/'. $notification->id) }}"
                                               class="fetchajaxpage">
                                                    <span class="hand btn btn-primary btn-xs">
                                                        {{ trans('app.edit') }}
                                                    </span>
                                            </a>
                                        </td>
                                        <td>
                                            @if(
                                            ($notification->schedule == 0) &&
                                            ($notification->schedule_pending == 0) &&
                                            ($notification->reschedule == 0) &&
                                            ($notification->accept == 0) &&
                                            ($notification->reject == 0) &&
                                            ($notification->cancel == 0)
                                            )
                                                <span class="hand btn btn-danger btn-xs postconfirm"
                                                      data-title="{{ trans('app.delete_notification_instance') }}"
                                                      data-description="{{ trans('app.are_you_sure_you_want_to_delete_this_notification_instance') }}"
                                                      data-reloadurl="{{ url(Session::get('guard') . '/appointment_text_notifications/' . $branch->id) }}"
                                                      data-posturl="{{ url(Session::get('guard') . '/appointment_text_notifications/' . $branch->id . '/delete/'. $notification->id) }}">
                                                            {{ trans('app.delete') }}
                                                        </span>
                                            @endif
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