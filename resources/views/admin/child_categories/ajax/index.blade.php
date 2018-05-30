<div class="reload">
    <div class="panel-body">
        <div class="collapse" id="collapse">
            <div class="text-muted">{!! trans('descriptions.child_categories_example') !!}</div>
            <hr>
        </div>
        @if($categories->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>
                            {{ trans('app.category') }}
                        </th>
                        <th>
                            {{ trans('app.name') }}
                        </th>
                        <th class="text-center">
                            {{ trans('app.times_used') }}
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
                    @foreach($categories as $child_category)
                        <tr>
                            <td>
                                @if($child_category->category_division != null)
                                    {{ $child_category->category_division->title }}
                                @endif
                            </td>
                            <td>
                                {{ $child_category->title }}
                            </td>
                            <td class="text-center">
                                <span class="btn btn-outline btn-info btn-xs">{{ $child_category->professionals()->count() }}</span>
                            </td>
                            <td class="text-right">
                                <span class="btn btn-primary btn-xs" data-toggle="modal" data-target="#ajaxmodel"
                                      data-remote="{{ url(Session::get('guard') . '/child_categories/' . $child_category->id . '/edit') }}">{{ trans('app.edit') }}</span>
                            </td>
                            <td class="text-right">
                                <span class="btn btn-danger btn-xs postconfirm" data-deleteid="ab{{ $child_category->id }}"
                                      data-title="{{ trans('app.delete_child_category') }}"
                                      data-description="{{ trans('app.are_you_sure_you_want_to_delete_the_child_category_category',["category" => "<i>$child_category->title</i>"]) }}"
                                      data-reloadurl="{{ url(Session::get('guard') . '/child_categories') }}"
                                      data-posturl="{{ url(Session::get('guard') . '/child_categories/'.$child_category->id) }}">{{ trans('app.delete') }}</span>
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