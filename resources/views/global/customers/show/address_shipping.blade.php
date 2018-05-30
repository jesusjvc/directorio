<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ trans('app.customer_namess_shipping_addresses',["customer_names" => ucwords(trans('app.' . $customer->prefix) . ' ' . $customer->firstname . ' ' . $customer->lastname)]) }}
                <div class="pull-right">
                        <span class="btn btn-xs btn-success" data-toggle="modal" data-target="#ajaxmodel"
                              data-remote="{{ url(Session::get('guard') . '/customer_shipping_address/' . $customer->id . '/create') }}">
                            {{ trans('app.register_a_new_shipping_address') }}
                        </span>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    @if(count($customer->address_shippings) > 0)
                        <table class="table">
                            <thead>
                            <tr>
                                <th>
                                    {{ trans('app.address') }}
                                </th>
                                <th>
                                    {{ trans('app.address_1') }}
                                </th>
                                <th>
                                    {{ trans('app.address_2') }}
                                </th>
                                <th>{{ trans('app.city') }}
                                </th>
                                <th>{{ trans('app.postal_code') }}
                                </th>
                                <th>
                                    {{ trans_choice('app.country',1) }}
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
                            @foreach($customer->address_shippings as $address)
                                <tr>
                                    <td>
                                        @if($address->is_default == 1)
                                            <mark data-toggle="tooltip"
                                                  title="{{ trans('app.this_is_the_default_addresstype_address',["addresstype" => trans('app.shipping')]) }}"
                                                  class="hand"> {{ $address->friendly_name }} </mark>
                                        @else
                                            {{ $address->friendly_name }}
                                        @endif
                                    </td>
                                    <td>{{ $address->address_1 }}
                                    </td>
                                    <td>{{ $address->address_2 }}
                                    </td>
                                    <td>{{ $address->city }}
                                    </td>
                                    <td>
                                        {{ $address->postal_code }}
                                    </td>
                                    <td>
                                        @if((isset(Session::get('static_countries')[$address->country])) && (Session::get('static_countries')[$address->country] != null))
                                            {{ Session::get('static_countries')[$address->country]->country }}
                                        @else
                                            {{ $address->country }}
                                        @endif
                                    </td>
                                    <td>
                                        <span class="btn btn-primary btn-xs" data-toggle="modal"
                                              data-target="#ajaxmodel"
                                              data-remote="{{ url(Session::get('guard') . '/customer_shipping_address/' . $address->id.'/edit') }}">{{ trans('app.edit') }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($address->is_default != 1)
                                            <span class="btn btn-danger btn-xs postconfirm"
                                                  data-title="{{ trans('app.delete_address') }}"
                                                  data-description="{{ trans('app.are_you_sure_you_want_to_delete_the_shipping_address_theaddress',['theaddress' => "<i>" . $address->friendly_name . "</i>"]) }}"
                                                  @if(Session::get('guard') == 'customer')
                                                  data-reloadurl="{{ url(Session::get('guard') . '/address_management') }}"
                                                  @else
                                                  data-reloadurl="{{ url(Session::get('guard') . '/customers/' . $customer->id) }}"
                                                  @endif
                                                  data-posturl="{{ url(Session::get('guard') . '/customer_shipping_address/'.$address->id) }}">{{ trans('app.delete') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($address->is_default != 1)
                                            <span class="btn btn-danger btn-xs confirmajaxpost"
                                                  data-title="{{ trans('app.set_as_default') }}"
                                                  data-description="{{ trans('app.are_you_sure_you_want_to_set_the_address_theaddress_as_the_default_billing_address',['theaddress' => "<i>" . $address->friendly_name . "</i>"]) }}"
                                                  data-posturl="{{ url(Session::get('guard') . '/customer_shipping_address/'.$address->id.'/setasdefault') }}"
                                                  @if(Session::get('guard') == 'customer')
                                                  data-reloadurl="{{ url(Session::get('guard') . '/address_management') }}"
                                                  @else
                                                  data-reloadurl="{{ url(Session::get('guard') . '/customers/' . $customer->id) }}"
                                                    @endif
                                            >{{ trans('app.set_as_default') }}</span>
                                        @endif
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