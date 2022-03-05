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
            background-color: #1d6fb8;
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
            padding: 5px;
            background-color: #1d6fb8;
            color: #FFF;
            border: solid 1px #999;
            text-align: center;
        }

        .table td{
            border: solid 1px #AAA;
            padding: 5px;
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

        .text-end{
            text-align: right;
        }
        </style>
    @yield('css')
</head>
<body>
    @php
        $month = \Carbon\Carbon::parse($date);
    @endphp
    <header id="header">
        <table width="100%"></i>
            <tr>
                <td align="left" style="padding-left:10px;" width="20%"><img id="logo" src="{{ asset('images/pursuit-tmr.jpg') }}" alt="Pursuit TMR"></td>
                <td align="left">Pursuit<br><span class="small">Traffic Management Recruitment Ltd &copy; {{\Carbon\Carbon::now()->format('Y')}}</span>
                    <br><strong>@yield('page')</strong>
                </td>
                <td align="right" style="padding-right: 10px;">
                   Schedule for {{ $month->format('F Y')}}<br>Operative: {{auth()->user()->fullname()}}
                </td>
            </tr>
        </table>
    </header>

    
    <div style="width: 100%">
    
        <p>Below is your schedule and information for the month - {{ $month->format('F Y')}}. These are the details you have submitted to Pursuit TMR on 
            {{\Carbon\Carbon::now()->format('l jS M Y')}} and your wages will be based on the information you have shared. If there are any problems with the data displayed
            please contact 
        </p>

    
    
    </div>

</body>
</html>
