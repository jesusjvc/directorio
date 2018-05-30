<div class="reload">
    <form role="form" method="POST" action="{{ url(Session::get('guard') . '/app_settings') }}" id="idForm">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="panel-body">
            <h4>{{ trans('app.general_settings') }}</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="checkbox">
                            <input type="checkbox" value="1" id="login_show_background_image"
                                   name="login_show_background_image"
                                   @if(Session::get('app_settings')->login_show_background_image == 1) checked @endif>
                            <label for="login_show_background_image">
                                {{ trans('app.show_background_image_on_login_pages') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="checkbox">
                            <input type="checkbox" value="1" id="show_system_footer_on_pdf"
                                   name="show_system_footer_on_pdf"
                                   @if(Session::get('app_settings')->show_system_footer_on_pdf == 1) checked @endif>
                            <label for="show_system_footer_on_pdf">
                                {{ trans('app.show_the_application_name_in_pdf_document_footers') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="checkbox">
                            <input type="checkbox" value="1" id="automated_email_invoice_on_lock"
                                   name="automated_email_invoice_on_lock"
                                   @if(Session::get('app_settings')->automated_email_invoice_on_lock == 1) checked @endif>
                            <label for="automated_email_invoice_on_lock">
                                {{ trans('app.automatically_email_an_invoice_when_locked') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="checkbox">
                            <input type="checkbox" value="1" id="automated_email_payment_on_lock"
                                   name="automated_email_payment_on_lock"
                                   @if(Session::get('app_settings')->automated_email_payment_on_lock == 1) checked @endif>
                            <label for="automated_email_payment_on_lock">
                                {{ trans('app.automatically_email_a_payment_when_locked') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="checkbox">
                            <input type="checkbox" value="1" id="automated_email_credit_note_on_lock"
                                   name="automated_email_credit_note_on_lock"
                                   @if(Session::get('app_settings')->automated_email_credit_note_on_lock == 1) checked @endif>
                            <label for="automated_email_credit_note_on_lock">
                                {{ trans('app.automatically_email_a_credit_note_when_locked') }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <h4>{{ trans('app.pagination_and_log_limits') }}</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.default_ajax_pagination_count') }} <span
                                    class="required"> * </span></label>
                        <input type="number" min="1" max="50" maxlength="100" name="default_pagination_count"
                               value="{{ Session::get('app_settings')->default_pagination_count }}" class="form-control"
                               required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.limit_log_results') }} <span
                                    class="required"> * </span></label>
                        <input type="number" min="1" maxlength="100" name="limit_log_results"
                               value="{{ Session::get('app_settings')->limit_log_results }}" class="form-control"
                               required>
                    </div>
                </div>
            </div>
            <hr>
            <h4>{{ trans('app.upload_settings') }}
                <small><i>({{ trans('app.php_limit') }} {{ CustomHelper::digitsOnly(ini_get("upload_max_filesize")) }}
                        MB)</i></small>
            </h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ trans('app.allowable_file_formats') }} <i>{{ trans('app.comma_separated') }}</i> <span
                                    class="required"> * </span></label>
                        <input type="text" maxlength="100" name="file_allowable_file_formats"
                               value="{{ Session::get('app_settings')->file_allowable_file_formats }}"
                               class="form-control"
                               required>
                    </div>
                </div>
            </div>

            <hr>
            <h4>{{ trans('app.general_notification_settings') }}</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="system_notifications_mail_address">{{ trans('app.email_address_for_system_notifications') }}
                            <span class="required"> * </span></label>
                        <input type="email" class="form-control" name="system_notifications_mail_address"
                               value="{{ Session::get('app_settings')->system_notifications_mail_address }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="default_days_contracts_to_expire">{{ trans('app.default_days_for_contract_to_expire') }}
                            <span class="required"> * </span>
                        </label>
                        <div class="input-group">
                            <input type="number" step="1" min="1" class="form-control"
                                   name="default_days_contracts_to_expire"
                                   value="{{ Session::get('app_settings')->default_days_contracts_to_expire }}"
                                   required>
                            <div class="input-group-addon">{{ trans('app.days') }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="default_days_signature_tokens_to_expire">{{ trans('app.default_days_for_electronic_signature_tokens_to_expire') }}
                            <span class="required"> * </span>
                        </label>
                        <div class="input-group">
                            <input type="number" step="1" min="1" class="form-control"
                                   name="default_days_signature_tokens_to_expire"
                                   value="{{ Session::get('app_settings')->default_days_signature_tokens_to_expire }}"
                                   required>
                            <div class="input-group-addon">{{ trans('app.days') }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sms_provider_balance_threshold_notification">{{ trans('app.smsvoice_provider_balance_threshold_to_notify_system') }}
                            <span class="required"> * </span>
                            <small><i>{{ trans('app.if_supported_by_the_provider') }}</i></small>
                        </label>
                        <div class="input-group">
                            <input type="number" step="0.01" class="form-control"
                                   name="sms_provider_balance_threshold_notification"
                                   value="{{ round(Session::get('app_settings')->sms_provider_balance_threshold_notification,2) }}"
                                   required>
                            <div class="input-group-addon">{{ Session::get('profile_settings')->profile_billing->default_currency }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="profile_airtime_balance_threshold_notification">{{ trans('app.profile_airtime_balance_threshold_to_notify_profile') }}
                            <span class="required"> * </span>
                        </label>
                        <div class="input-group">
                            <input type="number" step="0.01" class="form-control"
                                   name="profile_airtime_balance_threshold_notification"
                                   value="{{ round(Session::get('app_settings')->profile_airtime_balance_threshold_notification,2) }}"
                                   required>
                            <div class="input-group-addon">{{ Session::get('profile_settings')->profile_billing->default_currency }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ trans('app.time_to_process_scheduled_notifications') }} <span
                                    class="required"> * </span></label>
                        <select class="form-control" name="time_to_process_scheduled_notifications" required>
                            @for ($x = 0; $x <= 23; $x++)
                                @php if($x < 10): $c = 0 . $x; else: $c = $x; endif; @endphp
                                <option value="{{ $c }}:00"
                                        @if(Session::get('app_settings')->time_to_process_scheduled_notifications == $c . ':00') selected
                                        @endif>
                                    {{ $c }}:00
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>

            <hr>
            <h4>{{ trans('app.api_keys') }}</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="google_api_key">{{ trans('app.google_api_key') }}
                            <span class="required"> * </span></label>
                        <input type="text" class="form-control" name="google_api_key"
                               value="{{ Session::get('app_settings')->google_api_key }}" required>
                    </div>
                </div>
            </div>

            <hr>

            <h4>{{ trans('app.disable_voice_or_sms_functions') }}</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="checkbox">
                            <input type="checkbox" value="1" id="disable_sms"
                                   name="disable_sms"
                                   @if(Session::get('app_settings')->disable_sms == 1) checked @endif>
                            <label for="disable_sms">
                                {{ trans('app.disable_sms_voice_call_functionality_from_the_system') }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <h4>{{ trans('app.alternative_landing_url') }}</h4>

            <p class="text-muted">
                {{ trans('app.only_add_a_fully_qualified_domain_name_here_if_you_want_to_bypass_the_search_portal',["example" => url('/profilecontrol')]) }}
            </p>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="alternative_landing_page">{{ trans('app.alternative_landing_url') }}
                        </label>
                        <input type="text" class="form-control" name="alternative_landing_page" placeholder="{{ url('/') }}"
                               value="{{ Session::get('app_settings')->alternative_landing_page }}">
                    </div>
                </div>
            </div>

            <hr>

            <h4>{{ trans('app.license_key') }}</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="license_key">{{ trans('app.license_key_purchase_code') }}
                            <span class="required"> * </span></label>
                        <input type="text" class="form-control" name="license_key"
                               value="{{ Session::get('app_settings')->license_key }}" required>
                    </div>
                </div>
            </div>

            <hr>

            <h4>{{ trans('app.footer_block') }}</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ trans('app.footer_block') }}</label>
                        <textarea class="form-control" name="footer_block" rows="10">{!! Session::get('app_settings')->footer_block !!}</textarea>
                    </div>
                </div>
            </div>

        </div>
        <div class="panel-footer text-right">
            <button class="btn btn-primary">{{ trans('app.save') }}</button>
        </div>
    </form>
</div>