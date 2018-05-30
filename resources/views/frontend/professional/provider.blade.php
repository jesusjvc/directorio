@if(Auth::guard('customer')->user() == null)
    <div style="padding:30px;"></div>
@endif
<div class="row">
    <div class="col-md-3 col-xs-12">
        @include('frontend.professional.sidepanel')
    </div>
    <div class="col-md-9 col-xs-12">
        <div class="white-box">
            <h4>{{ trans('app.more_about_provider',["provider" => ucwords($professional->firstname . ' ' . $professional->lastname)]) }}</h4>
            {!! $professional->professional_profile->description !!}
            <hr>
            <h4>{{ trans('app.schedule_an_appointment') }}</h4>
            @foreach($agenda->branches as $branch)
                <h5 class="m-t-15" style="font-weight:400;">{{ $branch->branch_name }}</h5>

                @if((isset($branch->location_planner)) && ($branch->location_planner != null) && (count($branch->location_planner) > 0))
                    <form role="form" method="POST"
                          action="{{ url('/' . str_slug($professional->firstname . ' ' . $professional->lastname) . '/' . $agenda->sharecode . '.html') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-9">
                                    <select class="form-control" name="slot" required>
                                        <option value="" selected="selected">{{ trans('app.select_a_day') }}</option>
                                        @foreach($branch->location_planner as $instance)
                                            <option value="{{ $branch->id }}_{{ $agenda->sharecode }}_{{ $instance->date }}">{!! CustomHelper::frontendDate($instance->date) !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">
                                        {{ trans('app.schedule_appointment') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                @else
                    <p class="text-muted">
                        {{ trans('app.branchname_is_currently_unable_to_schedule_appointments_for_providernames', ["branchname" => $branch->branch_name, "providernames" => ucwords(trans('app.' . $professional->prefix) . ' ' . $professional->firstname . ' ' . $professional->lastname)]) }}
                    </p>
                @endif
            @endforeach
            <hr>
            <h4>{{ trans('app.branches') }}</h4>
            @foreach($agenda->branches as $branch)
                <address>
                    <strong>{{ $branch->branch_name }}</strong>
                    <br>
                    {{ $branch->map_address }}
                </address>
                <hr style="border-style: dashed;">
            @endforeach
            @if($map != null)
                {!! $map['html'] !!}
            @endif
        </div>
    </div>
</div>