<div class="reload" id="ajaxpaginateblock">
    <div class="panel panel-default">
        <div class="panel-heading">
            @if($reschedule == null)
                    {{ trans('app.schedule_an_appointment_at_publicname_for_date', ["publicname"  =>  ucwords(trans('app.' . $agenda->user->prefix) . ' ' . $agenda->user->firstname . ' ' . $agenda->user->lastname), "date"  =>  CustomHelper::dateTimeShort(date('Y-m-d H:i:s', $timeslot))]) }}
            @else
                {{ trans('app.select_a_branch') }}
                <br>
                <small>
                    {{ trans('app.reschedule_appointment_reference_at_publicname_to_date', ["reference"  =>  $reschedule, "publicname"  =>  ucwords(trans('app.' . $agenda->user->prefix) . ' ' . $agenda->user->firstname . ' ' . $agenda->user->lastname), "date"  =>  CustomHelper::dateTimeShort(date('Y-m-d H:i:s', $timeslot))]) }}
                </small>
            @endif
            <div class="pull-right">
                <a href="{{ url('profilecontrol/appointments/' . $agenda->sharecode) }}">
                            <span class="btn btn-xs btn-primary">
                            {{ trans('app.cancel_and_go_back') }}
                            </span>
                </a>
            </div>
        </div>
        <div class="panel-body">
            @if(count($agenda->branches) > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-left">
                                {{ trans('app.branch_name') }}
                            </th>
                            <th class="text-left">
                                {{ trans('app.map_address') }}
                            </th>
                            <th class="text-left">

                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($agenda->branches as $branch)
                            <tr>
                                <td class="text-left">
                                    {{ $branch->branch_name }}
                                </td>
                                <td class="text-left">
                                    {{ $branch->map_address }}
                                </td>
                                <td class="text-left">
                                    <a href="{{ url(Session::get('guard') . '/appointments/' . $agenda->id . '/slot/' . $branch->id . '/' . $timeslot . '/customer/' . $customer->id . '/' . $reschedule) }}"
                                       class="fetchajaxpage"
                                       title="{{ $branch->branch_name }}">
                                                    <span class="btn btn-outline btn-info btn-xs">
                                                        {{ trans('app.select_branch') }}
                                                    </span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>
                    {{ trans('app.no_branches_exist_unable_to_proceed') }}
                </p>
            @endif
        </div>
    </div>
</div>