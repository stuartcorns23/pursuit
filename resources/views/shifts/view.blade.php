@extends('layouts.admin')

@section('title', 'Shifts | Pursuit TMR')

@section('css')

@endsection

@section('content')
<section class="page-wrapper">
    <div class="page-content">
        <div class="w-100 d-flex justify-content-between align-items-center">
            <h1 class="text-center mb-4">Shifts</h1>
            <div class="p-2">
                @can('viewAll', auth()->user())
                <a href="#" class="btn btn-info">Export</a>
                <a href="#" class="btn btn-info">Generate PDF</a>
                <a href="{{route('shifts.create')}}" class="btn btn-success">Add New Shift</a>
                <a href="#" class="btn btn-info">Filter</a>
                @endcan
            </div>
        </div>
        @if(session('danger_message'))
            <div class="alert alert-danger"> {!! session('danger_message')!!} </div>
        @endif

        @if(session('success_message'))
            <div class="alert alert-success"> {!!session('success_message')!!} </div>
        @endif

        <p class="fs-5">Here are all of the users within the application</p>

        <div class="w-100">

             <table class="table-view striped" width="100%">
                <thead>
                    <tr>
                        <th class="text-center" width="5%"> ID</th>
                        <th class="text-center">User</th>
                        <th>Client</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Charge</th>
                        <th>Rate</th>
                        <th>Status</th>
                        <th class="text-center" width="5%">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shifts as $shift)
                    <tr>
                        <td class="text-center">{{$shift->id}}</td>
                        <td class="text-center">{{$shift->user->fullname()}}</td>
                        <td>{{ $shift->client->name}}</td>
                        <td>{{ $shift->date}}</td>
                        <td>{{ $shift->start_time}} - {{ $shift->finish_time }}</td>
                        <td>{{$shift->charge}}</td>
                        <td>{{$shift->rate}}</td>
                        <td>Accpeted on 12/05/2022</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-secondary" id="dropDown{{$shift->id}}" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropDown{{$shift->id}}">
                                    <li><a class="dropdown-item" href="{{route('shifts.edit', $shift->id)}}">Edit</a></li>
                                    <form id="form{{$shift->id}}" action="{{ route('shifts.destroy', $shift->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a class="deleteBtn dropdown-item" href="#"
                                           data-id="{{$shift->id}}">Delete</a>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-center" width="5%">ID</th>
                        <th class="text-center">User</th>
                        <th>Client</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Charge</th>
                        <th>Rate</th>
                        <th>Status</th>
                        <th class="text-center" width="5%">Options</th>
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