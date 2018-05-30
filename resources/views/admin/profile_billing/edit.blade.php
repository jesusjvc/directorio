@extends(Session::get('guard') . '.layouts.app') @section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.profile_management') }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $profile->business_name }}
                    <div class="pull-right">
                        <a href="{{ url(Session::get('guard') . '/profiles/' . $profile->id) }}">
                            <button class="btn btn-xs btn-success">
                                {{ trans('app.go_back') }}
                            </button>
                        </a>
                    </div>
                </div>
                <div class="panel-group wiz-aco" id="accordion" role="tablist"
                     aria-multiselectable="true">
                    <form role="form" method="POST" action="{{ url(Session::get('guard') . '/'.$profile->id.'/profile_billing') }}" id="validation">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <div class="panel panel-info">
                            <div class="panel-heading" role="tab" id="headingOne" style="background-color: #03a9f3;">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true"
                                       aria-controls="collapseOne">
                                        {{ trans('app.profile_billing_settings') }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    @include(Session::get('guard') . '.profiles.edit.profile_billing_settings')
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('head')
<link href="{{ url('assets') }}/plugins/bower_components/summernote/dist/summernote.css" rel="stylesheet"/>
@endpush
@push('javascript')
@include(Session::get('guard') . '.profiles.js')
@endpush