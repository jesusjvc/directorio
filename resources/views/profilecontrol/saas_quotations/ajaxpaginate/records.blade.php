<section class="records">
    <div class="reload" id="ajaxpaginateblock">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.quotations') }}
                        <div class="pull-right">
                            <a href="{{ url('profilecontrol/quotations/create') }}">
                        <span class="btn btn-xs btn-success">
                            {{ trans('app.create_a_new_quotation') }}
                        </span>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-left oneline">
                                        #
                                    </th>
                                    <th class="text-center oneline">
                                        {{ trans('app.items') }}
                                    </th>
                                    <th class="text-left oneline">
                                        {{ trans('app.status') }}
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
                                        {{ trans('app.total_homecurrency',["homecurrency" => Session::get('profile_settings')->profile_billing->default_currency]) }}
                                        <small>{{ trans('app.incl') }}</small>
                                    </th>
                                </tr>
                                </thead>
                                @if(count($quotations) > 0)
                                    <tbody>
                                    @foreach ($quotations as $quotation)
                                        <tr>
                                            <td class="oneline">
                                                <a class="btn btn-default btn-xs"
                                                   href="{{ url('documents/quotation/' . $quotation->thumbprint) }}"
                                                   target="_blank" title="{{ trans('app.print_or_view') }}"
                                                   class="tableicon">
                                                    #{{ $profile->profile_billing->quotation_number_prefix }}{{ $quotation->quotation_no }}
                                                </a>
                                            </td>
                                            <td class="text-center oneline">
                                                <span class="label label-info">{{ $quotation->quotation_items->count() }}</span>
                                            </td>
                                            <td class="text-left oneline">
                                                {{ $quotation->textStatus }}
                                                @if(($quotation->status == 2) && ($quotation->electronic_signature_token->electronic_signature_archive != null))
                                                    <span class="showSwal hand"
                                                          data-title="{{ trans('app.signature_confirmation') }}"
                                                          data-description="{{ trans('app.this_documenttype_was_signed_by_signedbywho_on_datewhensigned',["documenttype" => strtolower(trans('app.quotation')), "signedbywho" => ucwords($quotation->electronic_signature_token->electronic_signature_archive->signed_by_names) . ' (' . $quotation->electronic_signature_token->electronic_signature_archive->ip_address . ')', "datewhensigned" => CustomHelper::dateLong($quotation->electronic_signature_token->electronic_signature_archive->created_at)]) }}"
                                                    ><i class="fa fa-pencil-square"></i></span>
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
                                                {{ number_format($quotation->total_amount,2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>
                        <div class="panel-footer">
                            @if(method_exists($quotations,'links'))
                                <div align="center">
                                    @if($quotations->links())
                                        <div align="center">
                                            {{ $quotations->links() }}
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