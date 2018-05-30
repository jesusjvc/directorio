@php
    $sectiontoreload = mt_rand(10000,99999)
@endphp
<div class="{{ $sectiontoreload }}">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.profile') }} {{ trans('app.did_inbound_phone_numbers') }}
                    <div class="pull-right">
                        <span class="btn btn-xs btn-success" data-toggle="modal" data-target="#ajaxmodel"
                                data-remote="{{ url(Session::get('guard') . '') }}/{{ $profile->id }}/users/create/{{ $sectiontoreload }}">
                            {{ trans('app.assign_a_did_number') }}
                        </span>
                    </div>
                </div>
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
                            @foreach($profile->users as $user)
                                <tr>
                                    <td>{{ trans('app.'.$user->prefix) }}
                                    </td>
                                    <td>{{ $user->firstname }}
                                    </td>
                                    <td>{{ $user->lastname }}
                                    </td>
                                    <td>{{ $user->email }}
                                    </td>
                                    <td>+{{ $user->mobile_no }}
                                    </td>
                                    <td>
                                        @if($user->phonebooks->count() > 0)
                                            @foreach($user->phonebooks as $number)
                                                <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                    <div class="pull-left">
                                                        <form role="form" method="POST"
                                                              action="{{ url(Session::get('guard') . '/'.$user->id.'/user_phonebook/'.$number->id) }}"
                                                              id="{{ $number->id }}">
                                                            {{ method_field('DELETE') }}
                                                            {{ csrf_field() }}
                                                            <span class="btn btn-danger btn-outline btn-xs postconfirm"
                                                                    style="margin-right:5px;"
                                                                    data-title="{{ trans('app.delete_contact_number') }}"
                                                                    @if(is_numeric($number->contact_number))
                                                                    data-description="{{ trans('app.are_you_sure_you_want_to_delete_the_contact_number_number',['number' => '+' . $number->contact_number]) }}"
                                                                    @else
                                                                    data-description="{{ trans('app.are_you_sure_you_want_to_delete_the_contact_number_number',['number' => $number->contact_number]) }}"
                                                                    @endif
                                                                    data-reloaddiv="{{ $sectiontoreload }}"
                                                                    data-reloadurl="{{ url(Session::get('guard') . '/'.$user->profile_id.'/users') }}"
                                                                    data-posturl="{{ url(Session::get('guard') . '/'.$user->id.'/user_phonebook/'.$number->id) }}">{{ trans('app.delete') }}</span>
                                                        </form>
                                                    </div>
                                                    <div class="pull-left">
                                                        <span class="btn btn-primary btn-outline btn-xs"
                                                                style="margin-right:5px;" data-toggle="modal"
                                                                data-target="#ajaxmodel"
                                                                data-remote="{{ url(Session::get('guard') . '/'.$user->id.'/user_phonebook/'.$number->id.'/edit') }}/{{ $sectiontoreload }}">{{ trans('app.edit') }}</span>
                                                    </div>
                                                    <div class="pull-left">
                                                        <div style="white-space: nowrap">
                                                            {{ trans('app.'.$number->static_phonebook_number_type->common_name) }}
                                                            : @if(is_numeric($number->contact_number))
                                                                + @endif {{ $number->contact_number }}
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <span class="btn btn-xs btn-info" data-toggle="modal" data-target="#ajaxmodel"
                                                data-remote="{{ url(Session::get('guard') . '') }}/{{ $user->id }}/user_phonebook/create/{{ $sectiontoreload }}"
                                        >{{ trans('app.add_contact_number') }}</span>
                                    </td>
                                    <td>
                                        <span class="btn btn-primary btn-xs" data-toggle="modal"
                                                data-target="#ajaxmodel"
                                                data-remote="{{ url(Session::get('guard') . '/'.$user->profile_id.'/users/'.$user->id.'/edit') }}/{{ $sectiontoreload }}">{{ trans('app.edit') }}</span>
                                    </td>
                                    <td>
                                        <form role="form" method="POST"
                                              action="{{ url(Session::get('guard') . '/'.$profile->id.'/users/'.$user->id) }}"
                                              id="{{ $user->id }}">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <span class="btn btn-danger btn-xs postconfirm"
                                                    data-title="{{ trans('app.delete_user') }}"
                                                    data-description="{{ trans('app.are_you_sure_you_want_to_delete_the_user') }} {{ ucwords(trans('app.' . $user->prefix)) }} {{ $user->firstname }} {{ $user->lastname }}"
                                                    data-reloaddiv="{{ $sectiontoreload }}"
                                                    data-reloadurl="{{ url(Session::get('guard') . '/'.$profile->id.'/users') }}"
                                                    data-posturl="{{ url(Session::get('guard') . '/'.$profile->id.'/users/'.$user->id) }}">{{ trans('app.delete') }}</span>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>