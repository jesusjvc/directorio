<div class="reload">
    <form role="form" method="POST" action="{{ url(Session::get('guard') . '/upgrade') }}" id="idForm">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-muted text-center">
                        {{ trans('app.your_system_is_at_version_version', ["version" => Session::get('app_settings')->application_version]) }}
                    </p>
                    <hr>
                    <p>
                        {{ trans('app.to_upgrade_your_system_copy_and_replace_the_latest_installation_files') }}
                    </p>
                </div>
            </div>
        </div>
        <div class="panel-footer text-right">
            <button class="btn btn-primary">{{ trans('app.upgrade') }}</button>
        </div>
    </form>
</div>