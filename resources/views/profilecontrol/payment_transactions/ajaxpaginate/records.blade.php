<section class="records">
    <div class="reload" id="ajaxpaginateblock">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.payment_transactions') }}
                        @php
                            $createlink = url(Session::get('guard') . '/payments/create/');
                        if(($class == 'CustomersController') && ($customer != null)):
                            $createlink = url(Session::get('guard') . '/payments/create/c' . $customer->id);
                        endif;
                        if(($class == 'ProfilesController') && ($profile != null)):
                            $createlink = url(Session::get('guard') . '/payments/create/p' . $profile->id);
                        endif;
                        @endphp
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th class="text-left">
                                        {{ trans('app.date') }}
                                    </th>
                                    <th class="text-left">
                                        {{ trans('app.status') }}
                                    </th>
                                    <th class="text-left">
                                        {{ trans('app.payment_gateway') }}
                                    </th>
                                    <th class="text-left">
                                        {{ trans('app.payment') }}
                                    </th>
                                    <th class="text-left">
                                        {{ trans('app.description') }}
                                    </th>
                                </tr>
                                </thead>
                                @if(count($payment_transactions) > 0)
                                    <tbody>
                                    @foreach ($payment_transactions as $payment_transaction)
                                        <tr>
                                            <td>
                                                {{ $payment_transaction->created_at }}
                                            </td>
                                            <td>
                                                {{ $payment_transaction->status }}
                                            </td>
                                            <td>
                                                @if($payment_transaction->payment_gateway != null)
                                                    {{ $payment_transaction->payment_gateway->payment_method_name }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($payment_transaction->payment != null)
                                                    #{{ $profile->profile_billing->payment_number_prefix }}{{ $payment_transaction->payment->payment_no }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ $payment_transaction->description }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                @endif
                            </table>
                        </div>
                        <div class="panel-footer">
                            <div class="text-center">
                                @if((count($payment_transactions) == 0) && (last(explode('/',url()->current())) != 'search'))
                                    {{ trans('app.no_data_found') }}
                                @endif
                            </div>
                            @if(method_exists($payment_transactions,'links'))
                                <div align="center">
                                    @if($payment_transactions->links())
                                        <div align="center">
                                            {{ $payment_transactions->links() }}
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