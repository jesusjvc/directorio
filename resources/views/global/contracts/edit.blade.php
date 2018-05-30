<div class="reload">
    <form role="form" method="POST" action="{{ url(Session::get('guard') . '/contracts/' . $contract->id) }}" id="idForm"
          reloadurl="{{ url(Session::get('guard') . '/contracts/template/' . $template->id) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="text-center">
                            <a href="{{ url(Session::get('guard') . '/contracts/template/' . $template->id . '/' . Request::segment(5)) }}"
                               class="fetchajaxpage">
                                <span class="btn btn-xs btn-primary">
                                    {{ trans('app.cancel_and_go_back') }}
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>{{ trans('app.contract_title') }} <span
                                    class="required"> * </span></label>
                        <input type="text" name="title" value="{{ $contract->title }}" class="form-control" required>
                    </div>
                </div>
                @foreach($dynamicFields as $field)
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{ CustomHelper::reverseUScore($field) }} <span
                                        class="required"> * </span></label>
                            <input type="text" name="contractvalues[{{ $field }}]"
                                   @if(isset($compiledValues[$field])) value="{{ $compiledValues[$field] }}"
                                   @endif class="form-control" required>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="panel-footer">
            <div class="text-right">
                <button class="btn btn-primary">{{ trans('app.save') }}</button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    dateLoader();
</script>
<script src="{{ url('/assets') }}/plugins/bower_components/trumbowyg/trumbowyg.min.js"></script>
@include('global.includes.editor')