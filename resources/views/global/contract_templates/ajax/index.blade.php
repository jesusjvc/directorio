<div class="reload">
    <div class="panel-body">
        @if($templates->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>
                            {{ trans('app.title') }}
                        </th>
                        <th class="text-center">
                            {{ trans('app.related_contracts') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                        <th>
                            &nbsp;
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
                    @foreach($templates as $template)
                        <tr>
                            <td>
                                {{ $template->title }}
                            </td>
                            <td class="text-center">
                                <span class="label label-info">{{ $template->contracts->count() }}</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ url(Session::get('guard') . '/contracts/create/' . $template->id) }}"
                                   class="fetchajaxpage">
                                    <span class="btn btn-primary btn-xs">{{ trans('app.create_contract') }}</span>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ url(Session::get('guard') . '/contracts/template/' . $template->id) }}"
                                   class="fetchajaxpage">
                                    <span class="btn btn-success btn-xs">{{ trans('app.view_contracts') }}</span>
                                </a>
                            </td>
                            <td class="text-right">
                                <a href="{{ url(Session::get('guard') . '/contract_templates/'.$template->id.'/edit') }}"
                                   class="fetchajaxpage">
                                    <span class="btn btn-warning btn-xs">{{ trans('app.edit_template') }}</span>
                                </a>
                            </td>
                            <td class="text-right">
                                @if($template->contracts->count() == 0)
                                    <span class="btn btn-danger btn-xs postconfirm"
                                          data-title="{{ trans('app.delete_contract') }}"
                                          data-description="{{ trans('app.are_you_sure_you_want_to_delete_the_contract_template_templatename',["templatename" => "<i>$template->title</i>"]) }}"
                                          data-reloadurl="{{ url(Session::get('guard') . '/contract_templates') }}"
                                          data-posturl="{{ url(Session::get('guard') . '/contract_templates/'.$template->id) }}">{{ trans('app.delete') }}</span>
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