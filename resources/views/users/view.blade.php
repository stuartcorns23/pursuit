@extends('layouts.app')

@section('title', 'Users | Pursuit TMR')

@section('css')

@endsection

@section('content')
<section class="page-wrapper">
    <div class="page-content">
        <h1 class="text-center mb-4">Users</h1>
        <p>Here are all of the users within the application</p>

        <div class="w-100">

            <table class="table-view striped" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email Address</th>
                        <th>Telephone</th>
                        <th>Last Logged in</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{ $user->fullname()}}</td>
                        <td>{{ $user->email}}</td>
                        <td>{{ $user->telephone}}</td>
                        <td>12th January 2022 19:04</td>
                        <td><button class="btn btn-secondary"><i class="fas fa-ellipsis-h"></i></button></td>
                    </tr>
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{ $user->fullname()}}</td>
                        <td>{{ $user->email}}</td>
                        <td>{{ $user->telephone}}</td>
                        <td>12th January 2022 19:04</td>
                        <td><button class="btn btn-secondary"><i class="fas fa-ellipsis-h"></i></button></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td>ID</td>
                        <td>Full Name</td>
                        <td>Email Address</td>
                        <td>Telephone</td>
                        <td>Last Logged In</td>
                        <td>Options</td>
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