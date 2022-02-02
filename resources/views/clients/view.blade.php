@extends('layouts.admin')

@section('title', 'Clients | Pursuit TMR')

@section('css')

@endsection

@section('content')
<section class="page-wrapper">
    <div class="page-content">
        <div class="w-100 d-flex justify-content-between align-items-center">
            <h1 class="text-center mb-4">Clients</h1>
            <div class="p-2">
                @can('viewAll', auth()->user())
                <a href="{{route('clients.create')}}" class="btn btn-success">Add New Client</a>
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
                        <th class="text-center" width="5%">ID</th>
                        <th class="text-center">Photo</th>
                        <th>Name</th>
                        <th>Location</th></th>
                        <th>Telephone</th>
                        <th>Email Address</th>
                        <th>Shifts Completed</th>
                        <th>Shifts</th>
                        <th class="text-center" width="5%">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                    <tr>
                        <td class="text-center">{{$client->id}}</td>
                        <td class="text-center">
                            @if($client->photo()->exists())
                                <div class="imgThumb">
                                    <img src="{{asset($client->photo->path)}}" alt="{{$client->name}}" width="100%">
                                </div>
                            @else
                            <div class="imgThumb">
                                <img src="{{ asset('images/profile.jpg') }}" width="80px" alt="Default Picture"
                            class="selectPhoto" data-url="{{ asset('images/profile.jpg') }}" data-id="0">
                            </div>
                            @endif
                        </td>
                        <td>{{ $client->name}}
                            <br><p class="small">{{$client->city ?? ''}}</p>
                        </td>
                        <td>{{ $client->contact}}</td>
                        <td>{{ $client->telephone}}</td>
                        <td>{{ $client->email}}</td>
                        <td>{{ $client->shiftsCompleted->count()}}</td>
                        <td>{{ $client->shiftsIncoming->count()}}</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-secondary" id="dropDown{{$client->id}}" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropDown{{$client->id}}">
                                    <li><a class="dropdown-item" href="{{route('clients.edit', $client->id)}}">Edit</a></li>
                                    <form id="form{{$client->id}}" action="{{ route('clients.destroy', $client->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a class="deleteBtn dropdown-item" href="#"
                                           data-id="{{$client->id}}">Delete</a>
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
                        <th class="text-center">Photo</th>
                        <th>Name</th>
                        <th>Location</th></th>
                        <th>Telephone</th>
                        <th>Email Address</th>
                        <th>Shifts Completed</th>
                        <th>Shifts</th>
                        <th class="text-center" width="5%">Options</th>
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