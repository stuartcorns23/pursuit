@extends('layouts.admin')

@section('title', 'Change Password | Pursuit TMR')

@section('css')

@endsection

@section('content')
<section class="page-wrapper">
    <div class="page-content">
        <form action="{{ route('users.update', $user->id)}}" method="POST">

        <div class="w-100 d-flex justify-content-between align-items-center">
            <h1 class="text-center mb-4">Update Password</h1>
            <div class="p-2">
                <a class="btn btn-secondary" href="{{route('users.index')}}">Back</a>
                <button class="btn btn-success" type="submit">Save</button>
            </div>
        </div>
        
        <x-handlers.alerts />

        <p>Here are all of the users within the application</p>
        
        <div class="row row-eq-height container m-auto" >
            <div class="col-12" >
                <div class="card shadow h-100" >
                    <div class="card-body" >
                        <div class="form-group">
                            <label for="old_password">Old Password</label><span class="text-danger">*</span>
                            <input type="password" class="form-control <?php if ($errors->has('old_password')) {?>border-danger<?php }?>" name="old_password"
                                id="old_password" placeholder="" value="">
                        </div>

                        <div class="form-group">
                            <label for="new_password">New Password</label><span class="text-danger">*</span>
                            <input type="password" class="form-control <?php if ($errors->has('new_password')) {?>border-danger<?php }?>" name="new_password"
                                id="new_password" placeholder="" value="">
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label><span class="text-danger">*</span>
                            <input type="password" class="form-control <?php if ($errors->has('confirm_password')) {?>border-danger<?php }?>" name="confirm_password"
                                id="confirm_password" placeholder="" value="">
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