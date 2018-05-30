<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header"><a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)"
                                  data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
        <div class="top-left-part"><a class="logo" href="{{ url(Session::get('guard') . '/dashboard') }}"><b>&nbsp;</b><span
                        class="hidden-xs"
                        style="white-space:nowrap;">{{ Session::get('profile_settings')->business_name }}</span></a>
        </div>
        <ul class="nav navbar-top-links navbar-left hidden-xs">
            <li><a href="javascript:void(0)" class="open-close hidden-xs"><i class="icon-arrow-left-circle ti-menu"></i></a>
            </li>
        </ul>
        <ul class="nav navbar-top-links navbar-right pull-right">
            <span class="ajax_unrouted_inbound_sms_messages"></span>
            @if (Session::get('app_settings')->disable_sms == 0)
            <span class="ajax_inbound_sms_messages"></span>
            @endif
            <span class="ajax_system_errors"></span>
            <span class="ajax_read_notifications"></span>
            <!-- /.dropdown -->
            <li class="dropdown"><a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img
                            src="{{ Session::get('avatar') }}" alt="avatar" width="36" class="img-circle"><b
                            class="hidden-xs">{{ ucwords(trans('app.' . Auth::user()->prefix)) }} {{ ucwords(Auth::user()->firstname) }} {{ ucwords(Auth::user()->lastname) }}</b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li>
                        <a href="{{ url(Session::get('guard') . '/myaccount') }}"><i class="fa fa-user"></i> {{ trans('app.my_account') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ url(Session::get('guard') . '/myavatar') }}"><i class="fa fa-image"></i> {{ trans('app.my_avatar') }}</a>
                    </li>
                    <li>
                        <a href="{{ url(Session::get('guard') . '/mypassword') }}"><i
                                    class="fa fa-lock"></i> {{ trans('app.my_password') }}</a>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <a href="{{ url('/logout') }}"><i class="fa fa-power-off"></i> {{ trans('app.logout') }}</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- .Megamenu -->
        <!-- /.Megamenu -->
            {{--<li class="right-side-toggle"><a class=" " href="javascript:void(0)"><i class="ti-settings"></i></a></li>--}}
            <!-- /.dropdown -->
        </ul>
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>