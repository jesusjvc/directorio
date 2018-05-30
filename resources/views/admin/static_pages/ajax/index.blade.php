<div class="reload">
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ trans('app.static_pages') }}
                <div class="pull-right">
                    <a class="btn btn-xs btn-success"
                       href="{{ url('/admin/cms/create') }}">{{ trans('app.create_a_new_static_page') }}</a>
                </div>
            </div>
            <div class="panel-body">
                @if($pages->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>
                                    {{ trans('app.title') }}
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
                            @foreach($pages as $page)
                                <tr>
                                    <td>
                                        {{ $page->title }}
                                    </td>
                                    <td class="text-right">
                                        <a class="btn btn-primary btn-xs"
                                           href="{{ url('admin/cms/' . $page->slug) }}">{{ trans('app.edit') }}</a>
                                    </td>
                                    <td class="text-right">
                                <span class="btn btn-danger btn-xs postconfirm"
                                      data-title="{{ trans('app.delete_this_page') }}"
                                      data-description="{{ trans('app.are_you_sure_you_want_to_delete_the_page_title', ["title" => "<i>". $page->title . "</i>"]) }}"
                                      data-reloadurl="{{ url('admin/cms') }}"
                                      data-posturl="{{ url('admin/cms/' . $page->slug) }}">{{ trans('app.delete') }}</span>
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
    </div>
</div>
</div>