@extends('layouts.admin')

@section('title', 'Change Password | Pursuit TMR')

@section('css')

@endsection

@section('content')
<section class="page-wrapper">
    <div class="page-content">
        <form action="{{ route('users.update.password', $user->id)}}" method="POST">
            @method('put')
            @csrf
        <div class="w-100 d-flex justify-content-between align-items-center">
            <h1 class="text-center mb-4">Update Password</h1>
            <div class="p-2">
                <a class="btn btn-secondary" href="{{route('users.index')}}">Back</a>
                <button class="btn btn-success" type="submit">Save</button>
            </div>
        </div>
        
        <x-handlers.alerts />

        <p>Enter the details below to change your password. Please try to use a mixture of letters, numbers and special characters.</p>
        
        <div class="row row-eq-height container m-auto" >
            <div class="col-12" >
                <div class="card shadow h-100" >
                    <div class="card-body" >
                        <div class="form-group">
                            <label for="oldPassword">Old Password</label><span class="text-danger">*</span>
                            <input type="password" class="form-control <?php if ($errors->has('oldPassword')) {?>border-danger<?php }?>" name="oldPassword"
                                id="oldPassword" placeholder="" value="">
                        </div>

                        <div class="form-group">
                            <label for="newPassword">New Password</label><span class="text-danger">*</span>
                            <input type="password" class="form-control <?php if ($errors->has('newPassword')) {?>border-danger<?php }?>" name="newPassword"
                                id="newPassword" placeholder="" value="">
                        </div>

                        <div class="form-group">
                            <label for="confirmNewPassword">Confirm Password</label><span class="text-danger">*</span>
                            <input type="password" class="form-control <?php if ($errors->has('confirmNewPassword')) {?>border-danger<?php }?>" name="confirmNewPassword"
                                id="confirmNewPassword" placeholder="" value="">
                        </div>

                    </div >
                </div >
            </div >
        </div >
    </form>
    </div>
</section>

@endsection

@section('modals')
  
@endsection

@section('js')

@endsection