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
            padding: 2px;
            background-color: #1d6fb8;
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
                <td align="left" style="padding-left:10px;" width="20%"><img id="logo" src="{{ asset('images/pursuit-tmr.jpg') }}" alt="Pursuit TMR"></td>
                <td align="left">Apollo Asset Management<br><span class="small">Pursuit Traffic Management Recruitment Ltd &copy; {{\Carbon\Carbon::now()->format('Y')}}</span>
                    <br><strong>@yield('page')</strong>
                </td>
                <td align="right" style="padding-right: 10px;">
                    <?php 
                    $start = \Carbon\Carbon::parse($timesheet->week_start);
                    $end = \Carbon\Carbon::parse($timesheet->week_end);
                    ?>
                    Week {{$start->format('W')}}: {{ $start->format('d-m-Y')}} to {{ $end->format('d-m-Y')}}<br>Report by: @yield('user')
                </td>
            </tr>
        </table>
    </header>
    
    <div style="width: 100%">
    
    <table>
        <thead>
            <tr>
                <th>Day</th>
                <th>Client</th>
                <th>Shift Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Monday</th>
                <th>Monday</th>
                <td>+ 12 Hours</td>
            </tr>
            <tr>
                <th>Tuesday</th>
                <th>Tuesday</th>
                <td>+ 12 Hours</td>
            </tr>
            <tr>
                <th>Wednesday</th>
                <th>Wednesday</th>
                <td>+ 12 Hours</td>
            </tr>
            <tr>
                <th>Thursday</th>
                <th>Thursday</th>
                <td>+ 12 Hours</td>
            </tr>
            <tr>
                <th>Friday</th>
                <th>Friday</th>
                <td>+ 12 Hours</td>
            </tr>
            <tr>
                <th>Saturday</th>
                <th>Saturday</th>
                <td>+ 12 Hours</td>
            </tr>
            <tr>
                <th>Sunday</th>
                <th>Sunday</th>
                <td>+ 12 Hours</td>
            </tr>
        </tbody>
    </table>
    
    </div>

</body>
</html>
