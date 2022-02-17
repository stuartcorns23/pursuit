@extends('layouts.login')

@section('title', 'Welcome to Pursuit Traffic Management Recruitment')

@section('content')

    <h1 class="text-center mb-4">Welcome to Pursuit TM Recruitment</h1>

    <div class="row mb-5">
        <div class="col-12 col-lg-6 col-xl-4">
            <img src="{{ asset('images/traffic-management.jpg')}}" alt="Pursuit Traffic Management" width="100%">
        </div>
        <div class="col-12 col-lg-6 col-xl-8">
            <strong>Our website is currently under maintenance to help optimise our visitors and employees experience</strong>.
            We are a Traffic Management Recruitment agency based in the West Midlands and provide our clients with
            fully Lantra trained operatives (All levels of qualifactions and experience). All our operatives are carefully selected,
            well trained and fully D&A Tested. If you are currently looking for Traffic Management Operative to join your schemes, 
            help with all new and existing jobs, then please get in contact with us on any of the following below. If you are looking to get into
            a career in Traffic Management, you can leave your details <a href="{{ route('dashboard') }}">here</a>, someone from the Pursuit Team will ber in contact with you.
        </div>
    </div>

    <div class="d-flex justify-content-center align-items-center border-top border-bottom border-secondary mb-5">
        @foreach($clients as $client)
        <div class="image m-3">
            <img src="{{ asset($client->photo->path)}}" alt="{{ $client->name}}" height="50px">
        </div>  
        @endforeach
    </div>

    <div class="p-2 small text-center mb-2">
        Current Operatives registered with Pursuit TM Recruitment cna log into their accounts <a href="{{ route('dashboard') }}">here</a>
    </div>

    <div class="d-flex justify-content-center align-items-start">
        <div class="p-3">
            <div class="border border-light p-3 shadow text-center">
                <p>
                    <span class="text-primary name">
                        Jac Cookson
                    </span>
                    <br>
                    <span class="email"><a href="mailto:jac@pursuit-tmr.co.uk">jac@pursuit-tmr.co.uk</a></span>
                    <br>
                    <span class="telephone text-primary">07783 520810</span>
                </p>
            </div>
        </div>
        <div class="p-3">
            <div class="border border-light p-3 shadow text-center">
                <p>
                    <span class="text-primary name">
                        Alex Hyde
                    </span>
                    <br>
                    <span class="email"><a href="mailto:alex@pursuit-tmr.co.uk">alex@pursuit-tmr.co.uk</a></span>
                    <br>
                    <span class="telephone text-primary">07889 571352</span>
                </p>
            </div>
        </div>

    </div>
    <div class="d-flex justify-content-center align-items-start">
        <div class="p-2 d-flex align-items-center">
            <i class="fab fa-facebook-square fa-2x m-2"></i> <span>@PursuitTMRecruitment</span>
        </div>
        <div class="p-2 d-flex align-items-center">
            <i class="fab fa-instagram fa-2x mr-2 m-2 "></i> <span>@pursuit_tmr </span>
        </div>
    </div>
@endsection