@if(count($quotation->quotation_items) > 0)
    <div class="panel-footer text-right">
        <a href="{{ url(Session::get('guard') . '/quotations/' . $quotation->id . '/download') }}" target="_blank">
            <span class="btn btn-info btn-sm ">{{ trans('app.download') }}</span>
        </a>
        <a href="{{ url(Session::get('guard') . '/quotations/' . $quotation->id . '/preview') }}" target="_blank">
            <span class="btn btn-info btn-sm">{{ trans('app.preview_print') }}</span>
        </a>
        <span class="btn btn-info btn-sm postconfirm" data-title="{{ trans('app.email_quotation') }}"
              data-description="{{  trans('app.do_you_want_to_email_this_quotation') }}"
              data-reloaddiv="reload"
              data-reloadurl="{{ url(Session::get('guard') . '/quotations/' . $quotation->id . '/items') }}"
              data-posturl="{{ url(Session::get('guard') . '/quotations/' . $quotation->id . '/email') }}">
                        {{ trans('app.email') }}
                        </span>
        @if($quotation->status == 0)
            <span class="btn btn-info btn-sm postconfirm"
                  data-title="{{ trans('app.request_electronic_acceptance') }}"
                  data-description="{!! trans('app.do_you_want_to_request_an_electronic_signature_for_quotation_quoteno_this_quotation_together_with_easy_instructions_on_how_to_electronically_accept_this_quotation_will_be_included_in_the_email',["quoteno" => "<strong>" . $quotation->profile->profile_billing->quotation_number_prefix . $quotation->quotation_no . "</strong>"]) !!} {{ trans('app.take_note_that_an_electronic_signature_request_can_not_be_initiated_after_an_invoice_was_generated_from_a_quotation') }}"
                  data-reloadurl="{{ url(Session::get('guard') . '/quotations/' . $quotation->id . '/items') }}"
                  data-redirect="{{ url(Session::get('guard') . '/quotations') }}"
                  data-posturl="{{ url(Session::get('guard') . '/quotations/' . $quotation->id . '/request_signature') }}">{{ trans('app.request_electronic_acceptance') }}
        </span>
        @endif
        @if(($quotation->status == 0) || ($quotation->status == 2))
            <span class="btn btn-info btn-sm postconfirm"
                  data-title="{{ trans('app.create_an_invoice') }}"
                  data-description="{!! trans('app.are_you_sure_you_want_to_create_an_invoice_based_on_quotation_quoteno_for_you_being_more_in_control_the_auto_generated_invoice_will_not_be_automatically_emailed_to_the_customer',["quoteno" => "<strong>" . $quotation->profile->profile_billing->quotation_number_prefix . $quotation->quotation_no . "</strong>"]) !!}"
                  data-reloadurl="{{ url(Session::get('guard') . '/quotations/' . $quotation->id . '/items') }}"
                  data-redirect="{{ url(Session::get('guard') . '/invoices') }}"
                  data-posturl="{{ url(Session::get('guard') . '/quotations/' . $quotation->id . '/quotationtoinvoice') }}">{{ trans('app.create_an_invoice') }}
        </span>
        @endif
    </div>
@endif