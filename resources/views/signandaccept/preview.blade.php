@extends('signandaccept.layout') @section('content')
    <style>
        .hidden-div {
            display: none
        }
    </style>
    <form role="form" method="POST" action="{{ url('/signandaccept/accept/' . $token->token) }}">
        {{ csrf_field() }}
        <input type="hidden" name="signed_by_names" value="{{ $signed_by_names }}">
        <input type="hidden" name="token" value="{{ $token->token }}">
        <div>
            @if($token->customer != null)
                @if($token->quotation != null)
                    {{ trans('app.i_customernames_hereby_accepts_quotation_quoteno_as_legally_binding_i_furthermore_accepts_and_agree_to_the_quotation_terms_and_conditions_as_presented_on_the_last_page_of_the_quotation_document',["customernames" => ucwords($signed_by_names), "quoteno" => $token->quotation->profile->profile_billing->quotation_number_prefix . $token->quotation->quotation_no]) }}
                @elseif($token->contract != null)
                    {{ trans('app.i_customernames_hereby_accepts_the_contract_titled_title_as_legally_binding',["customernames" => ucwords($signed_by_names), "title" => $token->contract->title]) }}
                @elseif($token->static_contract != null)
                    {{ trans('app.i_customernames_hereby_accepts_the_contract_titled_title_as_legally_binding',["customernames" => ucwords($signed_by_names), "title" => $token->static_contract->title]) }}
                @endif
            @elseif($token->user != null)
                @if($token->quotation != null)
                    {{ trans('app.i_customernames_hereby_accepts_quotation_quoteno_as_legally_binding_i_furthermore_accepts_and_agree_to_the_quotation_terms_and_conditions_as_presented_on_the_last_page_of_the_quotation_document',["customernames" => ucwords($signed_by_names), "quoteno" => $token->quotation->profile->profile_billing->quotation_number_prefix . $token->quotation->quotation_no]) }}
                @elseif($token->contract != null)
                    {{ trans('app.i_customernames_hereby_accepts_the_contract_titled_title_as_legally_binding',["customernames" => ucwords($signed_by_names), "title" => $token->contract->title]) }}
                @elseif($token->static_contract != null)
                    {{ trans('app.i_customernames_hereby_accepts_the_contract_titled_title_as_legally_binding',["customernames" => ucwords($signed_by_names), "title" => $token->static_contract->title]) }}
                @endif
            @elseif($token->profile_customer != null)
                @if($token->quotation != null)
                    {{ trans('app.i_signed_by_names_authorized_representative_of_profile_hereby_accepts_quotation_quoteno_as_legally_binding_i_furthermore_accepts_and_agree_to_the_quotation_terms_and_conditions_as_presented_on_the_last_page_of_the_quotation_document',["signed_by_names" => $signed_by_names, "profile" => ucwords($token->profile_customer->business_name), "quoteno" => $token->quotation->profile->profile_billing->quotation_number_prefix . $token->quotation->quotation_no]) }}
                @elseif($token->contract != null)
                    {{ trans('app.i_signed_by_names_authorized_representative_of_profile_hereby_accepts_the_contract_titled_title_as_legally_binding',["signed_by_names" => $signed_by_names, "profile" => ucwords($token->profile_customer->business_name), "title" => $token->contract->title]) }}
                @elseif($token->static_contract != null)
                    {{ trans('app.i_signed_by_names_authorized_representative_of_profile_hereby_accepts_the_contract_titled_title_as_legally_binding',["signed_by_names" => $signed_by_names, "profile" => ucwords($token->profile_customer->business_name), "title" => $token->static_contract->title]) }}
                @endif
            @endif
        </div>
        <hr>
        <div class="text-center" id="accept">
            <button type="submit" class="btn btn-primary">{{ trans('app.accept') }}</button>
        </div>
    </form>
    <script type="text/javascript">
        var button = document.getElementById('accept')
        button.addEventListener('click', hideshow, true);

        function hideshow() {
            document.getElementById('accept').style.display = 'block';
            this.style.display = 'none';
        }
    </script>
@endsection