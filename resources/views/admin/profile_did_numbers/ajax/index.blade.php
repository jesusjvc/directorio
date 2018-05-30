<div class="{{ $sectiontoreload }}">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.inbound_outbound_numbers_of_profilename',["profilename" => $profile->business_name]) }}
                    <div class="pull-right sectionbuttons">
                        <span class="btn btn-xs btn-primary" data-toggle="modal" data-target="#ajaxmodel"
                                data-remote="{{ url(Session::get('guard') . '/'. $profile->id . '/profile_did_numbers/create/'.$sectiontoreload) }}">
                            {{ trans('app.assign_a_new_number') }}
                        </span>
                    </div>
                </div>
                @include(Session::get('guard') . '.system_dids.ajax.index')
            </div>
        </div>
    </div>
</div>