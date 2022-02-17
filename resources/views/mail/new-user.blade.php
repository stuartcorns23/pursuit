@extends('layouts.admin-mail')

@section('titlePT1', 'A new user has registered at')
@section('titlePT2', 'Pursuit Traffic Management')

@section('content')
    <p>Hi {{ $admin->first_name.' '.$admin->last_name}}</p>
    <p>{{ $user->first_name.' '.$user->last_name }} has requested a Pursuit TMR account</p>
    <p>NO access is given to {{$user->first_name}}, until the account get approved. You can do this by following the link below:</p>
    <p><a href="{{route('users.approval', $user->id)}}" style="color:#1d71b8;">Confirm the User</a>
    </p>

    <p>Kind Regards</p>
    <p>The Pursuit TMR Team</p>

@endsection