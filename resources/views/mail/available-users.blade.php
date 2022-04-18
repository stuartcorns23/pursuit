@extends('layouts.mail')

@section('titlePT1', 'Operative Availability')
@section('titlePT2', 'Week Begining: '.$date->format('d\/m\/Y'))

@section('content')
    <p>Hi {{$user->first_name}}</p>
    <p>Below is the availability of Operatives for next week. Week Begining: {{$date->format('d\/m\/Y')}}</p>

    <table style="
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        vertical-align: top;
        border-color: #dee2e6;
    ">
        <tr>
            <th colspan="3">Monday ({{$date->format('d-m')}})</th>
        </tr>
        <tr>
            <th>Day</th>
            <th>Night</th>
            <th>Both</th>
        </tr>
        <tr>
            <td>
                <?php 
                    $monDay = \App\Models\Availability::dateFilter($date)->where('day', '=', 1)->where('night', '=', 0)->count();
                ?>
                {{$monDay}}
            </td>
            <td>
                <?php 
                    $monNight = \App\Models\Availability::dateFilter($date)->where('day', '=', 0)->where('night', '=', 1)->count();
                ?>
                {{$monNight}}
            </td>
            <td>
                <?php 
                    $monAll = \App\Models\Availability::dateFilter($date)->where('day', '=', 1)->where('night', '=', 1)->count();
                ?>
                {{$monAll}}
            </td>
        </tr>

        <?php 
            $tueDay = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 1)->where('night', '=', 0)->count();
        ?>
        <tr>
            <td colspan="3">Tuesday ({{$date->format('d-m')}})</td>
        </tr>
        <tr>
            <td>Day</td>
            <td>Night</td>
            <td>Both</td>
        </tr>
        <tr>
            <td>
                {{$tueDay}}
            </td>
            <td>
                <?php 
                    $tueNight = \App\Models\Availability::dateFilter($date)->where('day', '=', 0)->where('night', '=', 1)->count();
                ?>
                {{$tueNight}}
            </td>
            <td>
                <?php 
                    $tueAll = \App\Models\Availability::dateFilter($date)->where('day', '=', 1)->where('night', '=', 1)->count();
                ?>
                {{$tueAll}}
            </td>
        </tr>
        <?php 
            $wedDay = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 1)->where('night', '=', 0)->count();
        ?>
        <tr>
            <td colspan="3">Wednesday ({{$date->format('d-m')}})</td>
        </tr>
        <tr>
            <td>Day</td>
            <td>Night</td>
            <td>Both</td>
        </tr>
        <tr>
            <td>
                {{$wedDay}}
            </td>
            <td>
                <?php 
                    $wedNight = \App\Models\Availability::dateFilter($date)->where('day', '=', 0)->where('night', '=', 1)->count();
                ?>
                {{$wedNight}}
            </td>
            <td>
                <?php 
                    $wedAll = \App\Models\Availability::dateFilter($date)->where('day', '=', 1)->where('night', '=', 1)->count();
                ?>
                {{$wedAll}}
            </td>
        </tr>
        <?php 
            $thurDay = \App\Models\Availability::dateFilter($date)->where('day', '=', 1)->where('night', '=', 0)->count();
        ?>
        <tr>
            <td colspan="3">Thursday ({{$date->format('d-m')}})</td>
        </tr>
        <tr>
            <td>Day</td>
            <td>Night</td>
            <td>Both</td>
        </tr>
        <tr>
            <td>
                {{$thurDay}}
            </td>
            <td>
                <?php 
                    $thurNight = \App\Models\Availability::dateFilter($date)->where('day', '=', 0)->where('night', '=', 1)->count();
                ?>
                {{$thurNight}}
            </td>
            <td>
                <?php 
                    $thurAll = \App\Models\Availability::dateFilter($date)->where('day', '=', 1)->where('night', '=', 1)->count();
                ?>
                {{$thurAll}}
            </td>
        </tr>
        <?php 
            $friDay = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 1)->where('night', '=', 0)->count();
        ?>
        <tr>
            <td colspan="3">Friday ({{$date->format('d-m')}})</td>
        </tr>
        <tr>
            <td>Day</td>
            <td>Night</td>
            <td>Both</td>
        </tr>
        <tr>
            <td>
                {{$friDay}}
            </td>
            <td>
                <?php 
                    $friNight = \App\Models\Availability::dateFilter($date)->where('day', '=', 0)->where('night', '=', 1)->count();
                ?>
                {{$friNight}}
            </td>
            <td>
                <?php 
                    $friAll = \App\Models\Availability::dateFilter($date)->where('day', '=', 1)->where('night', '=', 1)->count();
                ?>
                {{$friAll}}
            </td>
        </tr>
        <?php 
            $satDay = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 1)->where('night', '=', 0)->count();
        ?>
        <tr>
            <td colspan="3">Saturday ({{$date->format('d-m')}})</td>
        </tr>
        <tr>
            <td>Day</td>
            <td>Night</td>
            <td>Both</td>
        </tr>
        <tr>
            <td>
                {{$satDay}}
            </td>
            <td>
                <?php 
                    $satNight = \App\Models\Availability::dateFilter($date)->where('day', '=', 0)->where('night', '=', 1)->count();
                ?>
                {{$satNight}}
            </td>
            <td>
                <?php 
                    $satAll = \App\Models\Availability::dateFilter($date)->where('day', '=', 1)->where('night', '=', 1)->count();
                ?>
                {{$satAll}}
            </td>
        </tr>
        <?php 
            $sunDay = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 1)->where('night', '=', 0)->count();
        ?>
        <tr>
            <td colspan="3">Sunday ({{$date->format('d-m')}})</td>
        </tr>
        <tr>
            <td>Day</td>
            <td>Night</td>
            <td>Both</td>
        </tr>
        <tr>
            <td>
                {{$sunDay}}
            </td>
            <td>
                <?php 
                    $sunNight = \App\Models\Availability::dateFilter($date)->where('day', '=', 0)->where('night', '=', 1)->count();
                ?>
                {{$sunNight}}
            </td>
            <td>
                <?php 
                    $sunAll = \App\Models\Availability::dateFilter($date)->where('day', '=', 1)->where('night', '=', 1)->count();
                ?>
                {{$sunAll}}
            </td>
        </tr>
    </table>

    <p>For more information and who is and who isn't available for next week. Please visit <a href="#">Operatives Availability</a></p>

    <p>Kind Regards</p>
    <p>The Pursuit TMR Team</p>

@endsection