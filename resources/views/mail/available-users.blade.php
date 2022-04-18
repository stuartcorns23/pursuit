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
            <td colspan="3">Monday</td>
        </tr>
        <tr>
            <td>Day</td>
            <td>Night</td>
            <td>Both</td>
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
        <tr>
            <td colspan="3">Tuesday</td>
        </tr>
        <tr>
            <td>Day</td>
            <td>Night</td>
            <td>Both</td>
        </tr>
        <tr>
            <td>
                <?php 
                    $tueDay = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 1)->where('night', '=', 0)->count();
                ?>
                {{$tueDay}}
            </td>
            <td>
                <?php 
                    $tueNight = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 0)->where('night', '=', 1)->count();
                ?>
                {{$tueNight}}
            </td>
            <td>
                <?php 
                    $tueAll = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 1)->where('night', '=', 1)->count();
                ?>
                {{$tueAll}}
            </td>
        </tr>
        <tr>
            <td colspan="3">Wednesday</td>
        </tr>
        <tr>
            <td>Day</td>
            <td>Night</td>
            <td>Both</td>
        </tr>
        <tr>
            <td>
                <?php 
                    $wedDay = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 1)->where('night', '=', 0)->count();
                ?>
                {{$wedDay}}
            </td>
            <td>
                <?php 
                    $wedNight = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 0)->where('night', '=', 1)->count();
                ?>
                {{$wedNight}}
            </td>
            <td>
                <?php 
                    $wedAll = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 1)->where('night', '=', 1)->count();
                ?>
                {{$wedAll}}
            </td>
        </tr>
        <tr>
            <td colspan="3">Thursday</td>
        </tr>
        <tr>
            <td>Day</td>
            <td>Night</td>
            <td>Both</td>
        </tr>
        <tr>
            <td>
                <?php 
                    $thurDay = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 1)->where('night', '=', 0)->count();
                ?>
                {{$thurDay}}
            </td>
            <td>
                <?php 
                    $thurNight = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 0)->where('night', '=', 1)->count();
                ?>
                {{$thurNight}}
            </td>
            <td>
                <?php 
                    $thurAll = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 1)->where('night', '=', 1)->count();
                ?>
                {{$thurAll}}
            </td>
        </tr>
        <tr>
            <td colspan="3">Friday</td>
        </tr>
        <tr>
            <td>Day</td>
            <td>Night</td>
            <td>Both</td>
        </tr>
        <tr>
            <td>
                <?php 
                    $friDay = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 1)->where('night', '=', 0)->count();
                ?>
                {{$friDay}}
            </td>
            <td>
                <?php 
                    $friNight = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 0)->where('night', '=', 1)->count();
                ?>
                {{$friNight}}
            </td>
            <td>
                <?php 
                    $friAll = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 1)->where('night', '=', 1)->count();
                ?>
                {{$friAll}}
            </td>
        </tr>
        <tr>
            <td colspan="3">Saturday</td>
        </tr>
        <tr>
            <td>Day</td>
            <td>Night</td>
            <td>Both</td>
        </tr>
        <tr>
            <td>
                <?php 
                    $satDay = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 1)->where('night', '=', 0)->count();
                ?>
                {{$satDay}}
            </td>
            <td>
                <?php 
                    $satNight = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 0)->where('night', '=', 1)->count();
                ?>
                {{$satNight}}
            </td>
            <td>
                <?php 
                    $satAll = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 1)->where('night', '=', 1)->count();
                ?>
                {{$satAll}}
            </td>
        </tr>
        <tr>
            <td colspan="3">Sunday</td>
        </tr>
        <tr>
            <td>Day</td>
            <td>Night</td>
            <td>Both</td>
        </tr>
        <tr>
            <td>
                <?php 
                    $sunDay = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 1)->where('night', '=', 0)->count();
                ?>
                {{$sunDay}}
            </td>
            <td>
                <?php 
                    $sunNight = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 0)->where('night', '=', 1)->count();
                ?>
                {{$sunNight}}
            </td>
            <td>
                <?php 
                    $sunAll = \App\Models\Availability::dateFilter($date->addDay())->where('day', '=', 1)->where('night', '=', 1)->count();
                ?>
                {{$sunAll}}
            </td>
        </tr>
    </table>

    <p>For more information and who is and who isn't available for next week. Please visit <a href="#">Operatives Availability</a></p>

    <p>Kind Regards</p>
    <p>The Pursuit TMR Team</p>

@endsection