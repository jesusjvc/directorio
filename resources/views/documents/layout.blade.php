<!DOCTYPE html>
<html>

<head>
    <style type="text/css">
        html {
            font-family: DejaVu Sans;
            font-size: 12px;
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
            font-size: 9px;
        }

        .addressdetails {
            font-family: DejaVu Sans;
            font-size: 10px;
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

        .tg {
            border-collapse: collapse;
            border-spacing: 0;
        }

        .tg td {
            font-size: 12px;
            padding: 2px 5px;
            border-style: solid;
            border-width: 0px;
            border-color: #e0eefc;
            overflow: hidden;
            word-break: normal;
        }

        .tg .vspace5 {
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .tg .vspace10 {
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .tg th {
            font-size: 12px;
            font-weight: normal;
            padding: 10px 5px;
            overflow: hidden;
            word-break: normal;
        }

        .tg .tg-5fb6 {
            text-align: left;
            font-size: 23px;
            font-weight: bold;
        }

        ul.linelist {
            list-style: none;
        }

        ul.linelist {
            margin: 0;
            padding: 0;
        }

        ul.linelist li {
            padding-top: 3px;
            padding-bottom: 3px;
            /*border-bottom: 1px solid #000000;*/
            clear: all;
        }

        ul.linelist > li > span {
            width: 150px;
            float: left;
            display: block;
            font-weight: bold;
        }

        .conditions-header {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
            padding: 10px 0;
            border-color: #000000;
            border-style: solid;
            border-width: 1px 0;
        }

        .conditions {
            margin: 15px 0;
            line-height: 19px;
        }

        .tg .tg-doctitle {
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
            padding: 10px 0;
            border-color: #000000;
            border-style: solid;
            border-width: 2px 0;
        }

        .tg .documentto {
            text-align: left;
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 5px 5px;
            border-color: #000000;
            border-style: solid;
            border-width: 1px 0;
        }

        .tg .tg-yw4l {
            vertical-align: middle
        }

        .tg .top {
            vertical-align: top
        }

        .tg .items {
            font-size:11px;
        }

        .tg .borderbottom {
            border-bottom-style: solid;
            border-bottom-color: #000000;
            border-bottom-width: 1px 0;
            padding: 5px 5px;
        }

        .tg .uppercase{
            text-transform: uppercase;
        }

        .tg .text-center{
            text-align: center;
        }

        .tg .text-right{
            text-align: right;
        }

        .tg .bold{
            font-weight: bold;
        }

        .tg .thickline{
            border-style: solid;
            border-color: #000000;
            border-width: 2px 0;
        }
    </style>
    <title>{{ $docname }}</title>
</head>
<body>
@yield('content')
</body>
</html>