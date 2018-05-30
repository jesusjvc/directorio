<div class="reload">
    <div class="panel-body">
        <div class="collapse" id="collapse">
            <div class="text-muted">{!! trans('descriptions.service_items_example') !!}</div>
            <hr>
        </div>
        @if($items->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>
                            {{ trans('app.service_module') }}
                        </th>
                        <th>
                            {{ trans('app.category') }}
                        </th>
                        <th>
                            {{ trans('app.name') }}
                        </th>
                        <th class="text-right">
                            {{ trans('app.amount') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>
                                @if($item->static_service_module != null)
                                    {{ trans('app.' . CustomHelper::reverseUscore($item->static_service_module->module)) }}
                                @else
                                    {{ trans('app.general_item') }}
                                @endif
                            </td>
                            <td>
                                @if($item->service_category != null)
                                    {{ $item->service_category->category_name }}
                                @endif
                            </td>
                            <td>{{ $item->name }}
                            </td>
                            <td class="text-right">{{ Session::get('profile_settings')->profile_billing->default_currency_symbol }}{{ number_format($item->amount,2) }}
                            </td>
                            <td class="text-right">
                                <span class="btn btn-primary btn-xs" data-toggle="modal" data-target="#ajaxmodel"
                                      data-remote="{{ url(Session::get('guard') . '/service_items/'.$item->id.'/edit') }}">{{ trans('app.edit') }}</span>
                            </td>
                            <td class="text-right">
                                <span class="btn btn-danger btn-xs postconfirm" data-deleteid="ab{{ $item->id }}"
                                      data-title="{{ trans('app.delete_service_item') }}"
                                      data-description="{{ trans('app.are_you_sure_you_want_to_delete_the_service_item_item',["item" => "<i>$item->name</i>"]) }}"
                                      data-reloadurl="{{ url(Session::get('guard') . '/service_items') }}"
                                      data-posturl="{{ url(Session::get('guard') . '/service_items/'.$item->id) }}">{{ trans('app.delete') }}</span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            {{ trans('app.no_data_found') }}
        @endif
    </div>
</div>