<div class="reload">
    <form role="form" method="POST" action="{{ url(Session::get('guard') . '/cache_clear') }}" id="idForm">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        {{ trans('app.cache_clear_function') }}
                    </p>
                </div>
            </div>
        </div>
        <div class="panel-footer text-right">
            <button class="btn btn-primary">{{ trans('app.clear_cache') }}</button>
        </div>
    </form>
</div>