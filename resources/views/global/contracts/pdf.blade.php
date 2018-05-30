<html>
<head>
    <style>
        @page {
            margin-top: 25px;
            margin-bottom: 25px;
            margin-left: 25px;
            margin-right: 25px;
        }

        span, p, table, html {
            font-family: DejaVu Sans;
        !important;
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
            bottom: -25px;
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
@if(Session::get('app_settings')->show_system_footer_on_pdf == 1)
    <footer>{{ trans('app.generated_by') }} {{ Session::get('profile_settings')->business_name }} {{ Session::get('profile_settings')->business_url }}</footer>
@endif
{!! $contract_body !!}
</body>
</html>