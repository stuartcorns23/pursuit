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
                <a href="{{route('shifts.create')}}" class="btn btn-success">Add New Shift</a>
                <a href="#" class="btn btn-primary">Export</a>
                <a href="#" class="btn btn-warning">Generate PDF</a>
                <a href="#" class="btn btn-info">Filter</a>
                @endcan
            </div>
        </div>
       
        <x-handlers.alerts ></x-handlers.aLerts>

        <p class="fs-5">Here are all of the users within the application</p>

        <div class="w-100">

             <table class="table-view striped table-responsive" width="100%">
                <thead>
                    <tr>
                        <th class="text-center" width="5%"> ID</th>
                        <th class="text-center">User</th>
                        <th>Client</th>
                        <th>Date</th>
                        <th>Time</th>
                        @if(auth()->user()->admin == 1)
                        <th>Charge</th>
                        @endif
                        <th>Rate</th>
                        <th>Status</th>
                        <th class="text-center" width="5%">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shifts as $shift)
                    <tr>
                        <td class="text-center">{{$shift->id}}</td>
                        <td class="text-center">@if($shift->user()->exists()){{$shift->user->fullname() ?? 'Unknown'}}@else{{'Unknown'}}@endif</td>
                        <td>{{ $shift->client->name}}</td>
                        <td>{{ $shift->date}}</td>
                        <td>{{ $shift->start_time}} - {{ $shift->finish_time }}</td>
                        @if(auth()->user()->admin == 1)
                        <td>{{$shift->charge}}</td>
                        @endif
                        <td>
                            {{$shift->rate}}
                            @if($shift->pay_type == 'per-hour')
                                {{'Per Hour'}}
                            @endif
                        </td>
                        <td>
                            @if(\Carbon\Carbon::parse($shift->date)->isPast())
                                <span>Completed</span>
                            @else
                                @if(auth()->user()->id == $shift->user_id)
                                    @if($shift->status == 1)
                                        <span class="text-success">Accepted on {{\Carbon\Carbon::parse($shift->responded_date)->format('d/m/Y')}}</span>
                                    @elseif($shift->status == 2)
                                        <span class="text-danger">Rejected on {{\Carbon\Carbon::parse($shift->responded_date)->format('d/m/Y')}}</span>
                                    @else
                                        <a href="{{route('shift.accept', $shift->id)}}" class="btn btn-success">Accept</a>
                                        <a href="{{route('shift.reject', $shift->id)}}" class="btn btn-danger">Reject</a>
                                    @endif
                                @else
                                    @if($shift->status == 1)
                                        <span class="text-success">Accepted on {{\Carbon\Carbon::parse($shift->responded_date)->format('d/m/Y')}}</span>
                                    @elseif($shift->status == 2)
                                        <span class="text-danger">Rejected on {{\Carbon\Carbon::parse($shift->responded_date)->format('d/m/Y')}}</span>
                                    @else
                                    <span>Awaiting Descision</span>
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-secondary" id="dropDown{{$shift->id}}" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropDown{{$shift->id}}">
                                    <li><a class="dropdown-item" href="{{route('shifts.show', $shift->id)}}">View Details</a></li>
                                    <li><a class="dropdown-item" href="{{route('shifts.showPDF', $shift->id)}}">Download</a></li>
                                    @if(auth()->user()->admin == 1 && !\Carbon\Carbon::parse($shift->date)->isPast())
                                    <li><a class="dropdown-item" href="{{route('shifts.edit', $shift->id)}}">Edit</a></li>
                                    <form id="form{{$shift->id}}" action="{{ route('shifts.destroy', $shift->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a class="deleteBtn dropdown-item" href="#"
                                           data-id="{{$shift->id}}">Delete</a>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @if($shifts->count() == 0)
                    <tr><td colspan="9" class="text-center">No shift are currently on the system</td></tr>
                    @endif

                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-center" width="5%">ID</th>
                        <th class="text-center">User</th>
                        <th>Client</th>
                        <th>Date</th>
                        <th>Time</th>
                        @if(auth()->user()->admin == 1)
                        <th>Charge</th>
                        @endif
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