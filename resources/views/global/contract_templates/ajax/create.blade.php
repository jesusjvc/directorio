<form role="form" method="POST" action="{{ url(Session::get('guard') . '/contract_templates') }}" id="idForm">
    {{ csrf_field() }}
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <a href="{{ url(Session::get('guard') . '/contract_templates') }}" class="fetchajaxpage">
                        <span class="btn btn-xs btn-primary">
                            {{ trans('app.cancel_and_go_back') }}
                        </span>
                    </a>
                </div>
                <div class="form-group">
                    <label>{{ trans('app.contract_template_title') }} <span
                                class="required"> * </span></label>
                    <input type="text" maxlength="100" name="title" class="form-control" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{ trans('app.contract_body') }}</label>
                    <textarea class="form-control" name="contract" rows="18"></textarea>
                </div>
            </div>
        </div>

    </div>
    <div class="panel-footer">
        <div class="text-right">
            <button class="btn btn-primary">{{ trans('app.save') }}</button>
        </div>
    </div>
</form>
<script src="{{ url('/assets/plugins/bower_components/trumbowyg/trumbowyg.min.js') }}"></script>
@include('global.includes.editor')