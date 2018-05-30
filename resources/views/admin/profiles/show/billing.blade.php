@php
    $sectiontoreload = mt_rand(10000,99999)
@endphp
<div class="{{ $sectiontoreload }}">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.billing_configuration') }}
                    <div class="pull-right">
                        <a href="{{ url(Session::get('guard') . '/'.$profile->id.'/profile_billing/edit') }}">
                            <span class="btn btn-xs btn-success">
                                {{ trans('app.edit') }}
                            </span>
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                    <div>
                        <ul class="linelist col-md-6">
                            <li>
						<span>{{ trans('app.default_currency') }}:
						</span>
                                @if($currency->name != $currency->code)
                                    {{ $currency->code }} /
                                @endif
                                {{ $currency->name }}
                            </li>
                            <li>
						<span>{{ trans('app.show_total_customer_account_balance_on_documents') }}:
						</span> {{ CustomHelper::booleanToYesNo($profile->profile_billing->show_total_customer_balance_on_documents) }}
                            </li>
                            <li>
						<span>{{ trans('app.auto_create_invoices_for_accepted_quotations') }}:
						</span> {{ CustomHelper::booleanToYesNo($profile->profile_billing->autoconvert_accepted_quotatios_to_invoice) }}
                            </li>
                            <li>
						<span>{{ trans('app.online_payments_are_disabled') }}:
						</span> {{ CustomHelper::booleanToYesNo($profile->profile_billing->disable_online_payments) }}
                            </li>
                            <li>
						<span>{{ trans('app.invoices_become_due_in') }}:
						</span> {{ $profile->profile_billing->default_days_invoice_due }} {{ trans_choice('app.day', $profile->profile_billing->default_days_invoice_due) }}
                                <small>{{ trans('app.default_value') }}</small>
                            </li>
                            <li>
						<span>{{ trans('app.quotations_is_valid_for') }}:
						</span> {{ $profile->profile_billing->default_days_quotation_valid }} {{ trans_choice('app.day', $profile->profile_billing->default_days_quotation_valid) }}
                                <small>{{ trans('app.default_value') }}</small>
                            </li>
                            <li>
						<span>{{ trans('app.contracts_expire_in') }}:
						</span> {{ $profile->profile_billing->default_days_contract_expire }} {{ trans_choice('app.day', $profile->profile_billing->default_days_contract_expire) }}
                                <small>{{ trans('app.default_value') }}</small>
                            </li>
                        </ul>
                        <ul class="linelist col-md-6">
                            <li>
						<span>{{ trans('app.taxvat_number') }}:
						</span> {{ $profile->profile_billing->tax_number }}
                            </li>
                            @if($profile->profile_billing->tax_personal_name != null)
                                <li>
						<span>{{ trans('app.personal_name') }}:
						</span> {{ $profile->profile_billing->tax_personal_name }}
                                </li>
                            @endif
                            <li>
						<span>{{ trans('app.invoice_number_prefix') }}:
						</span> {{ $profile->profile_billing->invoice_number_prefix }}
                            </li>
                            <li>
						<span>{{ trans('app.quotation_number_prefix') }}:
						</span> {{ $profile->profile_billing->quotation_number_prefix }}
                            </li>
                            <li>
						<span>{{ trans('app.payment_number_prefix') }}:
						</span> {{ $profile->profile_billing->payment_number_prefix }}
                            </li>
                            <li>
						<span>{{ trans('app.cash_receipt_number_prefix') }}:
						</span> {{ $profile->profile_billing->cash_receipt_number_prefix }}
                            </li>
                            <li>
						<span>{{ trans('app.credit_note_number_prefix') }}:
						</span> {{ $profile->profile_billing->credit_note_number_prefix }}
                            </li>
                            <li>
						<span>{{ trans('app.subscription_number_prefix') }}:
						</span> {{ $profile->profile_billing->subscription_number_prefix }}
                            </li>
                        </ul>
                        <div class="clearfix">
                        </div>
                        <hr>
                        <p class="text-center"><i>{{ trans('descriptions.long_billing_footer_text_can_be_edited') }}</i>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>