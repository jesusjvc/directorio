@extends(Session::get('guard') . '.layouts.app') @section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.contracts') }}</h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('app.contract_templates') }}
                    <div class="pull-right">
                        <span class="btn btn-xs btn-warning" data-toggle="collapse" data-target="#collapse"
                              aria-expanded="false" aria-controls="collapse">
                            {{ trans('app.contracts_explained') }}
                        </span>
                        <a href="{{ url(Session::get('guard') . '/contract_templates/create') }}" class="fetchajaxpage">
                            <span class="btn btn-xs btn-success">
                                {{ trans('app.create_a_new_template') }}
                            </span>
                        </a>
                    </div>
                </div>

                <div class="collapse" id="collapse">
                    <div class="panel-body">
                        <div class="text-muted">{!! trans('descriptions.contracts_explained') !!}</div>
                        <hr>
                    </div>
                </div>
                @include('global.contract_templates.ajax.index')
            </div>
        </div>
    </div>
@endsection @push('head')
<!-- Date picker plugins css -->
<link href="{{ url('assets') }}/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css"
      rel="stylesheet" type="text/css"/>
@endpush
@push('javascript')
<script src="{{ url('assets') }}/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
    function dateLoader() {

        console.log('------------');
        console.log('dateLoader Initiated');
        console.log('------------');

        jQuery('.datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });
    }
</script>
@endpush