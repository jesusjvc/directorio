<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>{{ trans('app.default_amount_of_days_for_when_an_invoice_becomes_due') }} <span
                        class="required"> * </span></label>
            <div class="input-group">
                <input name="default_days_invoice_due" type="number" min="0" class="form-control"
                       value="{{ $profile_billing->default_days_invoice_due }}" required>
                <div class="input-group-addon">{{ trans_choice('app.day',0) }}</div>
            </div>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>{{ trans('app.default_amount_of_days_a_quotation_is_valid_for') }} <span
                        class="required"> * </span></label>
            <div class="input-group">
                <input name="default_days_quotation_valid" type="number" min="0"
                       value="{{ $profile_billing->default_days_quotation_valid }}"
                       class="form-control" required>
                <div class="input-group-addon">{{ trans_choice('app.day',0) }}</div>
            </div>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>{{ trans('app.default_amount_of_days_a_contract_is_set_to_expire') }} <span
                        class="required"> * </span></label>
            <div class="input-group">
                <input name="default_days_contract_expire" type="number" min="0"
                       value="{{ $profile_billing->default_days_contract_expire }}"
                       class="form-control" required>
                <div class="input-group-addon">{{ trans_choice('app.day',0) }}</div>
            </div>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-12">
        <hr>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ trans('app.invoice_number_prefix') }} <span class="required"> * </span></label>
            <input type="text" maxlength="50" name="invoice_number_prefix" class="form-control"
                   value="{{ $profile_billing->invoice_number_prefix }}" required>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ trans('app.quotation_number_prefix') }} <span class="required"> * </span></label>
            <input type="text" maxlength="50" name="quotation_number_prefix" class="form-control"
                   value="{{ $profile_billing->quotation_number_prefix }}" required>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ trans('app.payment_number_prefix') }} <span class="required"> * </span></label>
            <input type="text" maxlength="50" name="payment_number_prefix" class="form-control"
                   value="{{ $profile_billing->payment_number_prefix }}" required>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ trans('app.cash_receipt_number_prefix') }} <span class="required"> * </span></label>
            <input type="text" maxlength="50" name="cash_receipt_number_prefix" class="form-control"
                   value="{{ $profile_billing->cash_receipt_number_prefix }}" required>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ trans('app.credit_note_number_prefix') }} <span class="required"> * </span></label>
            <input type="text" maxlength="50" name="credit_note_number_prefix" class="form-control"
                   value="{{ $profile_billing->credit_note_number_prefix }}" required>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ trans('app.subscription_number_prefix') }} <span class="required"> * </span></label>
            <input type="text" maxlength="50" name="subscription_number_prefix" class="form-control"
                   value="{{ $profile_billing->subscription_number_prefix }}" required>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="col-md-12">
        <h4>{{ trans('app.tax_configuration') }}</h4>
        <hr>
    </div>
    <div class="col-md-12">
        {{--<div class="form-group">--}}
            {{--<div>--}}
                {{--<label>--}}
                    {{--<input name="tax_enabled" value="1"--}}
                           {{--type="checkbox"--}}
                           {{--@if($profile_billing->tax_enabled == 1) checked @endif> {{ trans('app.enable_taxvat_for_this_profile') }}--}}
                {{--</label>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="form-group">
            <label>{{ trans('app.taxvat_number') }} </label>
            <input type="text" maxlength="50" name="tax_number" value="{{ $profile_billing->tax_number }}"
                   class="form-control">
        </div>
        <div class="form-group">
            <label>{{ trans('app.personal_name') }} <small><i>{{ trans('app.optional') }}: {{ trans('app.complete_only_if_you_want_a_customised_personal_name_to_be_displayed_under_your_business_name_on_financial_documents') }}</i></small></label>
            <input type="text" maxlength="100" name="tax_personal_name" value="{{ $profile_billing->tax_personal_name }}" class="form-control">
        </div>
        <div class="form-group">
            <label>{{ trans('app.custom_footer_on_financial_documents') }} <small><i>{{ trans('app.optional') }}</i></small></label>
            <input type="text" maxlength="170" name="custom_financial_footer" value="{{ $profile_billing->custom_financial_footer }}" class="form-control">
        </div>
    </div>
    <div class="col-md-12">
        <h4>{{ trans('app.general_options') }}</h4>
        <hr>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{--<div>--}}
                {{--<label>--}}
                    {{--<input name="disable_online_payments" value="1"--}}
                           {{--type="checkbox"--}}
                           {{--@if($profile_billing->disable_online_payments == 1) checked @endif> {{ trans('app.disable_online_payments_processing') }}--}}
                {{--</label>--}}
            {{--</div>--}}
            {{--<div>--}}
                {{--<label>--}}
                    {{--<input name="show_total_customer_balance_on_documents" value="1"--}}
                           {{--type="checkbox"--}}
                           {{--@if($profile_billing->show_total_customer_balance_on_documents == 1) checked @endif> {{ trans('app.show_total_customer_account_balance_on_documents') }}--}}
                {{--</label>--}}
            {{--</div>--}}
            <div>
                <label>
                    <input name="autoconvert_accepted_quotations_to_invoice" value="1"
                           type="checkbox"
                           @if($profile_billing->autoconvert_accepted_quotations_to_invoice == 1) checked @endif> {{ trans('app.auto_create_invoices_for_accepted_quotations') }}
                </label>
            </div>
            <div>
                <label>
                    <input name="display_draft_invoice_as_pro_forma_invoice" value="1"
                           type="checkbox"
                           @if($profile_billing->display_draft_invoice_as_pro_forma_invoice == 1) checked @endif> {{ trans('app.display_draft_invoices_as_pro_forma') }}
                </label>
            </div>
        </div>
    </div>
    <hr>
    <div class="col-md-12">
        <h4>{{ trans('app.default_footer_text') }}</h4>
        <hr>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>{{ trans('app.default_invoice_footer_text') }}</label>
            <textarea class="form-control summernote" id="summernote" name="default_invoice_text"
                      rows="10">{{ $profile_billing->default_invoice_text }}</textarea>
        </div>
    </div>
    <hr>
    <div class="col-md-12">
        <div class="form-group">
            <label>{{ trans('app.default_quotation_footer_text') }}</label>
            <textarea class="form-control summernote" id="summernote" name="default_quotation_text"
                      rows="10">{{ $profile_billing->default_quotation_text }}</textarea>
        </div>
    </div>
    <hr>
    <div class="col-md-12">
        <div class="form-group">
            <label>{{ trans('app.default_credit_note_footer_text') }}</label>
            <textarea class="form-control summernote" id="summernote" name="default_credit_note_text"
                      rows="10">{{ $profile_billing->default_credit_note_text }}</textarea>
        </div>
    </div>
</div>