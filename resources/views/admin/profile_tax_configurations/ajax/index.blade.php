<div class="reload">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.tax_configuration') }}
                    <div class="pull-right">
                        <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#ajaxmodel"
                                data-remote="{{ url(Session::get('guard') . '/' . $profile->id . '/profile_tax_configurations/create') }}">
                            {{ trans('app.register_a_new_tax_rate') }}
                        </button>
                    </div>
                </div>
                @include('global.tax_configurations.ajax.index')
            </div>
        </div>
    </div>
</div>