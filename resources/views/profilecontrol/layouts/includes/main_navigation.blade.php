<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li><a href="{{ url('/profilecontrol/dashboard') }}"><span
                            class="hide-menu">{{ trans('app.dashboard') }}</span></a>

            </li>
            <li><a href="{{ url('/profilecontrol/customers') }}">{{ trans('app.customers') }}</a></li>
            @if((Auth::guard(Session::get('guard'))->user()->isuser == 1) || (Auth::guard(Session::get('guard'))->user()->isreception == 1))
                <li><a href="javascript:void(0)"><i data-icon="F" class="linea-icon linea-software fa-fw"></i> <span
                                class="hide-menu">{{ trans('app.billing') }}<span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ url('/profilecontrol/quotations') }}">{{ trans('app.quotations') }}</a></li>
                        <li><a href="{{ url('/profilecontrol/invoices') }}">{{ trans('app.invoices') }}</a></li>
                        <li><a href="{{ url('/profilecontrol/credit_notes') }}">{{ trans('app.credit_notes') }}</a></li>
                        <li><a href="{{ url('/profilecontrol/payments') }}">{{ trans('app.payments') }}</a></li>
                        <li><a href="{{ url('/profilecontrol/subscriptions') }}">{{ trans('app.subscriptions') }}</a></li>
                    </ul>
                </li>
                <li><a href="javascript:void(0)"><i data-icon="F" class="linea-icon linea-software fa-fw"></i> <span
                                class="hide-menu">{{ trans('app.contracts') }}<span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ url('/profilecontrol/contract_templates') }}">{{ trans('app.contract_builder') }}</a>
                        </li>
                        <li>
                            <a href="{{ url('/profilecontrol/static_contracts') }}">{{ trans('app.static_contracts') }}</a>
                        </li>
                    </ul>
                </li>
            @endif
            @if((Auth::guard(Session::get('guard'))->user()->isprofessional == 1) || (Auth::guard(Session::get('guard'))->user()->isreception == 1))
                <li>
                    <a href="javascript:void(0)"><i data-icon="F" class="linea-icon linea-software fa-fw"></i> <span
                                class="hide-menu">{{ trans('app.appointments') }}<span
                                    class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        @if(Auth::guard(Session::get('guard'))->user()->isprofessional == 1)
                            <li>
                                <a href="{{ url('/profilecontrol/appointments/' . Auth::guard(Session::get('guard'))->user()->agenda->sharecode) }}">{{ ucwords(trans('app.' . Auth::guard(Session::get('guard'))->user()->prefix) . ' ' . Auth::guard(Session::get('guard'))->user()->firstname . ' ' . Auth::guard(Session::get('guard'))->user()->lastname) }}</a>
                            </li>
                        @endif
                        @if(Auth::guard(Session::get('guard'))->user()->isreception == 1)
                            @foreach(Auth::guard(Session::get('guard'))->user()->profile->users as $professional)
                                @if(($professional->isprofessional == 1) && ($professional->id != Auth::guard(Session::get('guard'))->user()->id))
                                    <li>
                                        <a href="{{ url('/profilecontrol/appointments/' . $professional->agenda->sharecode) }}">{{ ucwords(trans('app.' . $professional->prefix) . ' ' . $professional->firstname . ' ' . $professional->lastname) }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </li>
            @endif
            @if(Auth::guard(Session::get('guard'))->user()->isuser == 1)
                <li>
                    <a href="javascript:void(0)"><i data-icon="F" class="linea-icon linea-software fa-fw"></i> <span
                                class="hide-menu">{{ trans('app.administration') }}<span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="javascript:void(0)">{{ trans('app.subscription_billing') }} <span
                                        class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="{{ url('/profilecontrol/subscription_billing/quotations') }}">{{ trans('app.quotations') }}</a>
                                </li>
                                <li>
                                    <a href="{{ url('/profilecontrol/subscription_billing/invoices') }}">{{ trans('app.invoices') }}</a>
                                </li>
                                <li>
                                    <a href="{{ url('/profilecontrol/subscription_billing/credit_notes') }}">{{ trans('app.credit_notes') }}</a>
                                </li>
                                <li>
                                    <a href="{{ url('/profilecontrol/subscription_billing/payments') }}">{{ trans('app.payments') }}</a>
                                </li>
                                <li>
                                    <a href="{{ url('/profilecontrol/subscription_billing/subscriptions') }}">{{ trans('app.subscriptions') }}</a>
                                </li>
                                <li>
                                    <a href="{{ url('/profilecontrol/airtime') }}">{{ trans('app.airtime_transactions') }}</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ url('/profilecontrol/profile_settings') }}">{{ trans('app.profile_settings') }}</a>
                        </li>
                        <li>
                            <a href="{{ url('/profilecontrol/tax_configurations') }}">{{ trans('app.tax_configuration') }} </a>
                        </li>
                        <li>
                            <a href="{{ url('/profilecontrol/payment_gateways') }}">{{ trans('app.payments_configuration') }} </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">{{ trans('app.chargeable_services') }} <span
                                        class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="{{ url('/profilecontrol/service_categories') }}">{{ trans('app.service_categories') }}</a>
                                </li>
                                <li>
                                    <a href="{{ url('/profilecontrol/service_items') }}">{{ trans('app.service_items') }}</a>
                                </li>
                            </ul>
                        </li>
                        @if (Session::get('app_settings')->disable_sms == 0)
                        <li>
                            <a href="{{ url('/profilecontrol/did_numbers') }}">{{ trans('app.did_numbers') }} </a>
                        </li>
                        @endif
                        <li>
                            <a href="{{ url('/profilecontrol/users') }}">{{ trans('app.user_management') }}</a>
                        </li>
                        <li>
                            <a href="{{ url('/profilecontrol/professionals') }}">{{ trans('app.professional_management') }}</a>
                        </li>
                        <li>
                            <a href="{{ url('/profilecontrol/receptions') }}">{{ trans('app.reception_management') }}</a>
                        </li>
                        <li>
                            <a href="{{ url('/profilecontrol/branches') }}">{{ trans('app.branch_management') }}</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">{{ trans('app.custom_fields') }} <span
                                        class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="{{ url('/profilecontrol/custom_invoice_fields') }}">{{ trans('app.custom_invoice_fields') }}</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>