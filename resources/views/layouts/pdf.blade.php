<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- Custom styles for this template-->
    <style>

        body{
            font-size: 9px;
            font-family: sans-serif;
        }

        #header{
            background-color: #454777;
            width: 100%;
            margin-bottom: 30px;
            color: #fff;
            font-size: 14px;
        }

        #logo{
            max-height: 100px;
        }

        .table{
            border: solid 1px #999;
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        .table th{
            padding: 2px;
            background-color: #454777;
            color: #FFF;
            border: solid 1px #999;
            text-align: center;
        }

        .table td{
            border: solid 1px #AAA;
            padding: 2px;
        }

        .table tr:even{
            background-color:#f2f2f296;
        }

        .page-break {
            page-break-after: always;
        }

        .small{
            font-size: 8px;
        }

        .text-center{
            text-align: center;
        }
        </style>
    @yield('css')
</head>
<body>
    <header id="header">
        <table width="100%"></i>
            <tr>
                <td align="left" style="padding-left:10px;" width="20%"><img id="logo" src="{{ asset('images/apollo-logo.jpg') }}" alt="Apollo Assets Manager"></td>
                <td align="left">Pursuit TMR<br>
                    <span class="small">Pursuit Traffic Management Recruitment Ltd &copy; 2021</span>
                    <br><strong>@yield('page')</strong>
                </td>
                <td align="right" style="padding-right: 10px;">
                    <br>Report by: @yield('user')
                </td>
            </tr>
        </table>
    </header>
    @yield('content')
</body>
</html>
