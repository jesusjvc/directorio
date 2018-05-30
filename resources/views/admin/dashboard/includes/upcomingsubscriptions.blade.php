<div class="col-md-12 col-lg-12 col-sm-12">
    <div class="white-box">
        <h3 class="box-title">
            {{ trans('app.saas_and_direct_customer_subscriptions') }}
        </h3>
        <div class="row sales-report">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <h2>{{ trans('app.upcoming_subscriptions') }}</h2>
                <p>{{ trans('app.calculations_based_on_the_next_due_date') }}</p>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 ">
                <h1 class="text-right text-success m-t-20">{{ Session::get('profile_settings')->profile_billing->default_currency }} {{ number_format($subscriptiontotal,2) }}</h1>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table ">
                <thead>
                <tr>

                    <th>{{ trans('app.subscription_no') }}</th>
                    <th>{{ trans('app.customer') }}</th>
                    <th>{{ trans('app.interval') }}</th>
                    <th>{{ trans('app.next_bill_date') }}</th>
                    <th>{{ trans('app.tax') }}</th>
                    <th class="text-right">{{ trans('app.total_amount') }}
                        <small>{{ trans('app.incl') }}</small>
                    </th>
                </tr>
                </thead>
                <tbody>
                @if(count($subscriptions) > 0)
                    @foreach($subscriptions as $subscription)
                        <tr>

                            <td class="txt-oflo">
                                #{{ Session::get('profile_settings')->profile_billing->subscription_number_prefix }}{{ $subscription->subscription_no }}</td>
                            <td class="txt-oflo">
                                @if($subscription->customer != null)
                                    {{ trans('app.customer') }}:
                                    {{ ucwords(trans('app.' . $subscription->customer->prefix) . ' ' . $subscription->customer->firstname . ' ' . $subscription->customer->lastname) }}
                                @elseif($subscription->profile_customer != null)
                                    {{ trans('app.saas_customer') }}: {{ $subscription->profile_customer->business_name }}
                                @endif
                            </td>
                            <td>{{ trans('app.' . $subscription->interval) }}</td>
                            <td>{{ $subscription->next_bill_date }}</td>
                            <td>{{ $subscription->tax_configuration->percentage }}%</td>
                            <td class="text-right">{{ number_format($subscription->total_amount,2) }}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
    </div>
</div>
