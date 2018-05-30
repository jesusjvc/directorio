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
                    {{ trans('app.service_categories') }}
                    <div class="pull-right">
                        <span class="btn btn-xs btn-success" data-toggle="modal" data-target="#ajaxmodel"
                              data-remote="{{ url(Session::get('guard') . '/service_categories/create/') }}">
                            {{ trans('app.configure_a_new_service_category') }}
                        </span>
                    </div>
                </div>
                @include('global.service_categories.ajax.index')
            </div>
        </div>
    </div>
    @if(Session::get('guard') == 'admin')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ trans('app.did_numbers') }}
                    </div>
                    <div class="load_did_numbers">

                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">

            function getDIDNumbers() {

                // load buidlinks
                if (load_did_numbers) {
                    load_did_numbers.abort();
                }
                $(".load_did_numbers").empty(); // empty parent page div and show loader to load
                $(".load_did_numbers").prepend('<p class="text-center">{{ trans("app.obtaining_did_numbers") }}</p><br>');

                var load_did_numbers = $(".load_did_numbers").load("{{ url(Session::get('guard') . '/sms_did_numbers') }}", function (response, status, load_did_numbers) {

                    if (load_did_numbers.status == 404) {
                        swal({
                            title: "{{ trans('app.an_error_has_occurred') }}",
                            text: "{{ trans('app.please_refresh_this_entire_page_then_try_again') }}",
                            html: true,
                            type: "danger",
                            confirmButtonText: "{{ trans('app.okay') }}",
                            closeOnConfirm: true
                        });

                        load_did_numbers.abort();

                        $('.load_did_numbers').empty();
                    }
                });
            }

            $(document).ready(function () {
                getDIDNumbers();
            });

        </script>
    @endif
@endsection @push('head') @endpush @push('javascript') @endpush