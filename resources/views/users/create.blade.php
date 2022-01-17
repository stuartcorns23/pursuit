@extends('layouts.app')

@section('title', 'Users | Pursuit TMR')

@section('css')

@endsection

@section('content')
<section class="page-wrapper">
    <div class="page-content">
        <div class="w-100 d-flex justify-content-between align-items-center">
            <h1 class="text-center mb-4">Users</h1>
            <div class="p-2">
                <button class="btn btn-success">Add New User</button>
            </div>
        </div>
        <p class="fs-5">Here are all of the users within the application</p>

        <div class="w-100">

            <table class="table-view table-bordered striped" width="100%">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">ID</th>
                        <th class="text-center">Photo</th>
                        <th>Full Name</th>
                        <th>Email Address</th>
                        <th>Telephone</th>
                        <th>Last Logged in</th>
                        <th class="text-center" width="5%">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="text-center">{{$user->id}}</td>
                        <td class="text-center">XXX</td>
                        <td>{{ $user->fullname()}}</td>
                        <td>{{ $user->email}}</td>
                        <td>{{ $user->telephone}}</td>
                        <td>12th January 2022 19:04</td>
                        <td class="text-center"><button class="btn btn-secondary"><i class="fas fa-ellipsis-h"></i></button></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Photo</th>
                        <th>Full Name</th>
                        <th>Email Address</th>
                        <th>Telephone</th>
                        <th>Last Logged In</th>
                        <th class="text-center">Options</th>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
</section>

@endsection

@section('modals')

@endsection

@section('js')

@endsection