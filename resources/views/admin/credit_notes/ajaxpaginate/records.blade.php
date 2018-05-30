<section class="records">
    <div class="reload" id="ajaxpaginateblock">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.credit_notes') }}
                        @php
                            $createlink = url(Session::get('guard') . '/credit_notes/create/');
                        if(($class == 'CustomersController') && ($customer != null)):
                            $createlink = url(Session::get('guard') . '/credit_notes/create/c' . $customer->id);
                        endif;
                        if(($class == 'ProfilesController') && ($profile != null)):
                            $createlink = url(Session::get('guard') . '/credit_notes/create/p' . $profile->id);
                        endif;
                        @endphp
                        <div class="pull-right">
                            <a href="{{ $createlink }}">
                        <span class="btn btn-xs btn-success">
                            {{ trans('app.issue_a_credit_note') }}
                        </span>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(count($credit_notes) > 0)
                            @if($class == 'Credit_notesController')
                                <form method="GET" id="q" action="{{ url(Session::get('guard') . '/credit_notes/search') }}">
                                    <div class="row">
                                        <div class="col-md-3 col-md-offset-8 col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="q" autocomplete="off" class="form-control"
                                                       placeholder="{{ trans('app.search') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-cm-6">
                                            <div class="form-group">
                                            <span class="input-group-btn">
						                        <button class="btn btn-sm btn-default"
                                                        type="submit">{{ trans('app.search') }}</button>
					                        </span>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                @if(last(explode('/',url()->current())) == 'search')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <p>
                                                    {{ $credit_notes->total() }} {{ trans_choice('app.result_foundresults_found',count($credit_notes)) }}
                                                    <mark>{{ Request::input('q') }}</mark>
                                                </p>
                                                <p>
                                                    <a href="{{ url(Session::get('guard') . '/invoices') }}"
                                                       class="fetchajaxpage">{{ trans('app.reset_search') }}</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endif
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-left oneline">
                                        #
                                    </th>
                                    <th class="text-left oneline">
                                        {{ trans('app.status') }}
                                    </th>
                                    @if($class == 'Credit_notesController')
                                        <th class="text-center oneline">
                                            {{ trans('app.customer_type') }}
                                        </th>
                                        <th>
                                            {{ trans('app.customer') }}
                                        </th>
                                    @endif
                                    <th class="text-left oneline">
                                        {{ trans('app.date') }}
                                    </th>
                                    <th class="text-left oneline">
                                        {{ trans('app.description') }}
                                    </th>
                                    <th class="text-center oneline">
                                        {{ trans('app.tax') }}
                                    </th>
                                    <th class="text-right oneline">
                                        {{ trans('app.total_homecurrency',["homecurrency" => Auth::user()->profile->profile_billing->default_currency]) }}
                                        <small>{{ trans('app.incl') }}</small>
                                    </th>
                                    <th class="text-center">

                                    </th>
                                </tr>
                                </thead>
                                @if(count($credit_notes) > 0)
                                    <tbody>
                                    @foreach ($credit_notes as $credit_note)
                                        @if($credit_note->profile_customer != null)
                                            <tr>
                                                <td class="oneline">
                                                    @if($credit_note->status == 0)
                                                        <a href="{{ url(Session::get('guard') . '/credit_notes/' . $credit_note->id . '/build') }}">
                                <span class="btn btn-outline btn-primary btn-xs">
                                #{{ $profile->profile_billing->credit_note_number_prefix }}{{ $credit_note->credit_note_no }}
                                </span>
                                                        </a>
                                                    @else
                                                        <a href="{{ url(Session::get('guard') . '/credit_notes/' . $credit_note->id . '/preview') }}"
                                                           target="_blank" title="{{ trans('app.print_or_view') }}"
                                                           class="tableicon">
                                                        <span class="btn btn-default btn-xs">
                                                            #{{ $profile->profile_billing->credit_note_number_prefix }}{{ $credit_note->credit_note_no }}
                                                        </span>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="text-left oneline">
                                                    @if($credit_note->status == 0)
                                                        <span class="yellowbg"
                                                              style="background-color:#ffff83;"><i
                                                                    class="fa fa-unlock"></i> {{ $credit_note->textStatus }}</span>
                                                    @else
                                                        <i class="fa fa-lock"></i> {{ $credit_note->textStatus }}
                                                    @endif
                                                </td>
                                                @if($class == 'Credit_notesController')
                                                    <td class="text-center">
                                <span class="label label-primary">
                                    {{ trans('app.profile') }}
                                </span>
                                                    </td>
                                                    <td class="oneline">
                                                        <a href="{{ url(Session::get('guard') . '/profiles/' . $credit_note->profile_customer->id) }}">
                                <span class="btn btn-outline btn-info btn-xs">
                                {{ $credit_note->profile_customer->business_name }}
                                </span>
                                                        </a>
                                                    </td>
                                                @endif
                                                <td class="text-left oneline">
                                                    {{ $credit_note->credit_note_date }}
                                                </td>
                                                <td class="text-left oneline">
                                                    {{ str_limit($credit_note->description, 30) }}
                                                </td>
                                                <td class="text-center oneline">
                                                    {{ $credit_note->tax_configuration->percentage }}%
                                                </td>
                                                <td class="text-right oneline">
                                                    {{ number_format($credit_note->total_amount,2) }}
                                                </td>
                                                <td class="text-right oneline">
                                                    <a href="{{ url(Session::get('guard') . '/credit_notes/' . $credit_note->id . '/preview') }}"
                                                       target="_blank" title="{{ trans('app.print_or_view') }}"
                                                       class="tableicon">
                                                        <i class="fa fa-print"></i>
                                                    </a>
                                                    <a href="{{ url(Session::get('guard') . '/credit_notes/' . $credit_note->id . '/download') }}"
                                                       target="_blank" title="{{ trans('app.download') }}"
                                                       class="tableicon">
                                                        <i class="fa fa-cloud-download"></i>
                                                    </a>
                                                    <a class="postconfirm hand tableicon"
                                                       data-title="{{ trans('app.email_credit_note') }}"
                                                       title="{{ trans('app.email_credit_note') }}"
                                                       data-description="{{  trans('app.do_you_want_to_email_credit_note_credit_note_no_to_whereto',["credit_note_no" => $profile->profile_billing->credit_note_number_prefix.$credit_note->credit_note_no,"whereto" => $credit_note->profile_customer->business_name]) }}"
                                                       data-reloaddiv="reload"
                                                       @if($class == 'ProfilesController')
                                                       data-reloadurl="{{ url(Session::get('guard') . '/' . $credit_note->profile_customer->id . '/credit_notes') }}"
                                                       @else
                                                       data-reloadurl="{{ url(Session::get('guard') . '/credit_notes') }}"
                                                       @endif
                                                       data-posturl="{{ url(Session::get('guard') . '/credit_notes/' . $credit_note->id . '/email') }}">
                                                        <i class="fa fa-envelope"></i>
                                                    </a>
                                                    {{--<a href="{{ url(Session::get('guard') . '/credit_notes/' . $credit_note->id . '/email_history') }}"--}}
                                                       {{--target="_blank"--}}
                                                       {{--title="{{ trans('app.email_history') }}"--}}
                                                       {{--class="tableicon">--}}
                                                        {{--<i class="fa fa-history"></i>--}}
                                                    {{--</a>--}}
                                                </td>
                                            </tr>
                                        @elseif($credit_note->customer != null)
                                            @php
                                                $customernames = ucwords($credit_note->customer->prefix . ' ' . $credit_note->customer->firstname . ' ' . $credit_note->customer->lastname)
                                            @endphp
                                            <tr>
                                                <td class="oneline">
                                                    @if($credit_note->status == 0)
                                                        <a href="{{ url(Session::get('guard') . '/credit_notes/' . $credit_note->id . '/build') }}">
                                <span class="btn btn-outline btn-primary btn-xs">
                                #{{ $profile->profile_billing->credit_note_number_prefix }}{{ $credit_note->credit_note_no }}
                                </span>
                                                        </a>
                                                    @else
                                                        <a href="{{ url(Session::get('guard') . '/credit_notes/' . $credit_note->id . '/preview') }}"
                                                           target="_blank" title="{{ trans('app.print_or_view') }}"
                                                           class="tableicon">
                                                        <span class="btn btn-default btn-xs">
                                                            #{{ $profile->profile_billing->credit_note_number_prefix }}{{ $credit_note->credit_note_no }}
                                                        </span>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="text-left oneline">
                                                    @if($credit_note->status == 0)
                                                        <span class="yellowbg"
                                                              style="background-color:#ffff83;"><i
                                                                    class="fa fa-unlock"></i> {{ $credit_note->textStatus }}</span>
                                                    @else
                                                        <i class="fa fa-lock"></i> {{ $credit_note->textStatus }}
                                                    @endif
                                                </td>
                                                @if($class == 'Credit_notesController')
                                                    <td class="text-center oneline">
                                <span class="label label-primary">
                                    {{ trans('app.customer') }}
                                </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url(Session::get('guard') . '/customers/' . $credit_note->customer->id) }}">
                                <span class="btn btn-outline btn-info btn-xs">
                                {{ $customernames }}
                                </span>
                                                        </a>
                                                    </td>
                                                @endif
                                                <td class="text-left oneline">
                                                    {{ $credit_note->credit_note_date }}
                                                </td>
                                                <td class="text-left oneline">
                                                    {{ str_limit($credit_note->description, 30) }}
                                                </td>
                                                <td class="text-center oneline">
                                                    {{ $credit_note->tax_configuration->percentage }}%
                                                </td>
                                                <td class="text-right oneline">
                                                    {{ number_format($credit_note->total_amount,2) }}
                                                </td>
                                                <td class="text-right oneline">
                                                    <a href="{{ url(Session::get('guard') . '/credit_notes/' . $credit_note->id . '/preview') }}"
                                                       target="_blank" title="{{ trans('app.print_or_view') }}"
                                                       class="tableicon">
                                                        <i class="fa fa-print"></i>
                                                    </a>
                                                    <a href="{{ url(Session::get('guard') . '/credit_notes/' . $credit_note->id . '/download') }}"
                                                       target="_blank" title="{{ trans('app.download') }}"
                                                       class="tableicon">
                                                        <i class="fa fa-cloud-download"></i>
                                                    </a>
                                                    <a class="postconfirm hand tableicon"
                                                       data-title="{{ trans('app.email_credit_note') }}"
                                                       title="{{ trans('app.email_credit_note') }}"
                                                       data-description="{{  trans('app.do_you_want_to_email_credit_note_credit_note_no_to_whereto',["credit_note_no" => $profile->profile_billing->credit_note_number_prefix.$credit_note->credit_note_no,"whereto" => $customernames]) }}"
                                                       data-reloaddiv="reload"
                                                       @if($class == 'CustomersController')
                                                       data-reloadurl="{{ url(Session::get('guard') . '/customers/' . $credit_note->customer->id . '/credit_notes') }}"
                                                       @else
                                                       data-reloadurl="{{ url(Session::get('guard') . '/credit_notes') }}"
                                                       @endif
                                                       data-posturl="{{ url(Session::get('guard') . '/credit_notes/' . $credit_note->id . '/email') }}">
                                                        <i class="fa fa-envelope"></i>
                                                    </a>
                                                    {{--<a href="{{ url(Session::get('guard') . '/credit_notes/' . $credit_note->id . '/email_history') }}"--}}
                                                       {{--target="_blank"--}}
                                                       {{--title="{{ trans('app.email_history') }}"--}}
                                                       {{--class="tableicon">--}}
                                                        {{--<i class="fa fa-history"></i>--}}
                                                    {{--</a>--}}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>
                        <div class="panel-footer">
                            <div class="text-center">
                                @if((count($credit_notes) == 0) && (last(explode('/',url()->current())) != 'search'))
                                    {{ trans('app.no_data_found') }}
                                @endif
                                @if((last(explode('/',url()->current())) == 'search') && (count($credit_notes) > 0))
                                    <a href="{{ url(Session::get('guard') . '/credit_notes') }}"
                                       class="fetchajaxpage">{{ trans('app.reset_search') }}</a>
                                @elseif((last(explode('/',url()->current())) == 'search') && (count($credit_notes) == 0))
                                    <a href="{{ url(Session::get('guard') . '/credit_notes') }}"
                                       class="fetchajaxpage">{{ trans('app.no_results_found_reset_search') }}</a>
                                @endif
                            </div>
                            @if(method_exists($credit_notes,'links'))
                                <div align="center">
                                    @if($credit_notes->links())
                                        <div align="center">
                                            @if(Request::get('q'))
                                                {{ $credit_notes->appends(['q' => Request::get('q')])->links() }}
                                            @else
                                                {{ $credit_notes->links() }}
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>