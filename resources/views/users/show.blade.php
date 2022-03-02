@extends('layouts.admin')

@section('title', 'User Profile | Pursuit TMR')

@section('css')

@endsection

@section('content')
<section class="page-wrapper">
    <div class="page-content">
        <div class="w-100 d-flex justify-content-between align-items-center">
            <h1 class="text-center mb-4">View Profile</h1>
            <div class="p-2">
                @can('viewAll', auth()->user())
                <a href="{{route('users.index')}}" class="btn btn-secondary">Back to Users</a>
                @endcan
                @can('viewAll', auth()->user())
                <a href="{{route('users.create')}}" class="btn btn-success">Add New User</a>
                @endcan
                @can('update', $user)
                <a href="{{route('users.create')}}" class="btn btn-warning">Update Details</a>
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

        <div class="w-100 ">

            <div class="container card card-shadow">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-12 col-lg-3">
                            @if($user->photo()->exists())
                            <img id="profileImage"
                                    src="{{ asset($user->photo->path) }}" width="100%"
                                    alt="Select Profile Picture" data-bs-toggle="modal" data-bs-target="#imageModal">
                            @else
                            <img id="profileImage"
                                    src="{{ asset('images/profile.jpg') }}" width="100%"
                                    alt="Select Profile Picture" data-bs-toggle="modal" data-bs-target="#imageModal">
                            @endif
                        </div>
            
                        <div class="col-12 col-lg-5 p-4">
                            <h2>{{$user->fullname()}}</h2>
                            <h3>{{$user->role->name ?? 'Unassigned'}}</h3>
                            <p>{{$user->company_name}}</p>
                            <p>{{$user->address_1 ?? 'Unknown Address'}}</p>
                            <p>{{$user->address_2}}</p>
                            <p>{{$user->city}}</p>
                            <p>{{$user->post_code}}</p>
                        </div>
                        <div class="col-12 col-lg-4 p-4 bg-secondary">
                            <h3>Documents</h3>
                            
                        </div>
                    </div>
                    <hr>
                    <div class="p-4">
                        <h3 class="text-center mb-4">Statistics</h3>
                        <div class="row">
                            <div class="col-2">
                                <div class="card card-shadow bg-danger">
                                    <div class="card-body">
                                        Date Joined
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="card card-shadow bg-danger">
                                    <div class="card-body">
                                        Available Days
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="card card-shadow bg-danger">
                                    <div class="card-body">
                                        Accepted Shifts
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="card card-shadow bg-danger">
                                    <div class="card-body">
                                        Rejected Shifts
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="card card-shadow bg-danger">
                                    <div class="card-body">
                                        Rejected Shifts
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="card card-shadow bg-danger">
                                    <div class="card-body">
                                        Rejected Shifts
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="p-4">
                        <h3 class="text-center mb-4">Latest Shifts</h3>
                        <table>

                        </table>
                    </div>
                </div>
                
            </div>
            
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