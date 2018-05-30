<div class="reload">
    <div class="panel-body">
        <div class="text-center">
            <a href="{{ url(Session::get('guard') . '/contract_templates') }}" class="fetchajaxpage">
                    <span class="btn btn-xs btn-primary">
                        {{ trans('app.go_back_to_templates') }}
                    </span>
            </a>
        </div>
        @if($contracts->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="oneline">
                            {{ trans('app.contract_title') }}
                        </th>
                        <th class="oneline">
                            {{ trans('app.status') }}
                        </th>
                        <th class="oneline">
                            {{ trans('app.assigned_to') }}
                        </th>
                        <th class="oneline">
                            &nbsp;{{ trans('app.token_expiration') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                        <th>
                            &nbsp;
                        </th>
                        <th>
                            &nbsp;
                        </th>
                        <th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contracts as $contract)
                        <tr>
                            <td class="text-left oneline">
                                @if($contract->status == 1)
                                    <a class="postconfirm hand tableicon"
                                       data-title="{{ trans('app.cancel_signature_request') }}"
                                       title="{{ trans('app.cancel_signature_request') }}"
                                       data-description="{{  trans('app.are_you_sure_you_want_to_revoke_the_electronic_signature_request_for_this_contract') }}"
                                       data-reloaddiv="reload"
                                       data-reloadurl="{{ url(Session::get('guard') . '/contracts/template/' . $contract->contract_template->id) }}"
                                       data-posturl="{{ url(Session::get('guard') . '/contracts/' . $contract->id . '/revoke_signature_request') }}">
                                        <i class="fa fa-times-circle"></i>
                                    </a>
                                @endif
                                {{ $contract->title }}
                                @if(($contract->status == 1) && ($contract->electronic_signature_token != null) && ($contract->electronic_signature_token->expiry_date < date('Y-m-d')))
                                    <span class="badge badge-danger">{{ trans('app.expired') }}</span>
                                @endif
                            </td>
                            <td class="text-left oneline">
                                @if(($contract->status == 2) && ($contract->electronic_signature_token != null) && ($contract->electronic_signature_token->electronic_signature_archive != null))
                                    <span class="showSwal hand"
                                          data-title="{{ trans('app.signature_confirmation') }}"
                                          data-description="{{ trans('app.this_documenttype_was_signed_by_signedbywho_on_datewhensigned',["documenttype" => strtolower(trans('app.static_contract')), "signedbywho" => ucwords($contract->electronic_signature_token->electronic_signature_archive->signed_by_names) . ' (' . $contract->electronic_signature_token->electronic_signature_archive->ip_address . ')', "datewhensigned" => CustomHelper::dateLong($contract->electronic_signature_token->electronic_signature_archive->created_at)]) }}"
                                    ><i class="fa fa-pencil-square"></i></span>
                                @endif
                                {{ $contract->textStatus }}
                            </td>
                            <td class="text-left oneline">
                                @if($contract->user != null)
                                    {{ trans('app.user') }}
                                    : {{ ucwords($contract->user->prefix . ' ' . $contract->user->firstname . ' ' . $contract->user->lastname) }}
                                @elseif($contract->customer != null)
                                    {{ trans('app.customer') }}:  {{ ucwords($contract->customer->prefix . ' ' .
    $contract->customer->firstname . ' ' . $contract->customer->lastname) }}
                                @elseif($contract->profile_customer != null)
                                    {{ trans('app.profile') }}: {{ $contract->profile_customer->business_name }}
                                @endif
                            </td>
                            <td class="text-left oneline">
                                @if(($contract->status == 1) && ($contract->electronic_signature_token != null))
                                    {{ $contract->electronic_signature_token->expiry_date }}
                                @endif
                            </td>
                            <td class="text-center oneline">
                                <a href="{{ url(Session::get('guard') . '/contracts/' . $contract->id) }}"
                                   class="fetchajaxpage">
                                    <span class="btn btn-success btn-xs">{{ trans('app.view_contract') }}</span>
                                </a>
                            </td>
                            <td class="text-center oneline">
                                @if ($contract->status == 0)
                                    <a href="{{ url(Session::get('guard') . '/contracts/' . $contract->id . '/edit') }}"
                                       class="fetchajaxpage">
                                        <span class="btn btn-success btn-xs">{{ trans('app.edit_contract') }}</span>
                                    </a>
                                @endif
                            </td>
                            <td class="text-right oneline">
                                @if ($contract->status == 0)
                                    <span class="btn btn-danger btn-xs postconfirm"
                                          data-title="{{ trans('app.delete_contract') }}"
                                          data-description="{{ trans('app.are_you_sure_you_want_to_delete_the_contract_contract_name',["contract_name" => $contract->title]) }}"
                                          data-reloadurl="{{ url(Session::get('guard') . '/contracts/template/' . $contract->contract_template->id) }}"
                                          data-posturl="{{ url(Session::get('guard') . '/contracts/'.$contract->id) }}">{{ trans('app.delete') }}</span>
                                @endif
                            </td>
                            <td class="text-center oneline">
                                @if (($contract->status == 0))
                                    <a href="#"
                                       data-toggle="modal" data-target="#ajaxmodel"
                                       data-remote="{{ url(Session::get('guard') . '/contracts/' . $contract->id . '/electronic_signature_request') }}">
                                        <span class="btn btn-success btn-xs">{{ trans('app.electronic_signature_request') }}</span>
                                    </a>
                                @endif
                            </td>
                            <td class="text-center oneline">
                                <a href="{{ url(Session::get('guard') . '/contracts/' . $contract->id . '/pdf/preview') }}"
                                   target="_blank" title="{{ trans('app.print_or_view') }}"
                                   class="tableicon">
                                    <i class="fa fa-print"></i>
                                </a>
                                <a href="{{ url(Session::get('guard') . '/contracts/' . $contract->id . '/pdf/download') }}"
                                   target="_blank" title="{{ trans('app.download') }}"
                                   class="tableicon">
                                    <i class="fa fa-cloud-download"></i>
                                </a>
                                @if($contract->status == 0)
                                    <a class="hand tableicon"
                                       title="{{ trans('app.email_contract') }}"
                                       data-toggle="modal" data-target="#ajaxmodel"
                                       data-remote="{{ url(Session::get('guard') . '/contracts/' . $contract->id . '/email') }}">
                                        <i class="fa fa-envelope"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center">
                <p>
                    <br>
                </p>
                <p>{{ trans('app.no_data_found') }}</p>
            </div>
        @endif
    </div>
</div>