@php
    $sectiontoreload = mt_rand(10000,99999)
@endphp
<div class="{{ $sectiontoreload }}">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.profile') }} {{ trans('app.professionals') }}
                    <div class="pull-right">
                        <span class="btn btn-xs btn-success" data-toggle="modal" data-target="#ajaxmodel"
                              data-remote="{{ url(Session::get('guard') . '/' . $profile->id . '/professionals/create/' . $sectiontoreload) }}">
                            {{ trans('app.register_a_new_professional') }}
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
                                        &nbsp;{{ trans('app.branches') }}
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
                                            <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/professionals/' . $user->id . '/send_mail') }}"
                                               class="fetchajaxpage"
                                               title="{{ trans('app.send_an_email_to_customer_names',["customer_names" => ucwords(trans('app.' . $user->prefix) . ' ' . $user->firstname . ' ' . $user->lastname)]) }}">
                                                <i class="fa fa-envelope"></i>
                                            </a>
                                            {{ $user->email }}
                                        </td>
                                        <td>
                                            @if(is_numeric($user->mobile_no))
                                                @if (Session::get('app_settings')->disable_sms == 0)
                                                <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/professionals/' . $user->id . '/send_sms') }}"
                                                   class="fetchajaxpage" style="margin-right:5px;"
                                                   title="{{ trans('app.send_a_sms_to_customer_names',["customer_names" => ucwords(trans('app.' . $user->prefix) . ' ' . $user->firstname . ' ' . $user->lastname)]) }}">
                                                    <i class="fa fa-comments-o"></i>
                                                </a>
                                                @endif
                                                +{{ $user->mobile_no }}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="oneline m-t-5">
                                                @if($user->agenda->branches->count() == 0)
                                        <span class="btn btn-primary btn-xs" data-toggle="modal"
                                              data-target="#ajaxmodel"
                                              data-remote="{{ url(Session::get('guard') . '/' . $user->profile_id . '/professionals/' . $user->id . '/linkbranch') }}">{{ trans('app.link') }}
                                        </span>
                                                <span class="btn btn-danger btn-xs">
                                                    {{ trans('app.no_branches_linked') }}
                                                </span>
                                                    @else
                                                    <span class="btn btn-primary btn-xs" data-toggle="modal"
                                                          data-target="#ajaxmodel"
                                                          data-remote="{{ url(Session::get('guard') . '/' . $user->profile_id . '/professionals/' . $user->id . '/linkbranch') }}">{{ trans('app.link_more') }}
                                        </span>
                                                @endif
                                            </div>
                                            @if($user->agenda->branches->count() > 0)
                                            @foreach($user->agenda->branches as $branch)
                                            <div class="oneline m-t-5">
                                                <span class="btn btn-default btn-xs">
                                                    {{ $branch->branch_name }}
                                                </span>
                                            <span class="btn btn-danger btn-xs postconfirm"
                                                  data-title="{{ trans('app.revoke_branch_access') }}"
                                                  data-description="{{ trans('app.are_you_sure_you_want_to_revoke_access_from_usernames_to_the_branch_branchname_if_you_revoke_access_no_appointments_will_be_able_to_be_scheduled_for_usernames_at_branchname_however_existing_appointments_can_still_be_viewed_and_honored', ["branchname" => $branch->branch_name, "usernames" => ucwords(trans('app.' . $user->prefix) . ' ' . $user->firstname . ' ' . $user->lastname)]) }}"
                                                  data-reloaddiv="{{ $sectiontoreload }}"
                                                  data-reloadurl="{{ url(Session::get('guard') . '/'.$profile->id.'/professionals') }}"
                                                  data-posturl="{{ url(Session::get('guard') . '/'.$profile->id.'/professionals/' . $user->id . '/revoke_branch/' . $branch->id) }}">{{ trans('app.revoke') }}
                                                </span>
                                                @endforeach
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                        <span class="btn btn-primary btn-xs" data-toggle="modal"
                                              data-target="#ajaxmodel"
                                              data-remote="{{ url(Session::get('guard') . '/'.$user->profile_id.'/professionals/'.$user->id.'/edit') }}/{{ $sectiontoreload }}">{{ trans('app.edit') }}</span>
                                        </td>
                                        <td>
                                            <form role="form" method="POST"
                                                  action="{{ url(Session::get('guard') . '/'.$profile->id.'/professionals/'.$user->id) }}"
                                                  id="{{ $user->id }}">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <span class="btn btn-danger btn-xs postconfirm"
                                                      data-title="{{ trans('app.delete_user') }}"
                                                      data-description="{{ trans('app.are_you_sure_you_want_to_delete_this_professional_all_agenda_data_and_appointments_related_to_this_professional_will_be_deleted_forever') }}"
                                                      data-reloaddiv="{{ $sectiontoreload }}"
                                                      data-reloadurl="{{ url(Session::get('guard') . '/'.$profile->id.'/professionals') }}"
                                                      data-posturl="{{ url(Session::get('guard') . '/'.$profile->id.'/professionals/'.$user->id) }}">{{ trans('app.delete') }}
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