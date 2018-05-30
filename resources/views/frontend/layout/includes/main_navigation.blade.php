<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li><a href="javascript:void(0)"><span
                            class="hide-menu"><strong>{{ trans('app.providers_panel') }}</strong></span>

                </a>
            </li>
            <li><a href="javascript:void(0)"><span
                            class="hide-menu"></span>
                    <i class="fa fa-chevron-right"></i>
                </a>
            </li>
            @foreach(Auth::guard('customer')->user()->profile as $profile)
                <li>
                    <a href="javascript:void(0)"><i data-icon="F" class="linea-icon linea-software fa-fw"></i> <span
                                class="hide-menu">{{ $profile->business_name }}<span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ url('/customer/' . $profile->thumbprint . '/quotations') }}">{{ trans('app.quotations') }}</a>
                        </li>
                        <li>
                            <a href="{{ url('/customer/' . $profile->thumbprint . '/invoices') }}">{{ trans('app.invoices') }}</a>
                        </li>
                        <li>
                            <a href="{{ url('/customer/' . $profile->thumbprint . '/credit_notes') }}">{{ trans('app.credit_notes') }}</a>
                        </li>
                        <li>
                            <a href="{{ url('/customer/' . $profile->thumbprint . '/payments') }}">{{ trans('app.payments') }}</a>
                        </li>
                        <li>
                            <a href="{{ url('/customer/' . $profile->thumbprint . '/subscriptions') }}">{{ trans('app.subscriptions') }}</a>
                        </li>
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</div>