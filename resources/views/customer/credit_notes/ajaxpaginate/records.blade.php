<section class="records">
    <div class="reload" id="ajaxpaginateblock">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.credit_notes') }}
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-left oneline">
                                        #
                                    </th>
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
                                        {{ trans('app.total_homecurrency',["homecurrency" => $profile->profile_billing->default_currency]) }}
                                        <small>{{ trans('app.incl') }}</small>
                                    </th>
                                    <th class="text-center">

                                    </th>
                                </tr>
                                </thead>
                                @if(count($credit_notes) > 0)
                                    <tbody>
                                    @foreach ($credit_notes as $credit_note)
                                            <tr>
                                                <td class="oneline">
                                                    <a href="{{ url('documents/credit_note/' . $credit_note->thumbprint) }}"
                                                       target="_blank" title="{{ trans('app.print_or_view') }}"
                                                       class="tableicon">
                                                        <span class="btn btn-default btn-xs">
                                                            #{{ $profile->profile_billing->credit_note_number_prefix }}{{ $credit_note->credit_note_no }}
                                                        </span>
                                                    </a>
                                                </td>
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
                                            </tr>
                                    @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>
                        <div class="panel-footer">
                            @if(method_exists($credit_notes,'links'))
                                <div align="center">
                                    @if($credit_notes->links())
                                        <div align="center">
                                            {{ $credit_notes->links() }}
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