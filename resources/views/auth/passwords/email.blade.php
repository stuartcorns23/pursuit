@extends('layouts.login')

@section('title', 'Forgot your Password')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="fs-5 text-center">{{ __('Reset Password') }}</h2>
            <p class="text-center text-secondary">
                A reset link will be sent to your email address. This password reset link will expire in 60 minutes. If you are having trouble with a password reset
                please email [support]
            </p>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group mb-4">
                    <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <button type="submit" class="btn btn-info">
                        {{ __('Send Password Reset Link') }}
                    </button>
                    <a class="btn btn-link" href="{{ route('login')}}">Back to Login</a>
                </div>          
            </form>
        </div>
    </div>
@endsection
