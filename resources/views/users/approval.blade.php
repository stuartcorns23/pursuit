@extends('layouts.admin')

@section('title', 'Users | Pursuit TMR')

@section('css')

@endsection

@section('content')
<section class="page-wrapper">
    <div class="page-content">
        <div class="w-100 d-flex justify-content-between align-items-center">
            <h1 class="text-center mb-4">New Registered User</h1>
        </div>
        
        <x-handlers.alerts />

        <p class="fs-5">You have a new user that has requested an account with Pursuit Traffic Management Recruitment Ltd. The details of the user and the choices to accept or
            or decline the application are below:
        </p>

        <div class="w-100">

            <div class="row row-eq-height container m-auto" >
                <div class="col-12" >
                    <div class="card shadow h-100 text-secondary" >
                        <div class="card-body" >
                           
                                <div class="row" >
                                
                                    <div class="col-12 col-md-6 p-4 mb-3" >
                                        <table class="table table-striped">
                                            <tr>
                                                <th>Name</th>
                                                <td>{{$user->fullname()}}</td>
                                            </tr>
                                            <tr>
                                                <th>Telephone</th>
                                                <td>{{$user->telephone}}</td>
                                            </tr>
                                            <tr>
                                                <th>Email Address</th>
                                                <td>{{$user->email}}</td>
                                            </tr>
                                            <tr>
                                                <th>Address</th>
                                                <td>{!!$user->full_address('<br>')!!}</td>
                                            </tr>
                                        </table>
                                    </div >
                                    <div class="col-12 col-md-6 p-4 mb-3 " >
                                        <p>Approve or Deny the user:</p>
                                        <div>
                                            <a href="{{route('user.approve', $user->id)}}" class="btn btn-success">Approve</a>
                                            <a href="{{route('user.deny', $user->id)}}" class="btn btn-danger">Deny</a>
                                        </div>
                                    </div>
                                </div>
                            
                        </div >
                    </div >
                </div >
            </div >
           

        </div>
    </div>
</section>

@endsection

@section('modals')

@endsection

@section('js')

@endsection