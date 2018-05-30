<div class="reload">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.custom_invoice_fields') }}
                    <div class="pull-right">
                        <span class="btn btn-xs btn-success" data-toggle="modal" data-target="#ajaxmodel"
                              data-remote="{{ url(Session::get('guard') . '') }}/custom_invoice_fields/create">
                            {{ trans('app.create_a_new_custom_invoice_field') }}
                        </span>
                    </div>
                </div>
                <div class="panel-body">
                    @if(count($fields) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>
                                        {{ trans('app.field_name') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('app.required') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('app.type') }}
                                    </th>
                                    <th class="text-center">
                                        {{ trans('app.show_on_export') }}
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
                                @foreach($fields as $field)
                                    <tr>
                                        <td>
                                            {{ $field->field_name }}
                                        </td>
                                        <td class="text-center">
                                            {{ trans('app.' . $field->required) }}
                                        </td>
                                        <td class="text-center">
                                            {{ trans('app.' . $field->type) }}
                                        </td>
                                        <td class="text-center">
                                            {{ trans('app.' . $field->show_on_export) }}
                                        </td>
                                        <td>
                                        <span class="btn btn-primary btn-xs" data-toggle="modal"
                                              data-target="#ajaxmodel"
                                              data-remote="{{ url(Session::get('guard') . '/custom_invoice_fields/'.$field->id.'/edit') }}">{{ trans('app.edit') }}</span>
                                        </td>
                                        <td>
                                            @if($field->custom_invoice_field_values->count() == 0)
                                                <form role="form" method="POST"
                                                      action="{{ url(Session::get('guard') . '/custom_invoice_fields/'.$field->id) }}"
                                                      id="{{ $field->id }}">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <span class="btn btn-danger btn-xs postconfirm"
                                                          data-title="{{ trans('app.delete_custom_invoice_field') }}"
                                                          data-description="{{ trans('app.are_you_sure_you_want_to_delete_the_custom_invoice_field_field', ["field" => ucwords($field->field_name)]) }}"
                                                          data-reloadurl="{{ url(Session::get('guard') . '/custom_invoice_fields') }}"
                                                          data-posturl="{{ url(Session::get('guard') . '/custom_invoice_fields/'.$field->id) }}">{{ trans('app.delete') }}</span>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center">
                            {{ trans('app.no_data_found') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>