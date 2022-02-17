@extends('layouts.login')

@section('title', 'Login Area')

@section('content')

    <div class="col-12">
        @if(count($errors) > 0)

            @foreach( $errors->all() as $message )
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span>{{ $message }}</span>
                </div>
            @endforeach
        @endif
    </div>

    <div class="col-12 col-lg-6 p-4">
        
        <h2 class="fs-5 text-center">Already a member? Login here</h2>
        <form action="/login" method="POST">
            @csrf
            <div class="form-group mb-2">
                <label for="username" class="form-label">Username/Email</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="Email Address...." value="{{ old('email')}}" />
            </div>
            <div class="form-group mb-2">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="************" />
            </div>
            <div class="text-left mt-4 mb-2">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            <div class="py-2">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </form>
    </div>
    <div class="col-12 col-lg-6 p-4 mb-4 bg-light">
        <h2 class="fs-5 text-center text-info">Looking for work? register here</h2>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group mb-2">
                <label for="first_name" class="form-label">First Name</label>
                <input class="form-control bg-white" name="first_name" id="first_name" value="{{old('first_name')}}" />
            </div>
            <div class="form-group mb-2">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control bg-white" name="last_name" id="last_name" value="{{old('last_name')}}" />
            </div>
            <div class="form-group mb-2">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control bg-white" name="email" id="email" value="{{old('email')}}" />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-2">
                <label for="phone" class="form-label">Telephone</label>
                <input type="telephone" class="form-control bg-white" name="phone" id="phone" value="{{old('phone')}}" />
                @error('telephone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <hr>
            <div class="form-group mb-2">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control bg-white" name="password" id="password"  />
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-2">
                <label for="confirmed" class="form-label">Confirm Password</label>
                <input type="password" class="form-control bg-white" name="password_confirmation" id="confirmed" />
                @error('confirmed')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="text-center mt-4 mb-2">
                <button type="submit" class="btn btn-primary">Submit your Data</button>
            </div>
        </form>
    </div>
    @endsection
