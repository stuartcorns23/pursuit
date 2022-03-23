@extends('layouts.mail')

@section('titlePT1', 'Welcome to')
@section('titlePT2', 'Welcome Pursuit Traffic Management')

@section('content')
    <p>Hi {{$user->first_name}}</p>
    <p>Welcome to Pursuit TMR, thank you for registering your interest in working for our recruitment agency.</p>
    <p>Your new account has been created and is currently awaiting approval from the management.</p>
    <p>This is to prevent spam and to ensure all enquiries are geniune. This should take no longer than 48hrs, if it does happen to take longer then
        please email: info@pursuit-tmr.co.uk.
    </p>

    <p>Kind Regards</p>
    <p>The Pursuit TMR Team</p>

@endsection