<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li><a href="{{ url(Session::get('guard') . '/dashboard') }}"><span class="hide-menu">{{ trans('app.dashboard') }}</span></a>

            </li>
            <li><a href="javascript:void(0)"><i data-icon="F" class="linea-icon linea-software fa-fw"></i> <span
                            class="hide-menu">{{ trans('app.profile_management') }}<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ url(Session::get('guard') . '/profiles') }}">{{ trans('app.profile_accounts') }}</a></li>
                    <li><a href="{{ url(Session::get('guard') . '/profiles/create') }}">{{ trans('app.register_a_new_profile') }}</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0)"><i data-icon="F" class="linea-icon linea-software fa-fw"></i> <span
                            class="hide-menu">{{ trans('app.billing') }}<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ url(Session::get('guard') . '/quotations') }}">{{ trans('app.quotations') }}</a></li>
                    <li><a href="{{ url(Session::get('guard') . '/invoices') }}">{{ trans('app.invoices') }}</a></li>
                    <li><a href="{{ url(Session::get('guard') . '/credit_notes') }}">{{ trans('app.credit_notes') }}</a></li>
                    <li><a href="{{ url(Session::get('guard') . '/payments') }}">{{ trans('app.payments') }}</a></li>
                    <li><a href="{{ url(Session::get('guard') . '/subscriptions') }}">{{ trans('app.subscriptions') }}</a></li>
                </ul>
            </li>
            <li><a href="{{ url(Session::get('guard') . '/customers') }}">{{ trans('app.customers') }}</a></li>
            <li><a href="javascript:void(0)"><i data-icon="F" class="linea-icon linea-software fa-fw"></i> <span
                            class="hide-menu">{{ trans('app.contracts') }}<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ url(Session::get('guard') . '/contract_templates') }}">{{ trans('app.contract_builder') }}</a></li>
                    <li><a href="{{ url(Session::get('guard') . '/static_contracts') }}">{{ trans('app.static_contracts') }}</a></li>
                </ul>
            </li>
            <li><a href="{{ url(Session::get('guard') . '/media_manager') }}">{{ trans('app.media_manager') }}</a></li>
            <li><a href="{{ url(Session::get('guard') . '/cms') }}">{{ trans('app.cms_pages') }}</a></li>
            <li><a href="javascript:void(0)"><i data-icon="F" class="linea-icon linea-software fa-fw"></i> <span
                            class="hide-menu">{{ trans('app.configuration') }}<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="javascript:void(0)">{{ trans('app.system_settings') }} <span
                                    class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="{{ url(Session::get('guard') . '/app_settings') }}">{{ trans('app.application_settings') }}</a>
                            </li>
                            <li><a href="{{ url(Session::get('guard') . '/profile_settings') }}">{{ trans('app.profile_settings') }}</a></li>
                            @if(Session::get('app_settings')->disable_sms == 0)
                            <li><a href="{{ url(Session::get('guard') . '/system_did') }}">{{ trans('app.system_did') }}</a></li>
                                @endif
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">{{ trans('app.search_categories') }} <span
                                    class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="{{ url(Session::get('guard') . '/category_divisions') }}">{{ trans('app.category_divisions') }}</a>
                            </li>
                            <li><a href="{{ url(Session::get('guard') . '/child_categories') }}">{{ trans('app.child_categories') }}</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">{{ trans('app.chargeable_services') }} <span
                                    class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="{{ url(Session::get('guard') . '/service_categories') }}">{{ trans('app.service_categories') }}</a>
                            </li>
                            <li><a href="{{ url(Session::get('guard') . '/service_items') }}">{{ trans('app.service_items') }}</a></li>
                            <li>
                                <a href="{{ url(Session::get('guard') . '/service_packages') }}">{{ trans('app.subscription_plans') }}</a>
                            </li>
                        </ul>
                    </li>
                    @if(Session::get('app_settings')->disable_sms == 0)
                    <li><a href="javascript:void(0)">{{ trans('app.sms_voice_config') }} <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="{{ url(Session::get('guard') . '/sms_provider_configurations') }}">{{ trans('app.service_providers') }}</a>
                            </li>
                            <li>
                                <a href="{{ url(Session::get('guard') . '/sms_provider_charge_configuration') }}">{{ trans('app.billing_charges') }}</a>
                            </li>
                            <li><a href="{{ url(Session::get('guard') . '/sms_did_numbers') }}">{{ trans('app.did_numbers') }}</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    <li><a href="{{ url(Session::get('guard') . '/email_templates') }}">{{ trans('app.email_templates') }} </a></li>
                    <li><a href="{{ url(Session::get('guard') . '/tax_configurations') }}">{{ trans('app.tax_configuration') }} </a></li>
                    <li>
                        <a href="{{ url(Session::get('guard') . '/payment_gateways') }}">{{ trans('app.payments_configuration') }} </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">{{ trans('app.custom_fields') }} <span
                                    class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="{{ url('/admin/custom_invoice_fields') }}">{{ trans('app.custom_invoice_fields') }}</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="{{ url(Session::get('guard') . '/validate_email') }}">{{ trans('app.validate_email_connection') }} </a>
                    <li><a href="{{ url(Session::get('guard') . '/users') }}">{{ trans('app.user_management') }} </a>
                    </li>
                    <li><a href="{{ url(Session::get('guard') . '/system_notification_builder') }}">{{ trans('app.system_notification_builder') }} </a></li>
                    <li><a href="{{ url(Session::get('guard') . '/upgrade') }}">{{ trans('app.system_upgrade') }} </a></li>
                    <li><a href="{{ url(Session::get('guard') . '/cache_clear') }}">{{ trans('app.cache_clear') }} </a></li>
                </ul>
            </li>
            {{--<li><a href="javascript:void(0)"><i data-icon="F" class="linea-icon linea-software fa-fw"></i> <span--}}
                            {{--class="hide-menu">{{ trans('app.reports') }}<span class="fa arrow"></span></span></a>--}}
                {{--<ul class="nav nav-second-level">--}}
                {{--</ul>--}}
            {{--</li>--}}

        </ul>
    </div>
</div>