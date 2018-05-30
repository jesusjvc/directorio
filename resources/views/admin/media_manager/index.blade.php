@extends(Session::get('guard') . '.layouts.app') @section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">
                {{ trans('app.media_manager') }}
            </h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.media_manager') }}
                    <div class="pull-right">
                        <span class="btn btn-xs btn-success" data-toggle="modal" data-target="#ajaxmodel"
                              data-remote="{{ url(Session::get('guard') . '/media_manager_categories/create') }}">
                            {{ trans('app.register_a_new_parent_category') }}
                        </span>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="categories">

                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="reload">
                                @include(Session::get('guard') . '.media_manager_categories.ajax.view',["path" => $path, "categoryTitle" => $categoryTitle])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('head')
<link href="{{ url('assets') }}/plugins/bower_components/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" />
<link href="{{ url('assets') }}/plugins/bower_components/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
@endpush
@push('javascript')
<script src="{{ url('assets') }}/plugins/bower_components/dropzone-master/dist/dropzone.js"></script>
<script type="text/javascript">
//    $(document).ready(function () {
//        initDropzone();
//    });
</script>
@endpush