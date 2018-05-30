<div class="reload">
    <div class="panel-body">
        <div class="text-center">
            <a href="{{ url(Session::get('guard') . '/contracts/template/' . $contract->contract_template->id) }}"
               class="fetchajaxpage">
                    <span class="btn btn-xs btn-primary">
                        {{ trans('app.go_back_to_contracts') }}
                    </span>
            </a>
        </div>
        <br>
        <h4 class="text-center">{{ $contract->title }}
            <br>
            <small>
                @if(($contract->status == 2) && ($contract->electronic_signature_token != null) && ($contract->electronic_signature_token->electronic_signature_archive != null))
                    {{ trans('app.this_documenttype_was_signed_by_signedbywho_on_datewhensigned',["documenttype" => strtolower(trans('app.static_contract')), "signedbywho" => ucwords($contract->electronic_signature_token->electronic_signature_archive->signed_by_names) . ' (' . $contract->electronic_signature_token->electronic_signature_archive->ip_address . ')', "datewhensigned" => CustomHelper::dateLong($contract->electronic_signature_token->electronic_signature_archive->created_at)]) }}
                @elseif(($contract->status == 1) && ($contract->electronic_signature_token != null) && ($contract->electronic_signature_token->expiry_date < date('Y-m-d')))
                    {{ trans('app.this_contract_has_expired_on_date', ["date" => CustomHelper::dateLong($contract->electronic_signature_token->expiry_date)]) }}
                @elseif(($contract->status == 1) && ($contract->electronic_signature_token != null) && ($contract->electronic_signature_token->expiry_date >= date('Y-m-d')))
                    {{ trans('app.expires_on_date', ["date" => CustomHelper::dateLong($contract->electronic_signature_token->expiry_date)]) }}
                @endif
            </small>
        </h4>
        <hr>
        {!! $contract_body !!}
    </div>
</div>