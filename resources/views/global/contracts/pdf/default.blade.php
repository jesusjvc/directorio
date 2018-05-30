<html>
<head>
    <style>
        @page {
            margin-top: 30px;
            margin-bottom: 30px;
            margin-left: 50px;
            margin-right: 50px;
        }

        span, p, table, html {
            font-family: DejaVu Sans;
            font-size: 13px;
            line-height: 19px;
        !important;
        }

        li {
            margin: 7px 0;
            line-height: 18px;
        }

        hr {
            margin: 15px 0;
        }

        header {
            position: fixed;
            top: -20px;
            left: 0px;
            right: 0px;
            height: 20px;
        }

        footer {
            position: fixed;
            bottom: -15px;
            left: 0px;
            right: 0px;
            height: 20px;
            text-align: center;
            font-family: DejaVu Sans;
            font-size: 9px;
        }

        pagebreak {
            page-break-after: always;
        }

        table {
            page-break-inside: avoid;
        }

        hr {
            border-top-width: 1px;
            border-top-style: solid;
            height: 0px;
        }

    </style>
</head>
<body>
@php
    if(Session::get('app_settings')):
    $footerapp_settings = Session::get('app_settings');
    $footerprofile_settings = Session::get('profile_settings');
    elseif($app_settings):
    $footerapp_settings = $app_settings;
    $footerprofile_settings = $profile_settings;
    endif;
@endphp

@if($footerapp_settings->show_system_footer_on_pdf == 1)
    <footer>{{ trans('app.generated_by') }} {{ $footerprofile_settings->business_name }} {{ CustomHelper::wwwOnly($footerprofile_settings->business_url) }}</footer>
@endif
{!! $body !!}
</body>
</html>