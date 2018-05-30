@php
    $backurl = url(Session::get('guard') . '/profiles');
    if ((stripos(url()->previous(), '.js') === true ) || (stripos(url()->previous(), 'profiles') === true )):
        $backurl = url(Session::get('guard') . '/profiles');
    elseif (stripos(url()->previous(), 'credit_notes') == true):
        $backurl = url(Session::get('guard') . '/credit_notes');
    elseif (stripos(url()->previous(), 'invoices') == true):
        $backurl = url(Session::get('guard') . '/invoices');
    elseif (stripos(url()->previous(), 'quotations') == true):
        $backurl = url(Session::get('guard') . '/quotations');
    elseif (stripos(url()->previous(), 'payments') == true):
        $backurl = url(Session::get('guard') . '/payments');
    elseif (stripos(url()->previous(), 'receptions') == true):
        $backurl = url(Session::get('guard') . '/receptions');
    elseif (stripos(url()->previous(), 'subscriptions') == true):
        $backurl = url(Session::get('guard') . '/subscriptions');
        elseif (stripos(url()->previous(), 'professionals') == true):
        $backurl = url(Session::get('guard') . '/professionals');
        elseif (stripos(url()->previous(), 'branches') == true):
        $backurl = url(Session::get('guard') . '/branches');
        elseif (stripos(url()->previous(), 'agendas') == true):
        $backurl = url(Session::get('guard') . '/agendas');
        elseif (stripos(url()->previous(), 'agendas') == true):
        $backurl = url(Session::get('guard') . '/agendas');
    endif;
@endphp
<div class="panel panel-default">
    <div class="panel-heading">
        {{ $profile->business_name }}
        @if(($profile->expiry_date <= date('Y-m-d')) && ($profile->expiry_date != null))
            <span class="label label-danger">{{ trans('app.closed') }}</span>
        @endif
        <div class="pull-right hidden-xs">
            <a href="{{ $backurl }}">
                <span class="btn btn-xs btn-success hidden-xs">
                    {{ trans('app.go_back') }}
                </span>
            </a>
        </div>
        <div class="visible-xs spaceup">
            <a href="{{ $backurl }}">
                <span class="btn btn-xs btn-success hidden-xs">
                    {{ trans('app.go_back') }}
                </span>
            </a>
        </div>
    </div>

    <div class="hidden-xs">

        <div class="subnav">
            <a href="{{ url(Session::get('guard') . '/profiles/' . $profile->id) }}" class="fetchajaxpage">
                <div class="icon"><i class="fa fa-home"></i></div>
                <span class="subnavtitle">{{ trans('app.profile_overview') }}</span>
            </a>
        </div>

        <div class="subnavdivider"></div>

        <div class="subnav">
            <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/users') }}" class="fetchajaxpage">
                <div class="icon"><i class="fa fa-users"></i></div>
                <span class="subnavtitle">{{ trans('app.profile_users') }}</span>
            </a>
        </div>

        <div class="subnavdivider"></div>

        <div class="subnav">
            <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/professionals') }}" class="fetchajaxpage">
                <div class="icon"><i class="fa fa-briefcase"></i></div>
                <span class="subnavtitle">{{ trans('app.professionals') }}</span>
            </a>
        </div>

        <div class="subnavdivider"></div>

        <div class="subnav">
            <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/receptions') }}" class="fetchajaxpage">
                <div class="icon"><i class="fa fa-desktop"></i></div>
                <span class="subnavtitle">{{ trans('app.receptions') }}</span>
            </a>
        </div>

        @if (Session::get('app_settings')->disable_sms == 0)

        <div class="subnavdivider"></div>

        <div class="subnav">
            <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/profile_did_numbers') }}"
               class="fetchajaxpage">
                <div class="icon"><i class="fa fa-phone-square"></i></div>
                <span class="subnavtitle">{{ trans('app.did_numbers') }}</span>
            </a>
        </div>

        @endif

        <div class="subnavdivider"></div>

        <div class="subnav">
            <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/branches') }}" class="fetchajaxpage">
                <div class="icon"><i class="fa fa-location-arrow"></i></div>
                <span class="subnavtitle">{{ trans('app.branches') }}</span>
            </a>
        </div>

        <div class="subnavdivider"></div>

        <div class="subnav">
            <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/profile_tax_configurations') }}"
               class="fetchajaxpage">
                <div class="icon"><i class="fa fa-building-o"></i></div>
                <span class="subnavtitle">{{ trans('app.tax_config') }}</span>
            </a>
        </div>

        <div class="subnavdivider"></div>

        <div class="subnav">
            <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/profile_payment_gateways') }}"
               class="fetchajaxpage">
                <div class="icon"><i class="fa fa-credit-card-alt"></i></div>
                <span class="subnavtitle">{{ trans('app.payment_config') }}</span>
            </a>
        </div>

        <div class="subnavdivider"></div>

        <div class="subnav">
            <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/quotations') }}" class="fetchajaxpage">
                <div class="icon"><i class="icon-basket-loaded"></i></div>
                <span class="subnavtitle">{{ trans('app.quotations') }}</span>
            </a>
        </div>

        <div class="subnavdivider"></div>

        <div class="subnav">
            <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/invoices') }}" class="fetchajaxpage">
                <div class="icon"><i class="icon-calculator"></i></div>
                <span class="subnavtitle">{{ trans('app.invoices') }}</span>
            </a>
        </div>

        <div class="subnavdivider"></div>

        <div class="subnav">
            <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/credit_notes') }}" class="fetchajaxpage">
                <div class="icon"><i class="icon-wallet"></i></div>
                <span class="subnavtitle">{{ trans('app.credit_notes') }}</span>
            </a>
        </div>

        <div class="subnavdivider"></div>

        <div class="subnav">
            <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/payments') }}" class="fetchajaxpage">
                <div class="icon"><i class="icon-credit-card"></i></div>
                <span class="subnavtitle">{{ trans('app.payments') }}</span>
            </a>
        </div>

        <div class="subnavdivider"></div>

        <div class="subnav">
            <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/payment_transactions') }}"
               class="fetchajaxpage">
                <div class="icon"><i class="icon-layers"></i></div>
                <span class="subnavtitle">{{ trans('app.pmt_transactions') }}</span>
            </a>
        </div>

        <div class="subnavdivider"></div>

        <div class="subnav">
            <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/subscriptions') }}" class="fetchajaxpage">
                <div class="icon"><i class="fa fa-th-large"></i></div>
                <span class="subnavtitle">{{ trans('app.subscriptions') }}</span>
            </a>
        </div>

        @if (Session::get('app_settings')->disable_sms == 0)

        <div class="subnavdivider"></div>

        <div class="subnav">
            <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/airtime') }}" class="fetchajaxpage">
                <div class="icon"><i class="fa fa-mobile-phone"></i></div>
                <span class="subnavtitle">{{ trans('app.airtime') }}</span>
            </a>
        </div>

            @endif

    </div>

    <div class="visible-xs">

        <a href="{{ url(Session::get('guard') . '/profiles/' . $profile->id) }}" class="fetchajaxpage btn btn-sm btn-info spaceup">
            <span class="subnavtitle">{{ trans('app.profile_overview') }}</span>
        </a>

        <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/users') }}" class="fetchajaxpage btn btn-sm btn-info spaceup">
            <span class="subnavtitle">{{ trans('app.profile_users') }}</span>
        </a>

        <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/professionals') }}" class="fetchajaxpage btn btn-sm btn-info spaceup">
            <span class="subnavtitle">{{ trans('app.professionals') }}</span>
        </a>

        <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/receptions') }}" class="fetchajaxpage btn btn-sm btn-info spaceup">
            <span class="subnavtitle">{{ trans('app.receptions') }}</span>
        </a>

        <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/profile_did_numbers') }}"
           class="fetchajaxpage btn btn-sm btn-info spaceup">
            <span class="subnavtitle">{{ trans('app.did_numbers') }}</span>
        </a>

        <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/branches') }}" class="fetchajaxpage btn btn-sm btn-info spaceup">
            <span class="subnavtitle">{{ trans('app.branches') }}</span>
        </a>

        <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/profile_tax_configurations') }}"
           class="fetchajaxpage btn btn-sm btn-info spaceup">
            <span class="subnavtitle">{{ trans('app.tax_config') }}</span>
        </a>

        <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/profile_payment_gateways') }}"
           class="fetchajaxpage btn btn-sm btn-info spaceup">
            <span class="subnavtitle">{{ trans('app.payment_config') }}</span>
        </a>

        <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/quotations') }}" class="fetchajaxpage btn btn-sm btn-info spaceup">
            <span class="subnavtitle">{{ trans('app.quotations') }}</span>
        </a>

        <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/invoices') }}" class="fetchajaxpage btn btn-sm btn-info spaceup">
            <span class="subnavtitle">{{ trans('app.invoices') }}</span>
        </a>

        <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/credit_notes') }}" class="fetchajaxpage btn btn-sm btn-info spaceup">
            <span class="subnavtitle">{{ trans('app.credit_notes') }}</span>
        </a>

        <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/payments') }}" class="fetchajaxpage btn btn-sm btn-info spaceup">
            <span class="subnavtitle">{{ trans('app.payments') }}</span>
        </a>

        <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/payment_transactions') }}"
           class="fetchajaxpage btn btn-sm btn-info spaceup">
            <span class="subnavtitle">{{ trans('app.pmt_transactions') }}</span>
        </a>

        <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/subscriptions') }}" class="fetchajaxpage btn btn-sm btn-info spaceup">
            <span class="subnavtitle">{{ trans('app.subscriptions') }}</span>
        </a>

        <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/airtime') }}" class="fetchajaxpage btn btn-sm btn-info spaceup">
            <span class="subnavtitle">{{ trans('app.airtime') }}</span>
        </a>


    </div>

    <div class="clearfix"></div>
</div>