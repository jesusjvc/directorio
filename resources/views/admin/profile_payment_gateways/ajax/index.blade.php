<div class="reload">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.payment_gateways') }}
                    <div class="pull-right sectionbuttons">
                        <span class="btn btn-xs btn-primary" data-toggle="modal" data-target="#ajaxmodel"
                                data-remote="{{ url(Session::get('guard') . '/' . $profile->id . '/profile_payment_gateways/create') }}">
                            {{ trans('app.configure_a_new_payment_gateway') }}
                        </span>
                    </div>
                </div>
                @include('global.payment_gateways.ajax.index')
            </div>
        </div>
    </div>
</div>