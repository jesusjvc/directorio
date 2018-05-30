<!-- Form Wizard JavaScript -->
<script src="{{ url('assets') }}/plugins/bower_components/jquery-wizard-master/dist/jquery-wizard.min.js"></script>
<!-- FormValidation -->
<link rel="stylesheet"
      href="{{ url('assets') }}/plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.css">
<!-- FormValidation plugin and the class supports validating Bootstrap form -->
<script src="{{ url('assets') }}/plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.js"></script>
<script src="{{ url('assets') }}/plugins/bower_components/jquery-wizard-master/libs/formvalidation/bootstrap.min.js"></script>


<script type="text/javascript">
    (function () {
        $('#accordion').wizard({
            step: '[data-toggle="collapse"]',

            buttonsAppendTo: '.panel-collapse',

            templates: {
                buttons: function () {
                    var options = this.options;
                    return '<div class="panel-footer"><ul class="pager">' +
                        '<li class="previous">' +
                        '<a href="#' + this.id + '" data-wizard="back" role="button">{{ trans('app.back') }}</a>' +
                        '</li>' +
                        '<li class="next">' +
                        '<a href="#' + this.id + '" data-wizard="next" role="button">{{ trans('app.next') }}</a>' +
                        '<a href="#' + this.id + '" data-wizard="finish" role="button">{{ trans('app.save') }}</a>' +
                        '</li>' +
                        '</ul></div>';
                }
            },

            onInit: function () {
                $('#validation').formValidation({
                    framework: 'bootstrap',
                    fields: {
                        {{--business_name: {--}}
                            {{--validators: {--}}
                                {{--notEmpty: {--}}
                                    {{--message: "{{ trans('validation.the_business_name_is_required') }}"--}}
                                {{--}--}}
                            {{--}--}}
                        {{--},--}}
                        {{--business_email: {--}}
                            {{--validators: {--}}
                                {{--notEmpty: {--}}
                                    {{--message: "{{ trans('validation.an_email_address_is_required') }}"--}}
                                {{--},--}}
                                {{--emailAddress: {--}}
                                    {{--message: "{{ trans('validation.an_email_address_is_required') }}"--}}
                                {{--}--}}
                            {{--}--}}
                        {{--},--}}
                        {{--business_phone: {--}}
                            {{--validators: {--}}
                                {{--notEmpty: {--}}
                                    {{--message: "{{ trans('validation.enter_a_valid_business_phone_number_in_an_international_e164_format_without_starting_with_the_sign') }}"--}}
                                {{--}--}}
                            {{--}--}}
                        {{--},--}}
                        {{--business_url: {--}}
                            {{--validators: {--}}
                                {{--notEmpty: {--}}
                                    {{--message: "{{ trans('validation.enter_a_business_web_address_here_starting_with_http_or_https') }}"--}}
                                {{--}--}}
                            {{--}--}}
                        {{--},--}}
                        {{--default_sms_country_code: {--}}
                            {{--validators: {--}}
                                {{--notEmpty: {--}}
                                    {{--message: "{{ trans('validation.a_default_international_dialing_country_code_is_required') }}"--}}
                                {{--}--}}
                            {{--}--}}
                        {{--},--}}
                        {{--business_address_1: {--}}
                            {{--validators: {--}}
                                {{--notEmpty: {--}}
                                    {{--message: "{{ trans('validation.an_actual_business_address_is_required') }}"--}}
                                {{--}--}}
                            {{--}--}}
                        {{--},--}}
                        /*
                         business_address_2: {
                         validators: {
                         notEmpty: {
                         message: "{{ trans('validation.the_business_name_is_required') }}"
                         }
                         }
                         },
                         */
                        {{--business_city: {--}}
                            {{--validators: {--}}
                                {{--notEmpty: {--}}
                                    {{--message: "{{ trans('validation.an_address_city_is_required') }}"--}}
                                {{--}--}}
                            {{--}--}}
                        {{--},--}}
                        /*
                         business_state: {
                         validators: {
                         notEmpty: {
                         message: "{{ trans('validation.the_business_name_is_required') }}"
                         }
                         }
                         },
                         business_zip: {
                         validators: {
                         notEmpty: {
                         message: "{{ trans('validation.the_business_name_is_required') }}"
                         }
                         }
                         },
                         */
                        {{--business_country: {--}}
                            {{--validators: {--}}
                                {{--notEmpty: {--}}
                                    {{--message: "{{ trans('validation.a_address_country_is_required') }}"--}}
                                {{--}--}}
                            {{--}--}}
                        {{--},--}}
                        {{--default_days_invoice_due: {--}}
                            {{--validators: {--}}
                                {{--notEmpty: {--}}
                                    {{--message: "{{ trans('validation.this_field_is_required_and_may_contain_integer_numbers_only') }}"--}}
                                {{--}--}}
                            {{--}--}}
                        {{--},--}}
                        {{--default_days_quotation_valid: {--}}
                            {{--validators: {--}}
                                {{--notEmpty: {--}}
                                    {{--message: "{{ trans('validation.this_field_is_required_and_may_contain_integer_numbers_only') }}"--}}
                                {{--}--}}
                            {{--}--}}
                        {{--},--}}
                        {{--default_days_contract_expire: {--}}
                            {{--validators: {--}}
                                {{--notEmpty: {--}}
                                    {{--message: "{{ trans('validation.this_field_is_required_and_may_contain_integer_numbers_only') }}"--}}
                                {{--}--}}
                            {{--}--}}
                        {{--},--}}
                        {{--invoice_number_prefix: {--}}
                            {{--validators: {--}}
                                {{--notEmpty: {--}}
                                    {{--message: "{{ trans('validation.this_is_a_required_field') }}"--}}
                                {{--}--}}
                            {{--}--}}
                        {{--},--}}
                        {{--quotation_number_prefix: {--}}
                            {{--validators: {--}}
                                {{--notEmpty: {--}}
                                    {{--message: "{{ trans('validation.this_is_a_required_field') }}"--}}
                                {{--}--}}
                            {{--}--}}
                        {{--},--}}
                        {{--payment_number_prefix: {--}}
                            {{--validators: {--}}
                                {{--notEmpty: {--}}
                                    {{--message: "{{ trans('validation.this_is_a_required_field') }}"--}}
                                {{--}--}}
                            {{--}--}}
                        {{--},--}}
                        {{--credit_note_number_prefix: {--}}
                            {{--validators: {--}}
                                {{--notEmpty: {--}}
                                    {{--message: "{{ trans('validation.this_is_a_required_field') }}"--}}
                                {{--}--}}
                            {{--}--}}
                        {{--},--}}
                        {{--subscription_number_prefix: {--}}
                            {{--validators: {--}}
                                {{--notEmpty: {--}}
                                    {{--message: "{{ trans('validation.this_is_a_required_field') }}"--}}
                                {{--}--}}
                            {{--}--}}
                        {{--},--}}
                        /*
                         tax_enabled: {
                         validators: {
                         notEmpty: {
                         message: "{{ trans('validation.the_business_name_is_required') }}"
                         }
                         }
                         },
                         taxvat_number: {
                         validators: {
                         notEmpty: {
                         message: "{{ trans('validation.the_business_name_is_required') }}"
                         }
                         }
                         },
                         disable_online_payments: {
                         validators: {
                         notEmpty: {
                         message: "{{ trans('validation.the_business_name_is_required') }}"
                         }
                         }
                         },
                         show_total_customer_balance_on_documents: {
                         validators: {
                         notEmpty: {
                         message: "{{ trans('validation.the_business_name_is_required') }}"
                         }
                         }
                         },
                         autoconvert_accepted_quotations_to_invoice: {
                         validators: {
                         notEmpty: {
                         message: "{{ trans('validation.the_business_name_is_required') }}"
                         }
                         }
                         },
                         */
                        {{--default_invoice_text: {--}}
                            {{--validators: {--}}
                                {{--notEmpty: {--}}
                                    {{--message: "{{ trans('validation.this_is_a_required_field') }}"--}}
                                {{--}--}}
                            {{--}--}}
                        {{--},--}}
                        {{--default_quotation_text: {--}}
                            {{--validators: {--}}
                                {{--notEmpty: {--}}
                                    {{--message: "{{ trans('validation.this_is_a_required_field') }}"--}}
                                {{--}--}}
                            {{--}--}}
                        {{--},--}}
                        {{--default_credit_note_text: {--}}
                            {{--validators: {--}}
                                {{--notEmpty: {--}}
                                    {{--message: "{{ trans('validation.this_is_a_required_field') }}"--}}
                                {{--}--}}
                            {{--}--}}
                        {{--},--}}
                        /*
                         file: {
                         validators: {
                         notEmpty: {
                         message: "{{ trans('validation.the_business_name_is_required') }}"
                         }
                         }
                         },
                         */
                        {{--timezone: {--}}
                            {{--validators: {--}}
                                {{--notEmpty: {--}}
                                    {{--message: "{{ trans('validation.this_is_a_required_field') }}"--}}
                                {{--}--}}
                            {{--}--}}
                        {{--},--}}
                        {{--duration_to_show_flash_messages: {--}}
                            {{--validators: {--}}
                                {{--notEmpty: {--}}
                                    {{--message: "{{ trans('validation.this_field_is_required_and_may_contain_integer_numbers_only') }}"--}}
                                {{--}--}}
                            {{--}--}}
                        {{--},--}}
                        {{--paper_size: {--}}
                            {{--validators: {--}}
                                {{--notEmpty: {--}}
                                    {{--message: "{{ trans('validation.the_business_name_is_required') }}"--}}
                                {{--}--}}
                            {{--}--}}
                        {{--},--}}
                        /*
                         xxxx: {
                         validators: {
                         notEmpty: {
                         message: 'The username is required'
                         },
                         stringLength: {
                         min: 6,
                         max: 30,
                         message: 'The username must be more than 6 and less than 30 characters long'
                         },
                         regexp: {
                         regexp: /^[a-zA-Z0-9_\.]+$/,
                         message: 'The username can only consist of alphabetical, number, dot and underscore'
                         }
                         }
                         },
                         email: {
                         validators: {
                         notEmpty: {
                         message: 'The email address is required'
                         },
                         emailAddress: {
                         message: 'The input is not a valid email address'
                         }
                         }
                         },
                         password: {
                         validators: {
                         notEmpty: {
                         message: 'The password is required'
                         },
                         different: {
                         field: 'username',
                         message: 'The password cannot be the same as username'
                         }
                         }
                         }
                         */
                    }
                });
            },
            validator: function () {
                var fv = $('#validation').data('formValidation');

                var $this = $(this);

                // Validate the container
                fv.validateContainer($this);

                var isValidStep = fv.isValidContainer($this);
                if (isValidStep === false || isValidStep === null) {
                    return false;
                }

                return true;
            },

            onBeforeShow: function (step) {
                step.$pane.collapse('show');
            },

            onBeforeHide: function (step) {
                step.$pane.collapse('hide');
            },

            onFinish: function () {
                document.getElementById('validation').submit();
            }
        });
    })();
</script>

<script src="{{ url('assets') }}/plugins/bower_components/dropify/dist/js/dropify.min.js"></script>
<script>
    $(document).ready(function () {
        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function (event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function (event, element) {
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function (event, element) {
            console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function (e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
</script>