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
        elseif (stripos(url()->previous(), 'customers') == true):
        $backurl = url(Session::get('guard') . '/customers');
    elseif (stripos(url()->previous(), 'payments') == true):
        $backurl = url(Session::get('guard') . '/payments');
    elseif (stripos(url()->previous(), 'subscriptions') == true):
        $backurl = url(Session::get('guard') . '/subscriptions');
    endif;
@endphp
<div class="panel panel-default">
    <div class="panel-heading">
        {{ ucwords(trans('app.' . $customer->prefix) . ' ' . $customer->firstname . ' ' . $customer->lastname) }}
        <div class="pull-right">
            <a href="{{ $backurl }}">
                <span class="btn btn-xs btn-success">
                    {{ trans('app.go_back') }}
                </span>
            </a>
        </div>
    </div>

    <div class="subnav">
        <a href="{{ url(Session::get('guard') . '/customers/' . $customer->id) }}" class="fetchajaxpage">
            <div class="icon"><i class="icon-screen-desktop"></i></div>
            <span class="subnavtitle">{{ trans('app.customer_overview') }}</span>
        </a>
    </div>

    <div class="subnavdivider"></div>

    <div class="subnav">
        <a href="{{ url(Session::get('guard') . '/customers/' . $customer->id . '/quotations') }}" class="fetchajaxpage">
            <div class="icon"><i class="icon-basket-loaded"></i></div>
            <span class="subnavtitle">{{ trans('app.quotations') }}</span>
        </a>
    </div>

    <div class="subnavdivider"></div>

    <div class="subnav">
        <a href="{{ url(Session::get('guard') . '/customers/' . $customer->id . '/invoices') }}" class="fetchajaxpage">
            <div class="icon"><i class="icon-calculator"></i></div>
            <span class="subnavtitle">{{ trans('app.invoices') }}</span>
        </a>
    </div>

    <div class="subnavdivider"></div>

    <div class="subnav">
        <a href="{{ url(Session::get('guard') . '/customers/' . $customer->id . '/credit_notes') }}" class="fetchajaxpage">
            <div class="icon"><i class="icon-wallet"></i></div>
            <span class="subnavtitle">{{ trans('app.credit_notes') }}</span>
        </a>
    </div>

    <div class="subnavdivider"></div>

    <div class="subnav">
        <a href="{{ url(Session::get('guard') . '/customers/' . $customer->id . '/payments') }}" class="fetchajaxpage">
            <div class="icon"><i class="icon-credit-card"></i></div>
            <span class="subnavtitle">{{ trans('app.payments') }}</span>
        </a>
    </div>

    <div class="subnavdivider"></div>

    <div class="subnav">
        <a href="{{ url(Session::get('guard') . '/customers/' . $customer->id . '/payment_transactions') }}" class="fetchajaxpage">
            <div class="icon"><i class="icon-layers"></i></div>
            <span class="subnavtitle">{{ trans('app.pmt_transactions') }}</span>
        </a>
    </div>

    <div class="subnavdivider"></div>

    <div class="subnav">
        <a href="{{ url(Session::get('guard') . '/customers/' . $customer->id . '/subscriptions') }}" class="fetchajaxpage">
            <div class="icon"><i class="fa fa-th-large"></i></div>
            <span class="subnavtitle">{{ trans('app.subscriptions') }}</span>
        </a>
    </div>

    {{--<div class="subnavdivider"></div>--}}

    {{--<div class="subnav">--}}
        {{--<a href="{{ url(Session::get('guard') . '/customers/' . $customer->id . '/email_log') }}" class="fetchajaxpage">--}}
            {{--<div class="icon"><i class="icon-envelope-letter"></i></div>--}}
            {{--<span class="subnavtitle">{{ trans('app.email_log') }}</span>--}}
        {{--</a>--}}
    {{--</div>--}}

    {{--<div class="subnavdivider"></div>--}}

    {{--<div class="subnav">--}}
        {{--<a href="{{ url(Session::get('guard') . '/customers/' . $customer->id . '/sms_log') }}" class="fetchajaxpage">--}}
            {{--<div class="icon"><i class="icon-screen-smartphone"></i></div>--}}
            {{--<span class="subnavtitle">{{ trans('app.sms_log') }}</span>--}}
        {{--</a>--}}
    {{--</div>--}}

    {{--<div class="subnavdivider"></div>--}}

    {{--<div class="subnav">--}}
        {{--<a href="{{ url(Session::get('guard') . '/customers/' . $customer->id . '/call_log') }}" class="fetchajaxpage">--}}
            {{--<div class="icon"><i class="icon-call-out"></i></div>--}}
            {{--<span class="subnavtitle">{{ trans('app.call_log') }}</span>--}}
        {{--</a>--}}
    {{--</div>--}}

    {{--<div class="subnavdivider"></div>--}}

    {{--<div class="subnav">--}}
        {{--<a href="{{ url(Session::get('guard') . '/customers/' . $customer->id . '/system_log') }}" class="fetchajaxpage">--}}
            {{--<div class="icon"><i class="icon-note"></i></div>--}}
            {{--<span class="subnavtitle">{{ trans('app.system_log') }}</span>--}}
        {{--</a>--}}
    {{--</div>--}}

    <div class="clearfix"></div>
</div>