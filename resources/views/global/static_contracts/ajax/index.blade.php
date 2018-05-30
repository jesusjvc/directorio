@if(count($files) > 0)
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>
                    {{ trans('app.contract') }}
                </th>
                <th>
                    {{ trans('app.status') }}
                </th>
                <th>
                    {{ trans('app.assigned_to') }}
                </th>
                <th>
                    {{ trans('app.token_expiration') }}
                </th>
                <th>

                </th>
                <th>

                </th>
                <th>
                    &nbsp;
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($files as $file)
                <tr>
                    <td>
                        @if($file->status == 1)
                            <a class="postconfirm hand tableicon"
                               data-title="{{ trans('app.cancel_signature_request') }}"
                               title="{{ trans('app.cancel_signature_request') }}"
                               data-description="{{  trans('app.are_you_sure_you_want_to_revoke_the_electronic_signature_request_for_this_contract') }}"
                               data-reloaddiv="reload"
                               data-reloadurl="{{ url(Session::get('guard') . '/static_contracts') }}"
                               data-posturl="{{ url(Session::get('guard') . '/static_contracts/' . $file->id . '/revoke_signature_request') }}">
                                <i class="fa fa-times-circle"></i>
                            </a>
                        @endif
                        {{ substr(basename($file->filename),15) }}
                            @if(($file->status == 1) && ($file->electronic_signature_token != null) && ($file->electronic_signature_token->expiry_date < date('Y-m-d')))
                                <span class="badge badge-danger">{{ trans('app.expired') }}</span>
                            @endif
                    </td>
                    <td class="oneline">
                        @if(($file->status == 2) &&($file->electronic_signature_token != null) && ($file->electronic_signature_token->electronic_signature_archive != null))
                            <span class="showSwal hand"
                                  data-title="{{ trans('app.signature_confirmation') }}"
                                  data-description="{{ trans('app.this_documenttype_was_signed_by_signedbywho_on_datewhensigned',["documenttype" => strtolower(trans('app.static_contract')), "signedbywho" => ucwords($file->electronic_signature_token->electronic_signature_archive->signed_by_names) . ' (' . $file->electronic_signature_token->electronic_signature_archive->ip_address . ')', "datewhensigned" => CustomHelper::dateLong($file->electronic_signature_token->electronic_signature_archive->created_at)]) }}"
                            ><i class="fa fa-pencil-square"></i></span>
                        @endif
                        {{ $file->textStatus }}
                    </td>
                    <td>
                        @if($file->user != null)
                            <a class="btn btn-default btn-xs"
                               href="{{ url(Session::get('guard') . '/users') }}"
                               class="tableicon">
                                {{ trans('app.user') }}
                                : {{ ucwords($file->user->prefix . ' ' . $file->user->firstname . ' ' . $file->user->lastname) }}
                            </a>
                        @elseif($file->customer != null)
                            <a class="btn btn-default btn-xs"
                               href="{{ url(Session::get('guard') . '/customers/' . $file->customer->id) }}"
                               class="tableicon">
                                {{ trans('app.customer') }}: {{ ucwords($file->customer->prefix . ' ' .
                            $file->customer->firstname . ' ' . $file->customer->lastname) }}
                            </a>
                        @elseif($file->profile_customer != null)
                            <a class="btn btn-default btn-xs"
                               href="{{ url(Session::get('guard') . '/profiles/' . $file->profile_customer->id) }}"
                               class="tableicon">
                                {{ trans('app.profile') }}: {{ $file->profile_customer->business_name }}
                            </a>
                        @endif
                    </td>
                    <td>
                        @if(($file->status == 1) && ($file->electronic_signature_token != null))
                            {{ $file->electronic_signature_token->expiry_date }}
                        @endif
                    </td>
                    <td class="text-right">
                        @if($file->status == 0)
                            <span class="btn btn-danger btn-xs postconfirm"
                                  data-title="{{ trans('app.delete_contract') }}"
                                  data-description="{{ trans('app.are_you_sure_you_want_to_delete_the_contract_contract_name',["contract_name" => $file->title]) }}"
                                  data-reloadurl="{{ url(Session::get('guard') . '/static_contracts') }}"
                                  data-posturl="{{ url(Session::get('guard') . '/static_contracts/'.$file->id) }}">{{ trans('app.delete') }}</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if (($file->status == 0))
                            <a href="#"
                               data-toggle="modal" data-target="#ajaxmodel"
                               data-remote="{{ url(Session::get('guard') . '/static_contracts/' . $file->id . '/electronic_signature_request') }}">
                                <span class="btn btn-success btn-xs">{{ trans('app.electronic_signature_request') }}</span>
                            </a>
                        @endif
                    </td>
                    <td class="oneline">
                        <a href="{{ url(Session::get('guard') . '/static_contracts/view/' . $file->id) }}"
                           target="_blank" title="{{ trans('app.print_or_view') }}"
                           class="tableicon">
                            <i class="fa fa-print"></i>
                        </a>
                        <a href="{{ url(Session::get('guard') . '/static_contracts/download/' . $file->id) }}"
                           target="_blank" title="{{ trans('app.download') }}"
                           class="tableicon">
                            <i class="fa fa-cloud-download"></i>
                        </a>
                        @if ($file->status == 0)
                            <a class="hand tableicon"
                               title="{{ trans('app.email_contract') }}"
                               data-toggle="modal" data-target="#ajaxmodel"
                               data-remote="{{ url(Session::get('guard') . '/static_contracts/email/' . $file->id) }}">
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
    <p align="center" style="margin-top:20px;">
        {{ trans('app.no_static_contracts_located') }}
    </p>
@endif