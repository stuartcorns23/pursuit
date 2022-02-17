@extends('layouts.login')

@section('title', 'Dashboard | Pursuit TMR')
   
@section('css')

@endsection

@section('content')
    <section class="page-wrapper">
        <div class="page-content">
           
            <h1 class="text-center mb-4">Welcome to Pursuit TMR</h1>
            
            @if(!auth()->user()->confirmed)
            <p>We have received your request for an account with Pursuit Traffic Management Recruitment. Your account still awaiting approval, in the meantime please be sure 
                to verify your email. WHen you registered for an account you should have received an email with a link to verify your account, this link lasts 48 hours. If you haven't recevied
                an email or it has been longer than 48 hours please click the button below to resend. 
            </p>
            @endif

            @if(auth()->user()->confirmed && !auth()->user()->hasVerifiedEmail())
            <p>Please verify your email in order to get the full features of your account
            </p>
            @endif
            
            <div class="d-flex justify-content-start align-items-center">
            
                <form method="POST" action="{{ route('verification.send') }}" class="mr-2">
                    @csrf
    
                    <div>
                        <button type="submit" class="btn btn-sm btn-primary">
                            {{ __('Resend Verification Email') }}
                        </button>
                    </div>
                </form>
    
                <form method="POST" action="{{ route('logout') }}" class="m-2">
                    @csrf
    
                    <button type="submit" class="btn btn-sm btn-primary">
                        {{ __('Log Out') }}
                    </button>
                </form>
            
            </div>            
        </div>
    </section>

@endsection

@section('modals')

@endsection

@section('js')


@endsection