<ul class="nav navbar-top-links pull-left">
    @if($inbound_messages != null)
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i
                        class="fa fa-comments"></i>
                <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
            </a>
            <ul class="dropdown-menu mailbox">
                <li>
                    <div class="drop-title">
                        {{ count($inbound_messages) }} {{ trans_choice('app.choice_new_sms_message',count($inbound_messages)) }}
                        <br>
                        <i><small>{!! trans('app.click_on_what_to_mark_as_read',["what" => '<span class="fa fa-check-square"></span>']) !!}</small></i>
                    </div>
                </li>
                <li>
                    <div class="message-center">
                        @foreach($inbound_messages as $oneMessage)
                            <a href="{{ url(Session::get('guard') . '/ajaxdata/inbound_sms_messages/' . $oneMessage['id']. '/read') }}"
                               class="fetchajaxpage" data-reloaddiv="ajax_inbound_sms_messages">
                                <div class="mail-contnet">
                                    <h5>{{ trans('app.from') }} +{{ $oneMessage['from_number'] }}
                                        <small>{{ trans('app.via') }} {{ $oneMessage['gateway'] }}</small>
                                    </h5>
                                    <span style="font-size:12px;display:block;margin:5px 0;color:#2b2b2b"><span class="fa fa-check-square"></span> {{ $oneMessage['message'] }}</span>
                                    <span class="time">{{ trans('app.sent_to') }}
                                        +{{ $oneMessage['did_number'] }} {{ trans('app.on') }} {{ $oneMessage['date'] }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </li>
            </ul>
            <!-- /.dropdown-messages -->
        </li>
    @endif
</ul>