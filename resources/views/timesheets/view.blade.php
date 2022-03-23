@extends('layouts.admin')

@section('title', 'Timesheets | Pursuit TMR')

@section('css')

@endsection

@section('content')
<section class="page-wrapper">
    <div class="page-content">
        <div class="w-100 d-flex justify-content-between align-items-center">
            <h1 class="text-center mb-4">Timesheets</h1>
            <div class="p-2">
                <a href="#" class="btn btn-warning">Download PDF</a>
                <a href="{{route('timesheets.create')}}" class="btn btn-success">Submit a Timesheet</a>
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
                        <th class="text-center" width="5%">ID</th>
                        <th class="text-center">User</th>
                        <th>Start of Week</th>
                        <th>End of Week</th>
                        <th>Shifts</th>
                        <th>Wages</th>
                        <th class="text-center" width="5%">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($timesheets as $timesheet)
                    <tr>
                        <td class="text-center">{{$timesheet->id}}</td>
                        <td class="text-center">{{$timesheet->user->fullname()}}</td>
                        <td>{{\Carbon\Carbon::parse($timesheet->week_start)->format('d\/m\/Y')}}</td>
                        <td>{{\Carbon\Carbon::parse($timesheet->week_end)->format('d\/m\/Y')}}</td>
                        <td>{{ $timesheet->total_shifts}}</td>
                        <td>£{{$timesheet->total_wages}}</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-secondary" id="dropDown{{$timesheet->id}}" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropDown{{$timesheet->id}}">
                                    
                                    @if(!empty($timesheet->getFirstMedia('timesheets')))
                                    <a class="dropdown-item" href="{{$timesheet->getFirstMedia()->getFullUrl()}}">Download Timesheet</a>
                                    @endif
                                    <a class="dropdown-item" href="{{route('timesheets.edit', $timesheet->id)}}">Edit</a>
                                    <form id="form{{$timesheet->id}}" action="{{ route('users.destroy', $timesheet->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a class="deleteBtn dropdown-item" href="#"
                                           data-id="{{$timesheet->id}}">Delete</a>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @if($timesheets->count() === 0)
                        <tr>
                            <td colspan="7" class="text-center">No timesheets have been returned</td>
                        </tr>
                    @endif
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
<!-- Delete Modal-->
<div class="modal fade bd-example-modal-lg" id="removeUserModal" tabindex="-1" role="dialog"
    aria-labelledby="removeUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeUserModalLabel">Are you sure you want to delete this User?
                </h5>
                <button class="btn btn-gray close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input id="user-id" type="hidden" value="">
                <p>Select "Delete" to remove this User from the system.</p>
                <small class="text-danger">**Warning this is permanent. </small>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-danger" type="button" id="confirmBtn">Delete</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    let deleteBtn = document.querySelectorAll('.deleteBtn');
    const userID = document.querySelector('#user-id');
    const removeUserModal =  new bootstrap.Modal(document.getElementById('removeUserModal'), {backdrop: true});
    const confirmBtn = document.querySelector('#confirmBtn');

    deleteBtn.forEach( item  => {
        item.addEventListener('click', function(e){
            e.preventDefault();

            userID.value = this.getAttribute('data-id');
            removeUserModal.show();
        });
    });

    confirmBtn.addEventListener('click', function(){
        let form = document.querySelector('#form'+userID.value);
        form.submit()
    })

</script>
@endsection