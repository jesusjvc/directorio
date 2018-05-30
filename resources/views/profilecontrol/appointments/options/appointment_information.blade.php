<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('app.appointment_information') }}</h4>
</div>
<div class="modal-body">
    <div class="form-body">
        <ul class="linelist col-md-12">
            <li>
                <span>{{ trans('app.profile') }}:</span> {{ $appointment->profile->business_name }}
            </li>
            <li>
                <span>{{ trans('app.branch') }}:</span> {{ $appointment->branch->branch_name }}
            </li>
            <li>
                <span>{{ trans('app.agenda') }}:</span> {{ ucwords(trans('app.' . $appointment->agenda->user->prefix) . ' ' . $appointment->agenda->user->firstname . ' ' . $appointment->agenda->user->lastname) }}
            </li>
            <li>
                <span>{{ trans('app.customer_names') }}:</span> {{ trans('app.' . $appointment->customer->prefix) . ' ' . $appointment->customer->firstname . ' ' . $appointment->customer->lastname }}
            </li>
            <li>
                <span>{{ trans('app.customer_email_address') }}:</span> {{ $appointment->customer->email }}
            </li>
            <li>
                <span>{{ trans('app.customer_mobile_no') }}:</span> +{{ $appointment->customer->mobile_no }}
            </li>
            <li>
                <span>{{ trans('app.reference') }}:</span> {{ $appointment->reference }}
            </li>
            <li>
                <span>{{ trans('app.status') }}:</span> {{ trans('app.' . $appointment->status) }}
            </li>
            <li>
                <span>{{ trans('app.date') }}:</span> {{ CustomHelper::dateTimeLong($appointment->date) }}
            </li>
            <li>
                <span>{{ trans('app.duration') }}:</span> {{ (strtotime($appointment->date_to)-strtotime($appointment->date))/60 }} {{ trans('app.minutes') }}
            </li>

        </ul>
        <div class="clearfix">
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('app.close') }}</button>
</div>