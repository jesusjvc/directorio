<div class="reload">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>
                        {{ trans('app.prefix') }}
                    </th>
                    <th>
                        {{ trans('app.firstname') }}
                    </th>
                    <th>{{ trans('app.lastname') }}
                    </th>
                    <th>{{ trans('app.email_address') }}
                    </th>
                    <th>
                        {{ trans('app.mobile_no') }}
                    </th>
                    <th>
                        {{ trans('app.contact_numbers') }}
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
                @foreach($users as $user)
                    <tr>
                        <td>{{ trans('app.'.$user->prefix) }}
                        </td>
                        <td>{{ $user->firstname }}
                        </td>
                        <td>{{ $user->lastname }}
                        </td>
                        <td><span style="white-space: nowrap">
                            @if(Auth::user()->id != $user->id)
                                    <a href="{{ url(Session::get('guard') . '/users/' . $user->id . '/send_mail') }}"
                                       class="fetchajaxpage"
                                       title="{{ trans('app.send_an_email_to_customer_names',["customer_names" => ucwords(trans('app.' . $user->prefix) . ' ' . $user->firstname . ' ' . $user->lastname)]) }}">
                                    <i class="fa fa-envelope"></i>
                                </a>
                                @endif
                                {{ $user->email }}
                            </span>
                        </td>
                        <td><span style="white-space: nowrap">
                            @if(Auth::user()->id != $user->id)
                                    @if (Session::get('app_settings')->disable_sms == 0)
                                    <a href="{{ url(Session::get('guard') . '/users/' . $user->id . '/send_sms') }}"
                                       class="fetchajaxpage"
                                       title="{{ trans('app.send_a_sms_to_customer_names',["customer_names" => ucwords(trans('app.' . $user->prefix) . ' ' . $user->firstname . ' ' . $user->lastname)]) }}">
                                    <i class="fa fa-comments-o"></i>
                                </a>
                                @endif
                                @endif
                                +{{ $user->mobile_no }}
                            </span>
                        </td>
                        <td>
                            @if($user->contact_numbers->count() > 0)
                                @foreach($user->contact_numbers as $number)
                                    <form role="form" method="POST"
                                          action="{{ url(Session::get('guard') . '/user_contact_numbers/' . $number->id) }}">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div style="white-space: nowrap">
                                                    <u>{{ trans('app.'.$number->number_type) }}</u>
                                                </div>
                                            </div>
                                            <div class="col-xs-12" style="white-space: nowrap">
                                                <a href="#" class="postconfirm red"
                                                   title="{{ trans('app.delete') }}"
                                                   style="margin-right:5px;"
                                                   data-title="{{ trans('app.delete_contact_number') }}"
                                                   @if(is_numeric($number->contact_number))
                                                   data-description="{{ trans('app.are_you_sure_you_want_to_delete_the_contact_number_number',['number' => '+' . $number->contact_number]) }}"
                                                   @else
                                                   data-description="{{ trans('app.are_you_sure_you_want_to_delete_the_contact_number_number',['number' => $number->contact_number]) }}"
                                                   @endif
                                                   data-reloadurl="{{ url(Session::get('guard') . '/users') }}"
                                                   data-posturl="{{ url(Session::get('guard') . '/user_contact_numbers/' . $number->id) }}">
                                                    <i class="fa fa-times-circle"></i>
                                                </a>
                                                <a href="#" class="red" title="{{ trans('app.edit') }}"
                                                   style="margin-right:5px;" data-toggle="modal"
                                                   data-target="#ajaxmodel"
                                                   data-remote="{{ url(Session::get('guard') . '/user_contact_numbers/' . $number->id . '/edit') }}">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                                @if((is_numeric($number->contact_number)) && (($number->number_type == 'mobile_number') || ($number->number_type == 'landline')))
                                                    @if(($number->number_type == 'mobile_number') && (is_numeric($number->contact_number)))
                                                        @if (Session::get('app_settings')->disable_sms == 0)
                                                        <a href="{{ url(Session::get('guard') . '/users/' . $user->id . '/send_sms/' . $number->id) }}"
                                                           class="fetchajaxpage" style="margin-right:5px;"
                                                           title="{{ trans('app.send_a_sms_to_customer_names',["customer_names" => ucwords(trans('app.' . $user->prefix) . ' ' . $user->firstname . ' ' . $user->lastname)]) }}">
                                                            <i class="fa fa-comments-o"></i>
                                                        </a>
                                                    @endif
                                                    @endif
                                                    @if((($number->number_type == 'mobile_number') || ($number->number_type == 'landline')) && (is_numeric($number->contact_number)))

                                                    @endif
                                                    {{ '+' . $number->contact_number }}
                                                @else
                                                    {{ $number->contact_number }}
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                @endforeach
                            @endif
                        </td>
                        <td>
                                        <span class="btn btn-xs btn-info" data-toggle="modal" data-target="#ajaxmodel"
                                              data-remote="{{ url(Session::get('guard') . '/user_contact_numbers/'. $user->id . '/create') }}">{{ trans('app.add_contact_number') }}</span>
                        </td>
                        <td>
                            @if(Auth::user()->id != $user->id)
                                <span class="btn btn-primary btn-xs" data-toggle="modal"
                                      data-target="#ajaxmodel"
                                      data-remote="{{ url(Session::get('guard') . '/users/'.$user->id.'/edit') }}">{{ trans('app.edit') }}</span>
                            @endif
                        </td>
                        <td>
                            @if(Auth::user()->id != $user->id)
                                <form role="form" method="POST"
                                      action="{{ url(Session::get('guard') . '/'.$profile->id.'/users/'.$user->id) }}"
                                      id="{{ $user->id }}">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <span class="btn btn-danger btn-xs postconfirm"
                                          data-title="{{ trans('app.delete_user') }}"
                                          data-description="{{ trans('app.are_you_sure_you_want_to_delete_the_user') }} {{ ucwords(trans('app.' . $user->prefix)) }} {{ $user->firstname }} {{ $user->lastname }}"
                                          data-reloadurl="{{ url(Session::get('guard') . '/users') }}"
                                          data-posturl="{{ url(Session::get('guard') . '/users/'.$user->id) }}">{{ trans('app.delete') }}</span>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>