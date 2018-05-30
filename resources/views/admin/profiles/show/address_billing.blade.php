@php
    $sectiontoreload = mt_rand(10000,99999)
@endphp
<div class="{{ $sectiontoreload }}">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.profile') }} {{ trans_choice('app.billing_address',count($profile->address_billings)) }}
                    <div class="pull-right">
                        <span class="btn btn-xs btn-success" data-toggle="modal" data-target="#ajaxmodel"
                              data-remote="{{ url(Session::get('guard') . '/profiles/' . $profile->id . '/address_billings/create/' . $sectiontoreload) }}">
                            {{ trans('app.register_a_new_billing_address') }}
                        </span>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
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
                            @foreach($profile->address_billings as $address)
                                <tr>
                                    <td>
                                        @if($address->is_default == 1)
                                            <mark data-toggle="tooltip"
                                                  title="{{ trans('app.this_is_the_default_addresstype_address',["addresstype" => trans('app.billing')]) }}"
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
                                              data-remote="{{ url(Session::get('guard') . '/profiles/' . $profile->id . '/address_billings/' . $address->id . '/edit/' . $sectiontoreload) }}">{{ trans('app.edit') }}</span>
                                    </td>
                                    <td>
                                        @if($address->is_default != 1)
                                            <span class="btn btn-danger btn-xs postconfirm"
                                                  data-title="{{ trans('app.delete_address') }}"
                                                  data-description="{{ trans('app.are_you_sure_you_want_to_delete_the_billing_address_theaddress',['theaddress' => "<i>" . $address->friendly_name . "</i>"]) }}"
                                                  data-reloaddiv="{{ $sectiontoreload }}"
                                                  data-reloadurl="{{ url(Session::get('guard') . '/profiles/' . $profile->id . '/address_billings') }}"
                                                  data-posturl="{{ url(Session::get('guard') . '/profiles/' . $profile->id . '/address_billings/' . $address->id) }}">{{ trans('app.delete') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($address->is_default != 1)
                                            <span class="btn btn-danger btn-xs confirmajaxpost"
                                                  data-reloaddiv="{{ $sectiontoreload }}"
                                                  data-title="{{ trans('app.set_as_default') }}"
                                                  data-description="{{ trans('app.are_you_sure_you_want_to_set_the_address_theaddress_as_the_default_billing_address',['theaddress' => "<i>" . $address->friendly_name . "</i>"]) }}"
                                                  data-posturl="{{ url(Session::get('guard') . '/profiles/' . $profile->id . '/address_billings/' . $address->id . '/setasdefault') }}"
                                                  data-reloadurl="{{ url(Session::get('guard') . '/profiles/' . $profile->id . '/address_billings') }}">{{ trans('app.set_as_default') }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <p align="center"><i>
                            <small>{{ trans('descriptions.business_shipping_billing_address',['BUSINESSNAME' => Session::get('profile_settings')->business_name]) }}</small>
                        </i></p>
                </div>
            </div>
        </div>
    </div>
</div>