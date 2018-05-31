<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <div class="top-left-part"><a class="logo" href="{{ url('/') }}"><b>&nbsp;</b>
          <img src="{{ url('images/logo.svg') }}" alt="Asociación de Health Coaches Unidos" width="200" height="82">
        </a>
        </div>
        {{--<ul class="nav navbar-top-links navbar-left hidden-xs">--}}
        {{--<li><a href="javascript:void(0)" class="open-close hidden-xs"><i class="icon-arrow-left-circle ti-menu"></i></a>--}}
        {{--</li>--}}
        {{--</ul>--}}
        <ul class="nav navbar-top-links navbar-right pull-right">
            @if(Auth::guard('customer')->user() == null)
                <li>
                    <a href="{{ url('/customer/login') }}"> {{ trans('app.login') }} </a>
                </li>
                <li>
                    <a href="{{ url('/register') }}"> {{ trans('app.register') }} </a>
                </li>
            @else
                <li class="dropdown"><a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <b
                                class="hidden-xs">{{ ucwords(Auth::guard('customer')->user()->prefix) }} {{ ucwords(Auth::guard('customer')->user()->firstname) }} {{ ucwords(Auth::guard('customer')->user()->lastname) }}</b>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="{{ url(Session::get('guard') . '/myaccount') }}"><i
                                        class="fa fa-user"></i> {{ trans('app.my_account') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ url(Session::get('guard') . '/mypassword') }}"><i
                                        class="fa fa-lock"></i> {{ trans('app.my_password') }}</a>
                        </li>
                        <li>
                            <a href="{{ url('/customer/address_management') }}"><i
                                        class="fa fa-home"></i> {{ trans('app.address_management') }}</a>
                        </li>
                        <li>
                            <a href="{{ url('/customer/customer_contact_numbers') }}"><i
                                        class="fa fa-phone-square"></i> {{ trans('app.contact_numbers') }}</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="{{ url('/logout') }}"><i class="fa fa-power-off"></i> {{ trans('app.logout') }}</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <li class="right-side-toggle"><a class="waves-effect waves-light" href="javascript:void(0)"><i
                                class="fa fa-dollar"></i></a></li>
            @endif
        </ul>
    </div>
</nav>
