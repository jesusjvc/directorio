<div class="reload">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.branch') }}: {{ $branch->branch_name }}
                    <div class="pull-right">
                        <a href="{{ url(Session::get('guard') . '/' . $profile->id . '/branches/' . $branch->id) }}"
                           class="fetchajaxpage">
                                    <span class="btn btn-xs btn-primary">
                                        {{ trans('app.go_back') }}
                                    </span>
                        </a>
                        <span class="btn btn-success btn-xs" data-toggle="modal" data-target="#ajaxmodel"
                              data-remote="{{ url(Session::get('guard') . '/' . $profile->id . '/did_number/' . $branch->id . '/purchase') }}">{{ trans('app.buy_a_number') }}
                                </span>
                    </div>
                </div>
                <div class="panel-body">
                    <p class="text-muted">
                        {{ trans('app.when_processing_voice_calls_the_system_will_look_for_the_first_available_assigned_did_number_that_is_voice_enabled_when_processing_sms_text_message_the_system_will_look_for_the_first_available_assigned_did_number_that_is_sms_enabled_thus_if_your_country_supports_two_types_of_virtual_numbers_which_are_either_voice_or_sms_capable_you_can_assign_two_numbers_one_for_voice_calls_and_one_for_sms_texts') }}
                    </p>
                    <hr>
                    @if(count($branch->app_sms_did_numbers) == 0)
                    <h4>{{ trans('app.did_numbers') }}</h4>
                        <p>{{ trans('app.branchname_has_no_did_numbers_assigned', ["branchname" => $branch->branch_name]) }}</p>
                    @else
                        @foreach($branch->app_sms_did_numbers as $number)
                            <p>
                            <span class="btn btn-danger btn-xs postconfirm"
                                      data-title="{{ trans('app.release_did_number') }}"
                                      data-description="{{ trans('app.are_you_sure_you_want_to_revoke_the_did_number_number_from_the_branch_branchname',["number" => '+' . $number->did_number, "branchname" => $branch->branch_name]) }}"
                                      data-reloadurl="{{ url(Session::get('guard') . '/' . $profile->id . '/did_number/' . $branch->id) }}"
                                      data-posturl="{{ url(Session::get('guard') . '/' . $profile->id . '/did_number/' . $branch->id . '/release/' . $number->id) }}">{{ trans('app.release_did_number') }}</span>
                            {{ trans('app.number_is_assigned_to_branchname_with_the_capabilities_capabilities', ["branchname" => $branch->branch_name, "number" => '+'.$number->did_number, "capabilities" => $number->features]) }}</p>
                        @endforeach
                    @endif
                </div>
                <div class="panel-footer text-right">

                </div>
            </div>
        </div>
    </div>
</div>