<div class="reload">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.xxx') }}
                    <div class="pull-right">
                        <a href="{{ url(Session::get('guard') . '/'.$customer->id.'/profile_billing/edit') }}">
                            <span class="btn btn-xs btn-success">
                                {{ trans('app.edit') }}
                            </span>
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                    xxx
                </div>
            </div>
        </div>
    </div>
</div>