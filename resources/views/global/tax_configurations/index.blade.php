@extends(Session::get('guard') . '.layouts.app') @section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.configuration') }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.tax_configuration') }}
                    @if(isset($profile))
                        : {{ $profile->business_name }}
                    @endif
                    <div class="pull-right">
                        <span class="btn btn-xs btn-primary" data-toggle="modal" data-target="#ajaxmodel"
                                data-remote="{{ url(Session::get('guard') . '/tax_configurations/create') }}">
                            {{ trans('app.register_a_new_tax_rate') }}
                        </span>
                    </div>
                </div>
                @include('global.tax_configurations.ajax.index')
            </div>
        </div>
    </div>
@endsection @push('head') @endpush @push('javascript') @endpush