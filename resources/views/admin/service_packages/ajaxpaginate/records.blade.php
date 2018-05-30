<div class="reload">
    <div class="panel-body">

        <div class="collapse" id="collapse">
            <div class="text-muted">{!! trans('descriptions.service_package') !!}</div>
            <hr>
        </div>

        @if($subscription_packages->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>
                            {{ trans('app.package_name') }}
                        </th>
                        <th class="text-center">
                            {{ trans('app.admin_only') }}
                        </th>
                        <th class="text-center">
                            {{ trans('app.expiry_days') }}
                        </th>
                        <th class="text-right">
                            &nbsp;{{ trans('app.customer_limit') }}
                        </th>
                        <th class="text-right">
                            &nbsp;{{ trans('app.professionals_limit') }}
                        </th>
                        <th class="text-right">
                            &nbsp;{{ trans('app.charge_profile') }}
                        </th>
                        <th class="text-center">
                            &nbsp;{{ trans('app.subscriptions') }}
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
                    @foreach($subscription_packages as $package)
                        <tr>
                            <td>
                                <span class="btn btn-outline btn-primary btn-xs" data-toggle="modal" data-target="#ajaxmodel"
                                      data-remote="{{ url(Session::get('guard') . '/service_packages/'.$package->id.'/show') }}">
                                {{ $package->name }}
                                </span>
                            </td>
                            <td class="text-center">
                                {{ CustomHelper::booleanToYesNo($package->adminonly) }}
                            </td>
                            <td class="text-center">
                                {{ $package->expire_in_x_days }}
                            </td>
                            <td class="text-center">
                                @if($package->limit_customer_accounts == 0) {{ trans('app.unlimited') }} @else {{ $package->limit_customer_accounts }} @endif
                            </td>
                            <td class="text-center">
                                @if($package->limit_professional_accounts == 0) {{ trans('app.unlimited') }} @else {{ $package->limit_professional_accounts }} @endif
                            </td>
                            <td class="text-right">
                                &nbsp;{{ number_format($package->monthly_charge_per_profile,2) }}
                            </td>
                            <td class="text-center">
                                &nbsp;<span class="label label-info">{{ $package->subscription_items->count() }}</span>
                            </td>
                            <td class="text-right">
                                <span class="btn btn-primary btn-xs" data-toggle="modal" data-target="#ajaxmodel"
                                      data-remote="{{ url(Session::get('guard') . '/service_packages/'.$package->id.'/edit') }}">{{ trans('app.edit') }}</span>
                            </td>
                            <td class="text-right">
                                <span class="btn btn-danger btn-xs postconfirm"
                                      data-title="{{ trans('app.delete_subscription_package') }}"
                                      data-description="{{ trans('app.are_you_sure_you_want_to_delete_the_subscription_package_package',["package" => $package->name]) }}"
                                      data-reloadurl="{{ url(Session::get('guard') . '/service_packages') }}"
                                      data-posturl="{{ url(Session::get('guard') . '/service_packages/'.$package->id) }}">{{ trans('app.delete') }}</span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                @if(method_exists($subscription_packages,'links'))
                    <div align="center">
                        @if($subscription_packages->links())
                            <div align="center">
                                {{ $subscription_packages->links() }}
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        @else
            {{ trans('app.no_data_found') }}
        @endif
    </div>
</div>