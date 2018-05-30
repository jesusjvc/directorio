<div class="reload">
    <form role="form" method="POST" action="{{ url(Session::get('guard') . '/location_planner') }}"
          id="idForm" reloadiv="reload"
          reloadurl="{{ url(Session::get('guard') . '/location_planner') }}">
        {{ csrf_field() }}
        <div class="panel-body">
            @if(count($branches) > 1)
            <p class="text-muted">
                {{ trans('app.take_note_that_you_can_update_this_schedule_as_frequently_as_you_want_and_that_it_will_not_affect_appointments_already_scheduled') }}
            </p>
            <hr>
            @endif
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            <strong>
                                {{ trans('app.date') }}
                            </strong>
                        </th>
                        @foreach($branches as $branch)
                            <th class="text-center">
                                <strong>
                                {{ $branch->branch_name }}
                                </strong>
                            </th>
                        @endforeach
                        <th class="text-center">
                            <strong>
                                {{ trans('app.not_bookable') }}
                            </strong>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dateArray as $instance)
                    <tr>
                        <td>{!! $instance['date'] !!}</td>
                        @foreach($branches as $branch)
                        <td>
                            <div class="radio radio-info text-center">
                                <input type="radio" name="array[{{ $instance['id'] }}]"
                                       id="{{ $branch->id }}_{{ $instance['id'] }}"
                                       value="{{ $branch->id }}_{{ $instance['date_default'] }}" @if(in_array($user->agenda->id . '-' . $branch->id . '-' . $instance['date_default'],$exist)) checked @endif >
                                <label for="{{ $branch->id }}_{{ $instance['id'] }}"> </label>
                            </div>
                        </td>
                        @endforeach
                        <td>
                            <div class="radio radio-info text-center">
                                <input type="radio" name="array[{{ $instance['id'] }}]"
                                       id="0_{{ $instance['id'] }}"
                                       value="0_{{ $instance['date_default'] }}" @if(in_array($user->agenda->id . '-0-' . $instance['date_default'],$exist)) checked @endif >
                                <label for="0_{{ $instance['id'] }}"> </label>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-footer text-right">
            <button class="btn btn-info" type="submit"> {{ trans('app.save') }}
            </button>
        </div>
    </form>
</div>