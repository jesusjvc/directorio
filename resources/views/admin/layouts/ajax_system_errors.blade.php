<ul class="nav navbar-top-links pull-left">
    @if(is_array($system_errors))
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i
                        class="fa fa-warning"></i>
                <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
            </a>
            <ul class="dropdown-menu mailbox">
                <li>
                    <div class="drop-title">{{ count($system_errors) }} {{ trans_choice('app.choice_critical_notification',count($system_errors)) }}</div>
                </li>
                <li>
                    <div class="message-center">
                        @foreach($system_errors as $oneError)
                            <a>
                                <div class="mail-contnet">
                                    <span style="font-size:12px;display:block;margin:5px 0;color:#2b2b2b">{{ $oneError }}</span>
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