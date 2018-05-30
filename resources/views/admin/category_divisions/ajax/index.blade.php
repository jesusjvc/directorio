<div class="reload">
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
                            {{ trans('app.child_categories') }}
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
                            <td>{{ $category->title }}
                            </td>
                            <td>
                                <a href="{{ url(Session::get('guard') . '/child_categories') }}">
                                    @if($category->child_categories->count() == 0)
                                        <span class="btn btn-outline btn-danger btn-xs">{{ $category->child_categories->count() }}</span>
                                    @else
                                        <span class="btn btn-outline btn-info btn-xs">{{ $category->child_categories->count() }}</span>
                                    @endif
                                </a>
                            </td>
                            <td class="text-right">
                                <span class="btn btn-primary btn-xs" data-toggle="modal" data-target="#ajaxmodel"
                                      data-remote="{{ url(Session::get('guard') . '/category_divisions/'.$category->id.'/edit') }}">{{ trans('app.edit') }}
                                </span>
                            </td>
                            <td class="text-right">
                                @if($category->child_categories->count() == 0)
                                    <span class="btn btn-danger btn-xs postconfirm"
                                          data-title="{{ trans('app.delete_division_category') }}"
                                          data-description="{!! trans('app.are_you_sure_you_want_to_delete_the_division_category_category',["category" => "<i>$category->title</i>"]) !!}"
                                          data-reloadurl="{{ url(Session::get('guard') . '/category_divisions') }}"
                                          data-posturl="{{ url(Session::get('guard') . '/category_divisions/'.$category->id) }}">{{ trans('app.delete') }}</span>
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