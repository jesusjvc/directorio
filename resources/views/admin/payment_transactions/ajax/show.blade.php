<div class="modalhide">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{ trans('app.transaction_information') }} <small>#{{ $profile->profile_billing->payment_number_prefix }} {{ $payment->payment_no }}</small></h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <dl>
                    <dt>{{ trans('app.transaction_status') }}</dt>
                    <dd>{{ $textStatus }}</dd>
                    <dt>{{ trans('app.date_processed') }}</dt>
                    <dd>{{ $payment->payment_date }}</dd>
                    <dt>{{ trans('app.amount_processed') }}</dt>
                    <dd>{{ number_format($payment->total_amount,2) }}{{ $profile->profile_billing->default_currency }}</dd>
                    <dt>{{ trans('app.description') }}</dt>
                    <dd>{{ $payment->description }}</dd>
                    <dt>{{ trans('app.user_ip_address') }}</dt>
                    <dd>{{ $payment->payment_transaction->ip_address }}</dd>
                    @if($payment->profile_customer != null)
                        <dt>{{ trans('app.profile_customer') }}</dt>
                        <dd>
                            #{{ $payment->profile_customer->account_number }}
                            {{ $payment->profile_customer->business_name }}
                            : {{ $payment->profile_customer->business_email }}
                        </dd>
                    @endif
                    @if($payment->customer != null)
                        <dt>{{ trans('app.customer') }}</dt>
                        <dd>{{ ucwords($payment->customer->prefix . ' ' . $payment->customer->firstname . ' ' . $payment->customer->lastname) }}
                            : {{ $payment->customer->email }}</dd>
                    @endif
                    <dt>{{ trans('app.payment_gateway') }}</dt>
                    <dd>{{ $payment->payment_gateway->payment_method_name }}</dd>
                    @if($payment->invoice != null)
                        <dt>{{ trans('app.invoice') }}</dt>
                        <dd>{{ $profile->profile_billing->invoice_number_prefix }} {{ $payment->invoice->invoice_no }}</dd>
                    @endif
                    @if(($payment->payment_transaction != null) && ($payment->payment_transaction->key != null))
                        <dt>{{ trans('app.key') }}</dt>
                        <dd>{{ $payment->payment_transaction->key }}</dd>
                    @endif
                </dl>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
    </div>
</div>