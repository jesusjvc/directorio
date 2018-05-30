<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>{{ Session::get('profile_settings')->business_name }}</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ url('assets') }}/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="{{ url('assets') }}/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ url('assets') }}/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="{{ url('assets') }}/css/colors/blue.css" id="theme" rel="stylesheet">

    <style>
        .login-register {
            @if(Session::get('app_settings')->login_show_background_image == 1)
              background: url({{ url('assets/login-register.jpg') }}) center center/cover no-repeat !important;
            @else
             background-color: #84b1d6 !important;
            @endif
              height: 100%;
            position: fixed
        }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
@yield('content')
<!-- jQuery -->
<script src="{{ url('assets') }}/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ url('assets') }}/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="{{ url('assets') }}/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

<!--slimscroll JavaScript -->
<script src="{{ url('assets') }}/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="{{ url('assets') }}/js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<script src="{{ url('assets') }}/js/custom.min.js"></script>
<!--Style Switcher -->
<script src="{{ url('assets') }}/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>
</html>