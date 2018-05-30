<div class="reloadservicecategories">
    <div class="panel-body">
        @if($categories->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>
                            {{ trans('app.category') }}
                        </th>
                        <th>
                            {{ trans('app.linked_items') }}
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
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->category_name }}
                            </td>
                            <td>
                                <a href="{{ url(Session::get('guard') . '/service_items') }}">
                                    @if($category->service_items->count() == 0)
                                        <span class="btn btn-outline btn-danger btn-xs">{{ $category->service_items->count() }} {{ trans_choice('app.item',$category->service_items->count()) }}</span>
                                    @else
                                        <span class="btn btn-outline btn-info btn-xs">{{ $category->service_items->count() }} {{ trans_choice('app.item',$category->service_items->count()) }}</span>
                                    @endif
                                </a>
                            </td>
                            <td class="text-right">
                                <span class="btn btn-primary btn-xs" data-toggle="modal" data-target="#ajaxmodel"
                                      data-remote="{{ url(Session::get('guard') . '/service_categories/'.$category->id.'/edit') }}">{{ trans('app.edit') }}
                                </span>
                            </td>
                            <td class="text-right">
                                @if($category->service_items->count() == 0)
                                    <span class="btn btn-danger btn-xs postconfirm"
                                          data-title="{{ trans('app.delete_service_category') }}"
                                          data-description="{!! trans('app.are_you_sure_you_want_to_delete_the_service_category_category',["category" => "<i>$category->category_name</i>"]) !!}"
                                          data-reloadurl="{{ url(Session::get('guard') . '/service_categories') }}"
                                          data-reloaddiv="reloadservicecategories"
                                          data-posturl="{{ url(Session::get('guard') . '/service_categories/'.$category->id) }}">{{ trans('app.delete') }}</span>
                                @endif
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