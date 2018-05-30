<section class="records">
    <div class="reload" id="ajaxpaginateblock">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.did_numbers') }}
                        <div class="pull-right">
                            <span class="btn btn-xs btn-warning" data-toggle="collapse" data-target="#collapse"
                                  aria-expanded="false" aria-controls="collapse">
                                {!! trans('app.did_numbers_explained') !!}
                            </span>
                            <span class="btn btn-xs btn-success" data-toggle="modal" data-target="#ajaxmodel"
                                  data-remote="{{ url('profilecontrol/did_numbers/buy') }}">
                            {{ trans('app.buy_a_did_number') }}
                        </span>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="collapse" id="collapse">
                            <p class="text-muted">
                                {{ trans('descriptions.did_defaults_profile') }}
                            </p>
                            <p class="text-muted">
                                {{ trans('descriptions.did_defaults') }}
                            </p>
                            <hr>
                        </div>
                        @if($hasmono == 1)
                        <p class="text-muted">
                            {{ trans('app.obtaining_a_did_number_for_your_account_is_optional_and_sms_text_messages_will_be_sent_via_the_systems_default_gateway_however_call_will_not_be_processed') }}
                        </p>
                        <hr>
                        @endif
                        {{--<p class="text-muted">--}}
                            {{--{{ trans('app.showing_did_numbers_assigned_to_profilename_only_and_not_did_numbers_assigned_to_branches_branch_did_can_be_viewed_from_the_branch_management_section', ["profilename" => $profile->business_name]) }}--}}
                        {{--</p>--}}
                        {{--<p class="text-muted">--}}
                            {{--{{ trans('app.it_is_important_to_take_note_that_assigning_a_did_number_to_a_branch_is_optional_messages_and_calls_will_be_processed_via_the_profile_did_number_by_default_unless_a_did_number_is_assigned_to_a_specific_branch_therefore_having_at_least_one_did_number_assigned_to_your_profile_account_is_crucial') }}--}}
                        {{--</p>--}}
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>
                                        {{ trans('app.did_number') }}
                                    </th>
                                    <th>
                                        {{ trans('app.capabilities') }}
                                    </th>
                                    <th>
                                        {{ trans('app.gateway_provider') }}
                                    </th>
                                    <th class="text-center">

                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($dids as $did)
                                    <tr>
                                        <td @if ($did->status == 0) style="text-decoration: line-through" @endif>
                                            +{{ $did->did_number }}
                                        </td>
                                        <td>
                                            {{ $did->features }}
                                        </td>
                                        <td>
                                            {{ strtoupper($did->static_sms_provider->sms_gateway_provider) }}
                                        </td>
                                        <td class="text-center">
                                <span class="btn btn-primary btn-xs confirmajaxpost"
                                      data-title="{{ trans('app.release_this_number') }}"
                                      data-description="{{ trans('app.are_you_sure_you_want_to_release_the_number_didnumber_and_make_it_available_again',['didnumber' => '<i>+' . $did->did_number . '</i>']) }}"
                                      data-posturl="{{ url(Session::get('guard') . '/did_numbers/'.$did->id.'/release') }}"
                                      data-reloadurl="{{ url(Session::get('guard') . '/did_numbers') }}">{{ trans('app.release') }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer">
                            @if(method_exists($dids,'links'))
                                <div align="center">
                                    @if($dids->links())
                                        <div align="center">
                                            {{ $dids->links() }}
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>