@php
    $sectiontoreload = 'reload';
@endphp
<div class="{{ $sectiontoreload }}">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.profile') }} {{ trans('app.reception_access') }}
                    <div class="pull-right">
                        <span class="btn btn-xs btn-success" data-toggle="modal" data-target="#ajaxmodel"
                              data-remote="{{ url(Session::get('guard') . '/' . $profile->id . '/receptions/create/' . $sectiontoreload) }}">
                            {{ trans('app.register_a_new_reception_user') }}
                        </span>
                    </div>
                </div>
                <div class="panel-body">
                    @if(count($users) > 0)
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
                                        <td>
                                            <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/receptions/' . $user->id . '/send_mail') }}"
                                               class="fetchajaxpage"
                                               title="{{ trans('app.send_an_email_to_customer_names',["customer_names" => ucwords(trans('app.' . $user->prefix) . ' ' . $user->firstname . ' ' . $user->lastname)]) }}">
                                                <i class="fa fa-envelope"></i>
                                            </a>
                                            {{ $user->email }}
                                        </td>
                                        <td>
                                            @if(is_numeric($user->mobile_no))
                                                @if (Session::get('app_settings')->disable_sms == 0)
                                                <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/receptions/' . $user->id . '/send_sms') }}"
                                                   class="fetchajaxpage" style="margin-right:5px;"
                                                   title="{{ trans('app.send_a_sms_to_customer_names',["customer_names" => ucwords(trans('app.' . $user->prefix) . ' ' . $user->firstname . ' ' . $user->lastname)]) }}">
                                                    <i class="fa fa-comments-o"></i>
                                                </a>
                                                @endif
                                                +{{ $user->mobile_no }}
                                            @endif
                                        </td>
                                        <td>
                                        <span class="btn btn-primary btn-xs" data-toggle="modal"
                                              data-target="#ajaxmodel"
                                              data-remote="{{ url(Session::get('guard') . '/'.$user->profile_id.'/receptions/'.$user->id.'/edit') }}/{{ $sectiontoreload }}">{{ trans('app.edit') }}</span>
                                        </td>
                                        <td>
                                            <form role="form" method="POST"
                                                  action="{{ url(Session::get('guard') . '/'.$profile->id.'/receptions/'.$user->id) }}"
                                                  id="{{ $user->id }}">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <span class="btn btn-danger btn-xs postconfirm"
                                                      data-title="{{ trans('app.delete_user') }}"
                                                      data-description="{{ trans('app.are_you_sure_you_want_to_delete_this_reception_user') }}"
                                                      data-reloaddiv="{{ $sectiontoreload }}"
                                                      data-reloadurl="{{ url(Session::get('guard') . '/'.$profile->id.'/receptions') }}"
                                                      data-posturl="{{ url(Session::get('guard') . '/'.$profile->id.'/receptions/'.$user->id) }}">{{ trans('app.delete') }}
                                                </span>
                                            </form>
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