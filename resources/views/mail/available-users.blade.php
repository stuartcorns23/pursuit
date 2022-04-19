@extends('layouts.mail')

@section('titlePT1', 'Operative Availability')
@section('titlePT2', 'Week Begining: '.$date->format('d\/m\/Y'))
@section("css")
    <style>

        table#usersAvailable{
            width: 100%;
            margin-bottom: 2.5rem;
            margin-top: 2.5rem;
            color: #212529;
            vertical-align: top;
            
        }

        table#usersAvailable, table#usersAvailable tr, table#usersAvailable th, table#usersAvailable td{
            border-collapse: collapse;
            border: solid 1px #666;
        }

        table#usersAvailable tr.day{
            background-color: #0d6efd;
            color: #FFF;
        }

        table#usersAvailable tr.shift{
            background-color: #aeaeae;
            color: #666;
        }

        table#usersAvailable > th{
            text-align: center;
        }

        table#usersAvailable > tr > td{
            text-align: center;
            font-weight: 600;
        }


    </style>
@endsection
@section('content')
    <p>Hi {{$user->first_name}}</p>
    <p>Below is the availability of Operatives for next week. Week Begining: {{$date->format('d\/m\/Y')}}</p>

    <table id="usersAvailable">
        <tr class="day">
            <th colspan="3" >Monday ({{$date->format('d-m')}})</th>
        </tr>
        <tr class="shift">
            <th>Day</th>
            <th>Night</th>
            <th>Both</th>
        </tr>
        <tr>
            <td align="center">
                <?php 
                    $monDay = \App\Models\Availability::dateFilter($date)->where('day', '=', 1)->where('night', '=', 0)->count();
                ?>
                {{$monDay}}
            </td>
            <td align="center">
                <?php 
                    $monNight = \App\Models\Availability::dateFilter($date)->where('day', '=', 0)->where('night', '=', 1)->count();
                ?>
                {{$monNight}}
            </td>
            <td align="center">
                <?php 
                    $monAll = \App\Models\Availability::dateFilter($date)->where('day', '=', 1)->where('night', '=', 1)->count();
                ?>
                {{$monAll}}
            </td>
        </tr>

        <?php 
            $tueDay = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 1)->where('night', '=', 0)->count();
        ?>
        <tr class="day">
            <th colspan="3">Tuesday ({{$date->format('d-m')}})</th>
        </tr>
        <tr class="shift">
            <th>Day</th>
            <th>Night</th>
            <th>Both</th>
        </tr>
        <tr>
            <td align="center">
                {{$tueDay}}
            </td>
            <td align="center">
                <?php 
                    $tueNight = \App\Models\Availability::dateFilter($date)->where('day', '=', 0)->where('night', '=', 1)->count();
                ?>
                {{$tueNight}}
            </td>
            <td align="center">
                <?php 
                    $tueAll = \App\Models\Availability::dateFilter($date)->where('day', '=', 1)->where('night', '=', 1)->count();
                ?>
                {{$tueAll}}
            </td>
        </tr>
        <?php 
            $wedDay = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 1)->where('night', '=', 0)->count();
        ?>
        <tr class="day">
            <th colspan="3">Wednesday ({{$date->format('d-m')}})</th>
        </tr>
        <tr class="shift">
            <th>Day</th>
            <th>Night</th>
            <th>Both</th>
        </tr>
        <tr>
            <td align="center">
                {{$wedDay}}
            </td>
            <td align="center">
                <?php 
                    $wedNight = \App\Models\Availability::dateFilter($date)->where('day', '=', 0)->where('night', '=', 1)->count();
                ?>
                {{$wedNight}}
            </td>
            <td align="center">
                <?php 
                    $wedAll = \App\Models\Availability::dateFilter($date)->where('day', '=', 1)->where('night', '=', 1)->count();
                ?>
                {{$wedAll}}
            </td>
        </tr>
        <?php 
            $thurDay = \App\Models\Availability::dateFilter($date)->where('day', '=', 1)->where('night', '=', 0)->count();
        ?>
        <tr class="day">
            <th colspan="3">Thursday ({{$date->format('d-m')}})</th>
        </tr>
        <tr class="shift">
            <th>Day</th>
            <th>Night</th>
            <th>Both</th>
        </tr>
        <tr>
            <td align="center">
                {{$thurDay}}
            </td>
            <td align="center">
                <?php 
                    $thurNight = \App\Models\Availability::dateFilter($date)->where('day', '=', 0)->where('night', '=', 1)->count();
                ?>
                {{$thurNight}}
            </td>
            <td align="center">
                <?php 
                    $thurAll = \App\Models\Availability::dateFilter($date)->where('day', '=', 1)->where('night', '=', 1)->count();
                ?>
                {{$thurAll}}
            </td>
        </tr>
        <?php 
            $friDay = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 1)->where('night', '=', 0)->count();
        ?>
        <tr class="day">
            <th colspan="3">Friday ({{$date->format('d-m')}})</th>
        </tr>
        <tr class="shift">
            <th>Day</th>
            <th>Night</th>
            <th>Both</th>
        </tr>
        <tr>
            <td align="center">
                {{$friDay}}
            </td>
            <td align="center">
                <?php 
                    $friNight = \App\Models\Availability::dateFilter($date)->where('day', '=', 0)->where('night', '=', 1)->count();
                ?>
                {{$friNight}}
            </td>
            <td align="center">
                <?php 
                    $friAll = \App\Models\Availability::dateFilter($date)->where('day', '=', 1)->where('night', '=', 1)->count();
                ?>
                {{$friAll}}
            </td>
        </tr>
        <?php 
            $satDay = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 1)->where('night', '=', 0)->count();
        ?>
        <tr class="day">
            <th colspan="3">Saturday ({{$date->format('d-m')}})</th>
        </tr>
        <tr class="shift">
            <th>Day</th>
            <th>Night</th>
            <th>Both</th>
        </tr>
        <tr>
            <td align="center">
                {{$satDay}}
            </td>
            <td align="center">
                <?php 
                    $satNight = \App\Models\Availability::dateFilter($date)->where('day', '=', 0)->where('night', '=', 1)->count();
                ?>
                {{$satNight}}
            </td>
            <td align="center">
                <?php 
                    $satAll = \App\Models\Availability::dateFilter($date)->where('day', '=', 1)->where('night', '=', 1)->count();
                ?>
                {{$satAll}}
            </td>
        </tr>
        <?php 
            $sunDay = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 1)->where('night', '=', 0)->count();
        ?>
        <tr class="day">
            <th colspan="3">Sunday ({{$date->format('d-m')}})</th>
        </tr>
        <tr class="shift">
            <th>Day</th>
            <th>Night</th>
            <th>Both</th>
        </tr>
        <tr>
            <td align="center">
                {{$sunDay}}
            </td>
            <td align="center">
                <?php 
                    $sunNight = \App\Models\Availability::dateFilter($date)->where('day', '=', 0)->where('night', '=', 1)->count();
                ?>
                {{$sunNight}}
            </td>
            <td align="center">
                <?php 
                    $sunAll = \App\Models\Availability::dateFilter($date)->where('day', '=', 1)->where('night', '=', 1)->count();
                ?>
                {{$sunAll}}
            </td>
        </tr>
    </table>
    <?php $now = \Carbon\Carbon::now()->format('m\/Y');?>
    <p>For more information and who is and who isn't available for next week. Please visit <a href="{{ asset('schedule/'.$now)}}">Operatives Availability</a></p>

    <p>Kind Regards</p>
    <p>The Pursuit TMR Team</p>

@endsection