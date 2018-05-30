<script type="text/javascript">
    @if(Session::has('flash_message'))
    swal({
        title: "{{ trans('app.notification') }}",
        text: "{!! Session::get('flash_message') !!}",
        html: true,
        type: "warning",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "{{ trans('app.done') }}",
        closeOnConfirm: true
    });
    @endif

    @if(Session::has('error'))
    swal({
        title: "{{ trans('app.an_error_has_occurred') }}",
        text: "{!! Session::get('error') !!}",
        html: true,
        type: "danger",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "{{ trans('app.okay') }}",
        closeOnConfirm: true
    });
    @endif

    @if(Session::has('success'))
    swal({
        title: "{{ trans('app.success') }}",
        text: "{!! Session::get('success') !!}",
        html: true,
        type: "success",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "{{ trans('app.okay') }}",
        closeOnConfirm: true
    });
    @endif

    @if (count($errors) > 0)
    swal({
        title: "{{ trans('app.unable_to_process_request') }}",
        text: '<ul class="text-left">' + @foreach($errors->all() as $error) '<li>{{ $error }}</li>' + @endforeach '</ul>',
        html: true,
        type: "warning",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "{{ trans('app.okay_lets_try_again') }}",
        closeOnConfirm: true
    });

    @endif
</script>