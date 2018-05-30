<div class="reload">
    <div class="panel-body">
        @if($configurations->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>
                            {{ trans('app.gateway_provider') }}
                        </th>
                        <th>{{ trans('app.nickname') }}
                        </th>
                        <th>{{ trans('app.balance') }}
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
                        <th>
                            &nbsp;
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
                    @foreach($configurations as $configuration)
                        <tr>
                            <td>{{ strtoupper($configuration->static_sms_provider->sms_gateway_provider) }}
                            </td>
                            <td>{{ $configuration->configuration_nickname }}
                            </td>
                            <td>{{ $remotedata[$configuration->id]['balance'] }}
                            </td>
                            <td class="text-right">
                                <span class="btn btn-primary btn-xs" data-toggle="modal" data-target="#ajaxmodel"
                                      data-remote="{{ url(Session::get('guard') . '/sms_provider_configurations/'.$configuration->id.'/edit') }}">{{ trans('app.edit') }}</span>
                            </td>
                            <td class="text-right">
                                @if($configuration->isdefault != 1)
                                    <span class="btn btn-danger btn-xs postconfirm"
                                          data-title="{{ trans('app.delete_gateway_configuration') }}"
                                          data-description="{{ trans('app.are_you_sure_you_want_to_delete_the_gateway_configuration_gatewayname_all_linked_did_numbers_will_remain_in_the_database_with_an_inactive_status',["gatewayname" => "<i>$configuration->configuration_nickname</i>"]) }}"
                                          data-reloadurl="{{ url(Session::get('guard') . '/sms_provider_configurations') }}"
                                          data-posturl="{{ url(Session::get('guard') . '/sms_provider_configurations/'.$configuration->id) }}">{{ trans('app.delete') }}</span>
                                @endif
                            </td>
                            <td class="text-right">
                                @if($configuration->isdefault != 1)
                                    <span class="btn btn-primary btn-xs confirmajaxpost"
                                          data-title="{{ trans('app.set_as_default') }}"
                                          data-description="{{ trans('app.are_you_sure_you_want_to_set_this_configuration_as_the_default_sms_voice_gateway_configuration') }}"
                                          data-posturl="{{ url(Session::get('guard') . '/sms_provider_configurations/'.$configuration->id.'/setasdefault') }}"
                                          data-reloadurl="{{ url(Session::get('guard') . '/sms_provider_configurations') }}">{{ trans('app.set_as_default') }}</span>
                                @endif
                            </td>
                            <td class="text-right">
                                <span class="btn btn-success btn-xs" data-toggle="modal" data-target="#ajaxmodel"
                                      data-remote="{{ url(Session::get('guard') . '/sms_provider_configurations/'.$configuration->id.'/validate_connection') }}">{{ trans('app.send_test_sms') }}</span>
                            </td>
                            <td class="text-right">
                                @if($configuration->static_sms_provider->mono != 1)
                                    <span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#ajaxmodel"
                                          data-remote="{{ url(Session::get('guard') . '/sv_gateway_providers/'.$configuration->id.'/buy_numbers') }}">{{ trans('app.buy_numbers') }}</span>
                                @endif
                            </td>
                            <td class="text-right">
                                @if($configuration->static_sms_provider->sms_gateway_provider == 'nexmo')
                                    <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#ajaxmodel"
                                            data-remote="{{ url(Session::get('guard') . '/sv_gateway_providers/' . $configuration->id . '/cancel_numbers') }}">{{ trans('app.cancel_numbers') }}</button>
                                @endif
                            </td>
                            <td class="text-right">
                                @if($configuration->static_sms_provider->mono != 1)
                                    <span class="btn btn-danger btn-xs confirmajaxpost"
                                          data-title="{{ trans('app.sync_with_gateway') }}"
                                          data-description="{{ trans('app.you_are_about_to_sync_your_local_did_numbers_with_the_selected_gateway_provider') }}"
                                          data-posturl="{{ url(Session::get('guard') . '/sms_provider_configurations/'.$configuration->id.'/sync') }}"
                                          data-reloadurl="{{ url(Session::get('guard') . '/sms_provider_configurations') }}">{{ trans('app.sync') }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            {{ trans('app.no_data_found') }}
        @endif
    </div>
</div>