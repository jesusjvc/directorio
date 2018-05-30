@php
    if(isset($profile)):
    $modifylink = $profile->id . '/profile_did_numbers';
    else:
    $modifylink = 'system_did';
    endif;
@endphp
<div class="reload">
    <div class="panel-body">
        <p class="text-muted">
            {{ trans('descriptions.did_defaults') }}
        </p>
        <hr>
        @if($dids->count() > 0)
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
                            {{ trans('app.messages_processed') }}
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
                                <span class="label label-info">{{ $did->sms_logs->count() }}</span>
                            </td>
                            <td class="text-center">
                                <span class="btn btn-primary btn-xs confirmajaxpost"
                                      data-title="{{ trans('app.release_this_number') }}"
                                      data-description="{{ trans('app.are_you_sure_you_want_to_release_the_number_didnumber_and_make_it_available_again',['didnumber' => '<i>+' . $did->did_number . '</i>']) }}"
                                      data-posturl="{{ url(Session::get('guard') . '/' . $modifylink . '/'.$did->id.'/release') }}"
                                      data-reloadurl="{{ url(Session::get('guard') . '/' . $modifylink . '') }}">{{ trans('app.release') }}</span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            @if(isset($profile))
                {{ trans('app.profilename_has_no_did_numbers_assigned',["profilename" => $profile->business_name]) }}
                {{ trans('app.in_order_to_assign_a_did_number_to_a_profile_a_sell_per_month_value_must_be_set_and_be_greater_than_zero') }}
                @else
            {{ trans('app.your_system_has_no_inbound_numbers_assigned') }}
                @endif
        @endif
    </div>
</div>
<div class="loadjs">
    @if (Request::ajax())
        <script type="text/javascript">
            $(document).ready(function () {
                $(".select2").select2();
            });
        </script>
    @endif
</div>