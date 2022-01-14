@extends('layouts.app')

@section('title', 'Users | Pursuit TMR')

@section('css')

@endsection

@section('content')
<section class="page-wrapper">
    <div class="page-content">
        <h1 class="text-center mb-4">Users</h1>
        <p>Here are all of the users within the application</p>

        <div class="">

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Full Name</th>
                        <th>Email Address</th>
                        <th>Telephone</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>stuartcorns</td>
                        <td>Stuart Corns</td>
                        <td>stuartcorns@outlook.com</td>
                        <td>07425889230</td>
                        <td><button class="btn btn-secondary"><i class="fas fa-menu"></i></button></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td>ID</td>
                        <td>Username</td>
                        <td>Full Name</td>
                        <td>Email Address</td>
                        <td>Telephone</td>
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