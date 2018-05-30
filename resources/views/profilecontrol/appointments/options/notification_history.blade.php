<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.notification_history') }}</h4>
</div>
<div class="modal-body">
    <div class="form-body">
        @if($appointment->sms_logs->count() > 0)
            <h4>
                {{ trans('app.sms_notifications') }}
            </h4>
            <ul class="linelist col-md-12">
                @foreach($appointment->sms_logs as $instance)
                    <li>
                        @if($instance->direction == 'inbound')
                            <span>{{ trans('app.inbound_sms') }} {{ trans('app.sent_on_date_from_from',["date" => date('Y-m-d', strtotime($instance->created_at)), "from" => "+" . $instance->from_number]) }}
                                :</span> {{ $instance->message }}
                        @else
                            <span>{{ trans('app.outbound_sms') }} {{ trans('app.sent_on_date_to_to',["date" => date('Y-m-d', strtotime($instance->created_at)), "to" => "+" . $instance->from_number]) }}
                                :</span> {{ $instance->message }}
                        @endif
                    </li>
                @endforeach
            </ul>
            <div class="clearfix"></div>
            <hr>
        @endif
        @if($appointment->email_logs->count() > 0)
            <h4>
                {{ trans('app.email_notifications') }}
            </h4>
            <ul class="linelist col-md-12">
                @foreach($appointment->email_logs as $instance)
                    <li>
                        <span>{{ $instance->email_subject }}:</span>
                        <br>
                        <small><i>{{ CustomHelper::dateLong($instance->created_at) }}</i></small>
                        <br>
                        <br>
                        {!! $instance->email_message !!}
                    </li>
                @endforeach
            </ul>
            <div class="clearfix"></div>
            <hr>
        @endif
        @if($appointment->call_logs->count() > 0)
            <h4>
                {{ trans('app.call_notifications') }}
            </h4>
            <ul class="linelist col-md-12">
                @foreach($appointment->call_logs as $instance)
                    <li>
                        @if($instance->direction == 'inbound')
                            <span>{{ trans('app.inbound_call') }} {{ trans('app.sent_on_date_from_from',["date" => date('Y-m-d', strtotime($instance->created_at)), "from" => "+" . $instance->from_number]) }}
                                :</span> {{ $instance->call_duration }} {{ trans('app.just_seconds') }}
                        @else
                            <span>{{ trans('app.outbound_call') }} {{ trans('app.sent_on_date_to_to',["date" => date('Y-m-d', strtotime($instance->created_at)), "to" => "+" . $instance->from_number]) }}
                                :</span> {{ $instance->call_duration }} {{ trans('app.just_seconds') }}
                        @endif
                    </li>
                @endforeach
            </ul>
            <div class="clearfix"></div>
            <hr>
        @endif
            @if(($appointment->call_logs->count() == 0) && ($appointment->email_logs->count() == 0) && ($appointment->sms_logs->count() == 0))
                <p class="text-muted text-left">
                    {{ trans('app.no_data_found') }}
                </p>
            @endif
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
</div>