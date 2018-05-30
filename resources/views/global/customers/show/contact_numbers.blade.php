<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ trans('app.customer_namess_additional_contact_numbers',["customer_names" => ucwords(trans('app.' . $customer->prefix) . ' ' . $customer->firstname . ' ' . $customer->lastname)]) }}
                <div class="pull-right">
                        <span class="btn btn-xs btn-success" data-toggle="modal" data-target="#ajaxmodel"
                              data-remote="{{ url(Session::get('guard') . '/customer_contact_numbers/' . $customer->id . '/create') }}">
                            {{ trans('app.add_a_contact_number') }}
                        </span>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    @if(count($customer->contact_numbers) > 0)
                        <table class="table">
                            <thead>
                            <tr>
                                <th>
                                    {{ trans('app.number_type') }}
                                </th>
                                <th>
                                    {{ trans('app.contact_number') }}
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
                            @foreach($customer->contact_numbers as $contact_number)
                                <tr>
                                    <td>
                                        {{ trans('app.' . $contact_number->number_type) }}
                                    </td>
                                    <td>
                                        @if(Session::get('guard') != 'customer')
                                            @if($contact_number->number_type == 'mobile_number')
                                                @if (Session::get('app_settings')->disable_sms == 0)
                                                    <a href="{{ url(Session::get('guard') . '/customers/' . $customer->id . '/send_sms/' . $contact_number->id) }}"
                                                       class="fetchajaxpage"
                                                       title="{{ trans('app.send_a_sms_to_customer_names',["customer_names" => ucwords(trans('app.' . $customer->prefix) . ' ' . $customer->firstname . ' ' . $customer->lastname)]) }}">
                                                        <i class="fa fa-comments"></i>
                                                    </a>
                                                @endif
                                            @endif
                                        @endif
                                        @if(($contact_number->number_type == 'mobile_number') || ($contact_number->number_type == 'landline'))

                                        @endif
                                        @if(($contact_number->number_type == 'mobile_number') || ($contact_number->number_type == 'landline'))
                                            +@endif{{ $contact_number->contact_number }}
                                    </td>
                                    <td>
                                        <span class="btn btn-primary btn-xs" data-toggle="modal"
                                              data-target="#ajaxmodel"
                                              data-remote="{{ url(Session::get('guard') . '/customer_contact_numbers/' . $contact_number->id.'/edit') }}">{{ trans('app.edit') }}
                                        </span>
                                    </td>
                                    <td>
                                            <span class="btn btn-danger btn-xs postconfirm"
                                                  data-title="{{ trans('app.delete_contact_number') }}"
                                                  data-description="{{ trans('app.are_you_sure_you_want_to_delete_the_type_contact_entry_entry',["type" => "<i>" . trans('app.' . $contact_number->number_type) . "</i>", "entry" => "<i>" . $contact_number->contact_number . "</i>"]) }}"
                                                  @if(Session::get('guard') == 'customer')
                                                  data-reloadurl="{{ url(Session::get('guard') . '/customer_contact_numbers') }}"
                                                  @else
                                                  data-reloadurl="{{ url(Session::get('guard') . '/customers/' . $contact_number->customer->id) }}"
                                                  @endif
                                                  data-posturl="{{ url(Session::get('guard') . '/customer_contact_numbers/'.$contact_number->id) }}">{{ trans('app.delete') }}</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-center">{{ trans('app.no_entries_found') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>