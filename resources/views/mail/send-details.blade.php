@extends('layouts.mail')

@section('titlePT1', 'Welcome to')
@section('titlePT2', 'Welcome Pursuit Traffic Management')

@section('content')
    <p>Hi {{$user->first_name}}</p>
    <p>Welcome to Pursuit TMR, thank you for registering your interest in working for our recruitment agency.</p>
    <p>Your new account has been created and is ready to go.</p>
    <p>Your temporary password is:</p>
    <p>{{$password}}</p>
    <p>Please go to <a href="{{route('user.change.password', $user->id)}}">Change Password</a> to update you password. This will make your account more secure.</p>

    <p>Kind Regards</p>
    <p>The Pursuit TMR Team</p>

@endsection