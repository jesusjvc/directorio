    <ul class="nav navbar-top-links pull-left">
        @if(count($notifications) > 0)
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i
                            class="fa fa-file-text-o"></i>
                    <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
                </a>
                <ul class="dropdown-menu mailbox">
                    <li>
                        <div class="drop-title">{{ count($notifications) }} {{ trans_choice('app.trans_notification',count($notifications)) }}
                            <br>
                            <i><small>{!! trans('app.click_on_what_to_mark_as_read',["what" => '<span class="fa fa-check-square"></span>']) !!}</small></i>
                        </div>
                    </li>
                    @foreach($notifications as $instance)
                        <li>
                            <div class="message-center">
                                <a href="{{ url(Session::get('guard') . '/ajaxdata/read_notifications/' . $instance->id. '/read') }}" class="fetchajaxpage" data-reloaddiv="ajax_read_notifications">
                                    <h5 style="color: #3696d8;"><span class="fa fa-check-square"></span> {{ $instance->subject }}</h5>
                                    <div class="mail-contnet">
                                    <span style="font-size:12px;display:block;margin:5px 0;color:#2b2b2b">
                                        {{ $instance->detail }}
                                    </span>
                                    </div>
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <!-- /.dropdown-messages -->
            </li>
        @endif
    </ul>