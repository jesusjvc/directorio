<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.edit_tax_rate') }}: {{ $configuration->title }} @if(isset($profile))<br><small> {{ $profile->business_name }} </small> @endif</h4>
</div>
@php
    if(isset($profile)):
    $modifylink = $profile->id . '/profile_';
    else:
    $modifylink = null;
    endif;
@endphp
<form role="form" method="POST" action="{{ url(Session::get('guard') . '/' . $modifylink . 'tax_configurations/'.$configuration->id) }}" id="idForm"
      reloadurl="{{ url(Session::get('guard') . '/' . $modifylink . 'tax_configurations') }}">
    <div class="modal-body">
        <p>
            {{ trans('app.note_editing_tax_rates_wont_affect_existing_invoices_quotations_credit_notes_or_payments_and_will_thus_affect_future_transactions_only') }}
        </p>
        <hr>
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-body">
            <div class="form-group">
                <label>{{ trans('app.title') }} <span
                            class="required"> * </span></label>
                <input type="text" maxlength="100" name="title" class="form-control" value="{{ $configuration->title }}"
                       required>
            </div>
            <div class="form-group">
                <label>{{ trans('app.taxvat_percentage') }} <span class="required"> * </span></label>
                <div class="input-group">
                    <input type="number" step="0.01" min="0" name="percentage" class="form-control"
                           value="{{ $configuration->percentage }}" required>
                    <div class="input-group-addon">%</div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
        <button type="submit" class="btn btn-primary">{{ trans('app.save') }}</button>
    </div>
</form>