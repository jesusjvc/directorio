<section class="records">
    <div class="reload" id="ajaxpaginateblock">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.quotations') }}
                        @php
                            $createlink = url(Session::get('guard') . '/quotations/create/');
                        if(($class == 'CustomersController') && ($customer != null)):
                            $createlink = url(Session::get('guard') . '/quotations/create/' . $customer->id);
                        endif;
                        if(($class == 'ProfilesController') && ($profile != null)):
                            $createlink = url(Session::get('guard') . '/quotations/create/p' . $profile->id);
                        endif;
                        @endphp
                        <div class="pull-right">
                            <a href="{{ $createlink }}">
                        <span class="btn btn-xs btn-success">
                            {{ trans('app.create_a_new_quotation') }}
                        </span>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(count($quotations) > 0)
                            @if($class == 'QuotationsController')
                                <form method="GET" id="q" action="{{ url(Session::get('guard') . '/quotations/search') }}">
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
                                                    {{ $quotations->total() }} {{ trans_choice('app.result_foundresults_found',count($quotations)) }}
                                                    <mark>{{ Request::input('q') }}</mark>
                                                </p>
                                                <p>
                                                    <a href="{{ url(Session::get('guard') . '/quotations') }}"
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
                                    @if($class == 'QuotationsController')
                                        <th class="text-center oneline">
                                            {{ trans('app.customer_type') }}
                                        </th>
                                        <th>
                                            {{ trans('app.customer') }}
                                        </th>
                                    @endif
                                    <th class="text-center oneline">
                                        {{ trans('app.items') }}
                                    </th>
                                    <th class="text-left oneline">
                                        {{ trans('app.date') }}
                                    </th>
                                    <th class="text-left oneline">
                                        {{ trans('app.expiry_date') }}
                                    </th>
                                    <th class="text-center oneline">
                                        {{ trans('app.currency') }}
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
                                @if(count($quotations) > 0)
                                    <tbody>
                                    @foreach ($quotations as $quotation)
                                        @if($quotation->profile_customer != null)
                                            <tr>
                                                <td class="oneline">
                                                    @if($quotation->status == 0)
                                                        <a href="{{ url(Session::get('guard') . '/quotations/' . $quotation->id . '/build') }}">
                                <span class="btn btn-outline btn-primary btn-xs">
                                #{{ $profile->profile_billing->quotation_number_prefix }}{{ $quotation->quotation_no }}
                                </span>
                                                        </a>
                                                    @else
                                                        <a class="btn btn-default btn-xs"
                                                           href="{{ url(Session::get('guard') . '/quotations/' . $quotation->id . '/preview') }}"
                                                           target="_blank" title="{{ trans('app.print_or_view') }}"
                                                           class="tableicon">
                                                            #{{ $profile->profile_billing->quotation_number_prefix }}{{ $quotation->quotation_no }}
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="text-left oneline">
                                                    @if($quotation->status == 1)
                                                        <a class="postconfirm hand tableicon" style="color: #a10000;"
                                                           data-title="{{ trans('app.cancel_signature_request') }}"
                                                           title="{{ trans('app.cancel_signature_request') }}"
                                                           data-description="{!! trans('app.are_you_sure_you_want_to_revoke_the_electronic_signature_request_for_quote_no',["quote_no" => $profile->profile_billing->quotation_number_prefix.$quotation->quotation_no]) !!}"
                                                           data-reloaddiv="reload"
                                                           @if($class == 'ProfilesController')
                                                           data-reloadurl="{{ url(Session::get('guard') . '/' . $quotation->profile_customer->id . '/quotations') }}"
                                                           @else
                                                           data-reloadurl="{{ url(Session::get('guard') . '/quotations') }}"
                                                           @endif
                                                           data-posturl="{{ url(Session::get('guard') . '/quotations/' . $quotation->id . '/revoke_signature_request') }}">
                                                            <i class="fa fa-times-circle"></i>
                                                        </a>
                                                    @endif
                                                    @if($quotation->status == 0)
                                                        <span class="yellowbg"
                                                              style="background-color:#ffff83;">{{ $quotation->text_status }}</span>
                                                    @else
                                                        {{ $quotation->text_status }}
                                                    @endif
                                                    @if(($quotation->status == 2) && ($quotation->electronic_signature_token->electronic_signature_archive != null))
                                                        <span class="showSwal hand"
                                                              data-title="{{ trans('app.signature_confirmation') }}"
                                                              data-description="{{ trans('app.this_documenttype_was_signed_by_signedbywho_on_datewhensigned',["documenttype" => strtolower(trans('app.quotation')), "signedbywho" => ucwords($quotation->electronic_signature_token->electronic_signature_archive->signed_by_names) . ' (' . $quotation->electronic_signature_token->electronic_signature_archive->ip_address . ')', "datewhensigned" => CustomHelper::dateLong($quotation->electronic_signature_token->electronic_signature_archive->created_at)]) }}"
                                                        ><i class="fa fa-pencil-square"></i></span>
                                                    @endif
                                                </td>
                                                @if($class == 'QuotationsController')
                                                    <td class="text-center oneline">
                                <span class="label label-primary">
                                    {{ trans('app.profile') }}
                                </span>
                                                    </td>
                                                    <td class="oneline">
                                                        <a href="{{ url(Session::get('guard') . '/profiles/' . $quotation->profile_customer->id) }}">
                                <span class="btn btn-outline btn-info btn-xs">
                                {{ $quotation->profile_customer->business_name }}
                                </span>
                                                        </a>
                                                    </td>
                                                @endif
                                                <td class="text-center oneline">
                                                    @if($quotation->quotation_items->count() == 0)
                                                        <span class="label label-danger">{{ $quotation->quotation_items->count() }}</span>
                                                    @else
                                                        <span class="label label-info">{{ $quotation->quotation_items->count() }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-left oneline">
                                                    {{ $quotation->quotation_date }}
                                                </td>
                                                <td class="text-left oneline">
                                                    {{ $quotation->expiry_date }}
                                                </td>
                                                <td class="text-center oneline">
                                                    {{ $quotation->currency }}
                                                </td>
                                                <td class="text-center oneline">
                                                    {{ $quotation->tax_configuration->percentage }}%
                                                </td>
                                                <td class="text-right oneline">
                                                    {{ number_format($quotation->total_amount,$donumberformat) }}
                                                </td>
                                                <td class="text-right oneline">
                                                    @if($quotation->quotation_items->count() > 0)
                                                        @if(($quotation->status == 0) || ($quotation->status == 2))
                                                            <a class="postconfirm hand tableicon"
                                                               title="{{ trans('app.create_an_invoice') }}"
                                                               data-title="{{ trans('app.create_an_invoice') }}"
                                                               data-description="{!! trans('app.are_you_sure_you_want_to_create_an_invoice_based_on_quotation_quoteno_for_you_being_more_in_control_the_auto_generated_invoice_will_not_be_automatically_emailed_to_the_customer',["quoteno" => "<strong>" . $quotation->profile->profile_billing->quotation_number_prefix . $quotation->quotation_no . "</strong>"]) !!}"
                                                               @if($class == 'ProfilesController')
                                                               data-reloadurl="{{ url(Session::get('guard') . '/' . $quotation->profile_customer->id . '/quotations') }}"
                                                               @else
                                                               data-reloadurl="{{ url(Session::get('guard') . '/quotations') }}"
                                                               @endif
                                                               data-posturl="{{ url(Session::get('guard') . '/quotations/' . $quotation->id . '/quotationtoinvoice') }}">
                                                                <i class="fa fa-credit-card-alt"></i>
                                                            </a>
                                                        @endif
                                                        <a href="{{ url(Session::get('guard') . '/quotations/' . $quotation->id . '/preview') }}"
                                                           target="_blank" title="{{ trans('app.print_or_view') }}"
                                                           class="tableicon">
                                                            <i class="fa fa-print"></i>
                                                        </a>
                                                        <a href="{{ url(Session::get('guard') . '/quotations/' . $quotation->id . '/download') }}"
                                                           target="_blank" title="{{ trans('app.download') }}"
                                                           class="tableicon">
                                                            <i class="fa fa-cloud-download"></i>
                                                        </a>
                                                        <a class="postconfirm hand tableicon"
                                                           data-title="{{ trans('app.email_quotation') }}"
                                                           title="{{ trans('app.email_quotation') }}"
                                                           data-description="{{  trans('app.do_you_want_to_email_quotation_quoteno_to_whereto',["quoteno" => $profile->profile_billing->quotation_number_prefix.$quotation->quotation_no,"whereto" => $quotation->profile_customer->business_name]) }}"
                                                           data-reloaddiv="reload"
                                                           @if($class == 'ProfilesController')
                                                           data-reloadurl="{{ url(Session::get('guard') . '/' . $quotation->profile_customer->id . '/quotations') }}"
                                                           @else
                                                           data-reloadurl="{{ url(Session::get('guard') . '/quotations') }}"
                                                           @endif
                                                           data-posturl="{{ url(Session::get('guard') . '/quotations/' . $quotation->id . '/email') }}">
                                                            <i class="fa fa-envelope"></i>
                                                        </a>
                                                        {{--<a href="{{ url(Session::get('guard') . '/quotations/' . $quotation->id . '/email_history') }}"--}}
                                                           {{--target="_blank"--}}
                                                           {{--title="{{ trans('app.email_history') }}"--}}
                                                           {{--class="tableicon">--}}
                                                            {{--<i class="fa fa-history"></i>--}}
                                                        {{--</a>--}}
                                                    @endif
                                                </td>
                                            </tr>
                                        @elseif($quotation->customer != null)
                                            @php
                                                $customernames = ucwords($quotation->customer->prefix . ' ' . $quotation->customer->firstname . ' ' . $quotation->customer->lastname)
                                            @endphp
                                            <tr>
                                                <td class="oneline">
                                                    @if($quotation->status == 0)
                                                        <a href="{{ url(Session::get('guard') . '/quotations/' . $quotation->id . '/build') }}">
                                <span class="btn btn-outline btn-primary btn-xs">
                                #{{ $profile->profile_billing->quotation_number_prefix }}{{ $quotation->quotation_no }}
                                </span>
                                                        </a>
                                                    @else
                                                        <a class="btn btn-default btn-xs"
                                                           href="{{ url(Session::get('guard') . '/quotations/' . $quotation->id . '/preview') }}"
                                                           target="_blank" title="{{ trans('app.print_or_view') }}"
                                                           class="tableicon">
                                                            #{{ $profile->profile_billing->quotation_number_prefix }}{{ $quotation->quotation_no }}
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="text-left oneline">
                                                    @if($quotation->status == 1)
                                                        <a class="postconfirm hand tableicon"
                                                           data-title="{{ trans('app.cancel_signature_request') }}"
                                                           title="{{ trans('app.cancel_signature_request') }}"
                                                           data-description="{{  trans('app.are_you_sure_you_want_to_revoke_the_electronic_signature_request_for_quote_no',["quote_no" => $profile->profile_billing->quotation_number_prefix.$quotation->quotation_no]) }}"
                                                           data-reloaddiv="reload"
                                                           @if($class == 'CustomersController')
                                                           data-reloadurl="{{ url(Session::get('guard') . '/customers/' . $quotation->customer->id . '/quotations') }}"
                                                           @else
                                                           data-reloadurl="{{ url(Session::get('guard') . '/quotations') }}"
                                                           @endif
                                                           data-posturl="{{ url(Session::get('guard') . '/quotations/' . $quotation->id . '/revoke_signature_request') }}">
                                                            <i class="fa fa-times-circle"></i>
                                                        </a>
                                                    @endif
                                                    @if($quotation->status == 0)
                                                        <span class="yellowbg"
                                                              style="background-color:#ffff83;">{{ $quotation->text_status }}</span>
                                                    @else
                                                        {{ $quotation->text_status }}
                                                    @endif
                                                    @if(($quotation->status == 2) && ($quotation->electronic_signature_token->electronic_signature_archive != null))
                                                        <span class="showSwal hand"
                                                              data-title="{{ trans('app.signature_confirmation') }}"
                                                              data-description="{{ trans('app.this_documenttype_was_signed_by_signedbywho_on_datewhensigned',["documenttype" => strtolower(trans('app.quotation')), "signedbywho" => ucwords($quotation->electronic_signature_token->electronic_signature_archive->signed_by_names) . ' (' . $quotation->electronic_signature_token->electronic_signature_archive->ip_address . ')', "datewhensigned" => CustomHelper::dateLong($quotation->electronic_signature_token->electronic_signature_archive->created_at)]) }}"
                                                        ><i class="fa fa-pencil-square"></i></span>
                                                    @endif
                                                </td>
                                                @if($class == 'QuotationsController')
                                                    <td class="text-center">
                                <span class="label label-primary">
                                    {{ trans('app.customer') }}
                                </span>
                                                    </td>
                                                    <td class="oneline">
                                                        <a href="{{ url(Session::get('guard') . '/customers/' . $quotation->customer->id) }}">
                                <span class="btn btn-outline btn-info btn-xs">
                                {{ $customernames }}
                                </span>
                                                        </a>
                                                    </td>
                                                @endif
                                                <td class="text-center oneline">
                                                    @if($quotation->quotation_items->count() == 0)
                                                        <span class="label label-danger">{{ $quotation->quotation_items->count() }}</span>
                                                    @else
                                                        <span class="label label-info">{{ $quotation->quotation_items->count() }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-left oneline">
                                                    {{ $quotation->quotation_date }}
                                                </td>
                                                <td class="text-left oneline">
                                                    {{ $quotation->expiry_date }}
                                                </td>
                                                <td class="text-center oneline">
                                                    {{ $quotation->currency }}
                                                </td>
                                                <td class="text-center oneline">
                                                    {{ $quotation->tax_configuration->percentage }}%
                                                </td>
                                                <td class="text-right oneline">
                                                    {{ number_format($quotation->total_amount,$donumberformat) }}
                                                </td>
                                                <td class="text-right oneline">
                                                    @if($quotation->quotation_items->count() > 0)
                                                        @if(($quotation->status == 0) || ($quotation->status == 2))
                                                            <a class="postconfirm hand tableicon"
                                                               title="{{ trans('app.create_an_invoice') }}"
                                                               data-title="{{ trans('app.create_an_invoice') }}"
                                                               data-description="{!! trans('app.are_you_sure_you_want_to_create_an_invoice_based_on_quotation_quoteno_for_you_being_more_in_control_the_auto_generated_invoice_will_not_be_automatically_emailed_to_the_customer',["quoteno" => "<strong>" . $quotation->profile->profile_billing->quotation_number_prefix . $quotation->quotation_no . "</strong>"]) !!}"
                                                               @if($class == 'CustomersController')
                                                               data-reloadurl="{{ url(Session::get('guard') . '/customers/' . $quotation->customer->id . '/quotations') }}"
                                                               @else
                                                               data-reloadurl="{{ url(Session::get('guard') . '/quotations') }}"
                                                               @endif
                                                               data-posturl="{{ url(Session::get('guard') . '/quotations/' . $quotation->id . '/quotationtoinvoice') }}">
                                                                <i class="fa fa-credit-card-alt"></i>
                                                            </a>
                                                        @endif
                                                        <a href="{{ url(Session::get('guard') . '/quotations/' . $quotation->id . '/preview') }}"
                                                           target="_blank" title="{{ trans('app.print_or_view') }}"
                                                           class="tableicon">
                                                            <i class="fa fa-print"></i>
                                                        </a>
                                                        <a href="{{ url(Session::get('guard') . '/quotations/' . $quotation->id . '/download') }}"
                                                           target="_blank" title="{{ trans('app.download') }}"
                                                           class="tableicon">
                                                            <i class="fa fa-cloud-download"></i>
                                                        </a>
                                                        <a class="postconfirm hand tableicon"
                                                           data-title="{{ trans('app.email_quotation') }}"
                                                           title="{{ trans('app.email_quotation') }}"
                                                           data-description="{{  trans('app.do_you_want_to_email_quotation_quoteno_to_whereto',["quoteno" => $profile->profile_billing->quotation_number_prefix.$quotation->quotation_no,"whereto" => $customernames]) }}"
                                                           data-reloaddiv="reload"
                                                           @if($class == 'CustomersController')
                                                           data-reloadurl="{{ url(Session::get('guard') . '/customers/' . $quotation->customer->id . '/quotations') }}"
                                                           @else
                                                           data-reloadurl="{{ url(Session::get('guard') . '/quotations') }}"
                                                           @endif
                                                           data-posturl="{{ url(Session::get('guard') . '/quotations/' . $quotation->id . '/email') }}">
                                                            <i class="fa fa-envelope"></i>
                                                        </a>
                                                        {{--<a href="{{ url(Session::get('guard') . '/quotations/' . $quotation->id . '/email_history') }}"--}}
                                                           {{--target="_blank"--}}
                                                           {{--title="{{ trans('app.email_history') }}"--}}
                                                           {{--class="tableicon">--}}
                                                            {{--<i class="fa fa-history"></i>--}}
                                                        {{--</a>--}}
                                                    @endif
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
                                @if((count($quotations) == 0) && (last(explode('/',url()->current())) != 'search'))
                                    {{ trans('app.no_data_found') }}
                                @endif
                                @if((last(explode('/',url()->current())) == 'search') && (count($quotations) > 0))
                                    <a href="{{ url(Session::get('guard') . '/quotations') }}"
                                       class="fetchajaxpage">{{ trans('app.reset_search') }}</a>
                                @elseif((last(explode('/',url()->current())) == 'search') && (count($quotations) == 0))
                                    <a href="{{ url(Session::get('guard') . '/quotations') }}"
                                       class="fetchajaxpage">{{ trans('app.no_results_found_reset_search') }}</a>
                                @endif
                            </div>
                            @if(method_exists($quotations,'links'))
                                <div align="center">
                                    @if($quotations->links())
                                        <div align="center">
                                            @if(Request::get('q'))
                                                {{ $quotations->appends(['q' => Request::get('q')])->links() }}
                                            @else
                                                {{ $quotations->links() }}
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