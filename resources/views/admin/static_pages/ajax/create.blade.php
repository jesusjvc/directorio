@extends(Session::get('guard') . '.layouts.app') @section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.cms_pages') }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.create_a_new_static_page') }}
                    <div class="pull-right">
                        <a class="btn btn-xs btn-success" href="{{ url('/admin/cms') }}">{{ trans('app.go_back') }}</a>
                    </div>
                </div>
                <div class="panel-body">
                    <form role="form" method="POST" action="{{ url(Session::get('guard') . '/cms') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ trans('app.title') }} <span class="required"> * </span></label>
                                    <input type="text" maxlength="150" name="title"
                                           class="form-control" value="{{ old('title') }}"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ trans('app.body') }} <span class="required"> * </span></label>
                                    <textarea class="form-control" name="body"
                                              rows="18">{{ old('body') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <hr>
                                <button class="btn btn-primary scroll">{{ trans('app.save') }}</button>
                            </div>
                        </div>
                    </form>
                    <script src="{{ url('/assets/plugins/bower_components/trumbowyg/trumbowyg.js') }}"></script>
                    @include('global.includes.editor')
                </div>
            </div>
        </div>
    </div>
@endsection
@push('head')
@endpush