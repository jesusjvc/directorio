@extends(Session::get('guard') . '.layouts.app') @section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">
                {{ trans('app.contracts') }}
            </h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.static_contracts') }}
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <button id="refreshfiles"
                                            class="btn btn-xs -btn-primary">{{ trans('app.reload_file_list') }}
                                    </button>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <form action="{{ url(Session::get('guard') . '/static_contracts/upload') }}" class="dropzone">
                                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                        <div class="fallback">
                                            <input name="file" type="file" multiple/>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="reload">
                                        @include('global.static_contracts.ajax.index',["files" => $files])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('head')
<link href="{{ url('assets') }}/plugins/bower_components/dropzone-master/dist/dropzone.css" rel="stylesheet"
      type="text/css"/>
@endpush
@push('javascript')
<script src="{{ url('assets') }}/plugins/bower_components/dropzone-master/dist/dropzone.js"></script>
<script type="text/javascript">
    $('#refreshfiles').click(function () {
            if (typeof openGate === 'undefined') {

                openGate = true;
                console.log('openGate == true');

                prepareBeforeAjax('reload', "{{ url(Session::get('guard') . '/static_contracts') }}");
                var xhr = doLoad('reload', "{{ url(Session::get('guard') . '/static_contracts') }}");

            }
        }
    );
</script>
@endpush