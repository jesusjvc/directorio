@extends(Session::get('guard') . '.layouts.app') @section('content')
    <div class="row bg-title">
        <div class="col-xs-12">
            <h4 class="page-title">{{ trans('app.appointments_of_agendaname', ["agendaname" => ucwords(trans('app.' . $agenda->user->prefix) . ' ' . $agenda->user->firstname . ' ' . $agenda->user->lastname)]) }}
                <div class="pull-right">
                    <a href="{{ url('profilecontrol/appointments/' . $agenda->sharecode) }}"
                       class="fetchajaxpage btn btn-xs waves-effect waves-light btn-warning">{{ trans('app.refresh_appointments') }}
                    </a>
                </div>
            </h4>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    @include('profilecontrol.appointments.ajax.index')
@endsection
@push('head')
<link href="{{ url('assets') }}/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css"
      rel="stylesheet" type="text/css"/>
@endpush
@push('javascript')
<script src="{{ url('assets') }}/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script>
    jQuery('.datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd'
    });
</script>
@endpush