<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>{{ Auth::guard('profilecontrol')->user()->profile->business_name }} :: {{ trans('app.profile_administration_panel') }}</title>
    <link href="{{ url('assets') }}/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ url('assets') }}/plugins/bower_components/custom-select/custom-select.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{ url('assets') }}/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <link href="{{ url('assets') }}/css/animate.css" rel="stylesheet">
    <link href="{{ url('assets') }}/css/style.css" rel="stylesheet">
    <link href="{{ url('assets') }}/css/colors/blue.css" id="theme" rel="stylesheet">
    <link href="{{ url('assets/plugins/select2') }}/select2.min.css" rel="stylesheet"/>
    <link href="{{ url('assets') }}/css/custom.css" id="theme" rel="stylesheet">
    <link href="{{ url('assets') }}/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet"
          type="text/css">
    <link href="{{ url('/assets') }}/plugins/bower_components/trumbowyg/ui/trumbowyg.min.css" rel="stylesheet">
    <script src="{{ url('assets') }}/plugins/bower_components/jquery/dist/jquery.min.js"></script>


@stack('head')

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://www.w3schools.com/lib/w3data.js"></script>

</head>
<body>
<!-- Preloader -->
{{--<!----}}
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
{{---->--}}
<div id="wrapper">
    <div class="text-center" id="autosaveperformed" style="display: none;">
        {{ trans('app.this_document_has_been_saved_automatically') }}
    </div>
    @include('profilecontrol.layouts.includes.top_navigation')
    @include('profilecontrol.layouts.includes.main_navigation')
    <div id="page-wrapper">
        <div class="container-fluid">
            @yield('content')
            @include(Session::get('guard') . '.layouts.includes.sidebar')
        </div>
        <footer class="footer text-center">
            <div id="qwerty" style="font-size:50px;"></div>{{ date('Y') }} &copy; {{ Session::get('profile_settings')->business_name }}
        </footer>
    </div>
</div>
<script>
    $.ajaxSetup({
        timeout: 60000
    });
</script>
<!-- initiate modal -->
@include('global.includes.initiatemodal')

<script src="{{ url('assets') }}/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="{{ url('assets') }}/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<script src="{{ url('assets') }}/js/jquery.slimscroll.js"></script>
<script src="{{ url('assets') }}/js/waves.js"></script>
<script src="{{ url('assets') }}/plugins/bower_components/sweetalert/sweetalert.min.js"></script>
<script src="{{ url('assets') }}/js/custom.min.js"></script>
<script src="{{ url('assets/plugins/select2') }}/select2.min.js"></script>
@include('global.includes.flash_messages')
@include(Session::get('guard') . '.layouts.js.js_autofetch')
@include('global.includes.js_msbfunctions')
@include('global.includes.js_modal')
<script type="text/javascript">

    $(document).ready(function () {
        initiateAutoUpdate();
        $(".select2").select2();
        initReady();
    });
</script>
@stack('javascript')
</body>
</html>
