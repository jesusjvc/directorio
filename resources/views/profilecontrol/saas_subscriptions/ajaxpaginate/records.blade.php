<section class="records">
    <div class="reload" id="ajaxpaginateblock">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.subscriptions') }}
                    </div>
                    <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="text-center oneline">
                                            #
                                        </th>
                                        <th class="text-left oneline">
                                            {{ trans('app.interval') }}
                                        </th>
                                        <th class="text-left oneline">
                                            {{ trans('app.start_date') }}
                                        </th>
                                        <th class="text-left oneline">
                                            {{ trans('app.next_bill_date') }}
                                        </th>
                                        <th class="text-left oneline">
                                            {{ trans('app.end_date') }}
                                        </th>
                                        <th class="text-center oneline">
                                            {{ trans('app.currency') }}
                                        </th>
                                        <th class="text-center oneline">
                                            {{ trans('app.tax') }}
                                        </th>
                                        <th class="text-right oneline">
                                            {{ trans('app.total_homecurrency',["homecurrency" => Session::get('profile_settings')->profile_billing->default_currency]) }}
                                            <small>{{ trans('app.incl') }}</small>
                                        </th>
                                    </tr>
                                    </thead>
                                    @if(count($subscriptions) > 0)
                                        <tbody>
                                        @foreach ($subscriptions as $subscription)
                                            <tr>
                                                <td class="text-center">
                                                    #{{ $profile->profile_billing->subscription_number_prefix }}{{ $subscription->subscription_no }}
                                                </td>
                                                <td class="text-left">
                                                    {{ trans('app.' . $subscription->interval) }}
                                                </td>
                                                <td class="text-left">
                                                    {{ $subscription->start_date }}
                                                </td>
                                                <td class="text-left">
                                                    @if($subscription->status == "active")
                                                        {{ $subscription->next_bill_date }}
                                                    @endif
                                                </td>
                                                <td class="text-left">
                                                    {{ $subscription->end_date }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $subscription->currency }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $subscription->tax_configuration->percentage }}%
                                                </td>
                                                <td class="text-right">
                                                    {{ number_format($subscription->total_amount,2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    @endif
                                </table>
                            </div>
                        <div class="panel-footer">
                            @if(method_exists($subscriptions,'links'))
                                <div align="center">
                                    @if($subscriptions->links())
                                        <div align="center">
                                            {{ $subscriptions->links() }}
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