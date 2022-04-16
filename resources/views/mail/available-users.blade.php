@extends('layouts.mail')

@section('titlePT1', 'Operative Availability')
@section('titlePT2', 'Week Begining: '.$date->format('d\/m\/Y'))

@section('content')
    <p>Hi {{$user->first_name}}</p>
    <p>Below is the availability of Operatives for next week. Week Begining: {{$date->format('d\/m\/Y')}}</p>

    <table>
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
                    $avails = \App\Models\Availability::dateFilter($date)->where('day', '=', 1)->where('day', '=', 0)->get();
                ?>
                @foreach($avails as $avail)
                    {{$avail->user->fullname() ?? 'Error finding the Operative' }}<br>
                @endforeach
                <?php unset($avails);?>
            </td>
            <td>
                <?php 
                    $avails = \App\Models\Availability::dateFilter($date)->where('day', '=', 0)->where('day', '=', 1)->get();
                ?>
                @foreach($avails as $avail)
                    {{$avail->user->fullname() ?? 'Error finding the Operative' }}<br>
                @endforeach
                <?php unset($avails);?>
            </td>
            <td>
                <?php 
                    $avails = \App\Models\Availability::dateFilter($date)->where('day', '=', 1)->where('day', '=', 1)->get();
                ?>
                @foreach($avails as $avail)
                    {{$avail->user->fullname() ?? 'Error finding the Operative' }}<br>
                @endforeach
                <?php unset($avails);?>
            </td>
        </tr>
        <tr>
            <td>Tuesday</td>
        </tr>
        <tr>
            <td>Day</td>
            <td>Night</td>
            <td>Both</td>
        </tr>
        <tr>
            <td>Wednesday</td>
        </tr>
        <tr>
            <td>Day</td>
            <td>Night</td>
            <td>Both</td>
        </tr>
        <tr>
            <td>Thursday</td>
        </tr>
        <tr>
            <td>Day</td>
            <td>Night</td>
            <td>Both</td>
        </tr>
        <tr>
            <td>Friday</td>
        </tr>
        <tr>
            <td>Day</td>
            <td>Night</td>
            <td>Both</td>
        </tr>
        <tr>
            <td>Saturday</td>
        </tr>
        <tr>
            <td>Day</td>
            <td>Night</td>
            <td>Both</td>
        </tr>
        <tr>
            <td>Sunday</td>
        </tr>
        <tr>
            <td>Day</td>
            <td>Night</td>
            <td>Both</td>
        </tr>
    </table>

    <p>Please go to <a href="{{route('user.change.password', $user->id)}}">Change Password</a> to update you password. This will make your account more secure.</p>

    <p>Kind Regards</p>
    <p>The Pursuit TMR Team</p>

@endsection