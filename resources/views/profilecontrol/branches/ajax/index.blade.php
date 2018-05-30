<div class="reload">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.profile') }} {{ trans('app.branches') }}
                    <div class="pull-right">
                        {{--<span class="btn btn-xs btn-success" data-toggle="modal" data-target="#ajaxmodel"--}}
                        {{--data-remote="{{ url(Session::get('guard')) }}/branches/create">--}}
                        {{--{{ trans('app.register_a_new_branch') }}--}}
                        {{--</span>--}}
                        <a class="btn btn-xs btn-success"
                           href="{{ url(Session::get('guard')) }}/branches/create">
                            {{ trans('app.register_a_new_branch') }}
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                    @if(count($profile->users) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>
                                        {{ trans('app.branch_name') }}
                                    </th>
                                    {{--<th>--}}
                                        {{--{{ trans('app.did_numbers') }}--}}
                                    {{--</th>--}}
                                    <th>
                                        {{ trans('app.formatted_address') }}
                                    </th>
                                    <th>
                                        {{ trans('app.latitude') }}
                                    </th>
                                    <th>
                                        {{ trans('app.longitude') }}
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
                                @foreach($profile->branches as $branch)
                                    <tr>
                                        <td>
                                            {{ $branch->branch_name }}
                                        </td>
                                        {{--<td>--}}
                                            {{--@if(count($branch->app_sms_did_numbers) > 0)--}}
                                                {{--@foreach($branch->app_sms_did_numbers as $number)--}}
                                                    {{--<div>--}}
                                                        {{--+{{ $number->did_number }}--}}
                                                    {{--</div>--}}
                                                {{--@endforeach--}}
                                            {{--@endif--}}
                                        {{--</td>--}}
                                        <td>
                                            {{ $branch->map_address }}
                                        </td>
                                        <td>
                                            {{ $branch->latitude }}
                                        </td>
                                        <td>
                                            {{ $branch->longitude }}
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-xs fetchajaxpage"
                                               href="{{ url(Session::get('guard') . '/branches/' . $branch->id) }}">{{ trans('app.view') }}</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-xs"
                                               href="{{ url(Session::get('guard') . '/branches/' . $branch->id . '/edit') }}">{{ trans('app.edit') }}</a>
                                        </td>
                                        <td>
                                            <span class="btn btn-danger btn-xs postconfirm"
                                                  data-title="{{ trans('app.delete_user') }}"
                                                  data-description="{{ trans('app.are_you_sure_you_want_to_delete_the_branch_branchname_branches_can_only_be_deleted_if_there_are_no_users_dependent_on_a_branch_entry', ["branchname" => $branch->branch_name]) }}"
                                                  data-reloadurl="{{ url(Session::get('guard') . '/branches') }}"
                                                  data-posturl="{{ url(Session::get('guard') . '/branches/'.$branch->id) }}">{{ trans('app.delete') }}</span>
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