@extends('layouts.admin')

@section('title', 'Settings | Pursuit TMR')
   
@section('css')

@endsection

@section('content')
    <section class="page-wrapper">
        <div class="page-content">
            <h1 class="text-center mb-4">Settings</h1>

            <div class="container">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Documents</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Roles</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="accountants-tab" data-bs-toggle="tab" data-bs-target="#accountants" type="button" role="tab" aria-controls="accountants" aria-selected="false">Accountants</button>
                    </li>
                </ul>
                <div class="tab-content bg-light text-secondary" id="myTabContent">
                    <div class="tab-pane fade show active p-4" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3>Settings</h3>
                                <div>
                                    <button class="btn btn-info">Clear Cache</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="timesheet_reminder">Timesheet Notification</label>
                                        <select name="timesheet_reminder" class="form-control">
                                            <option value="Monday">Monday</option>
                                            <option value="Tuesday">Tuesday</option>
                                            <option value="Wednesday">Wednesday</option>
                                            <option value="Thursday">Thursday</option>
                                            <option value="Friday">Friday</option>
                                            <option value="Saturday">Saturday</option>
                                            <option value="Sunday">Sunday</option>
                                        </select>
                                    </div>
                                    <p class="text-muted">**This is when the operative will be reminded to submit there timesheets</p>
                                    <div class="form-group">
                                        <label for="timesheet_reminder">Availability Notification</label>
                                        <select name="timesheet_reminder" class="form-control">
                                            <option value="Monday">Monday</option>
                                            <option value="Tuesday">Tuesday</option>
                                            <option value="Wednesday">Wednesday</option>
                                            <option value="Thursday">Thursday</option>
                                            <option value="Friday">Friday</option>
                                            <option value="Saturday">Saturday</option>
                                            <option value="Sunday">Sunday</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade p-4" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3>Documents</h3>
                                <div>
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#documentAddModal">Add New</button>
                                </div>
                            </div>
                            

                            <table class="table table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th class="col-3 text-center">Document Name</th>
                                        <th class="col-3 text-center">Document Type</th>
                                        <th class="col-2  text-center">Required</th>
                                        <th class="col-2">Added</th>
                                        <th class="col-1 text-end">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($documents as $document)
                                    <tr>
                                        <td>{{$document->name}}</td>
                                        <td>{{ $document->type}}</td>
                                        <td class="text-center">@if($document->required) Yes  @else No @endif</td>
                                        <td>{{\Carbon\Carbon::parse($document->created_at)->format('d-m-Y')}}</td>
                                        <td class="texzt-end"><button class="btn btn-light">...</button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade p-4" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3>Roles</h3>
                                <div>
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#roleAddModal">Add New</button>
                                </div>
                            </div>

                            <table class="table table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th class="col-3 text-start">Name</th>
                                        <th class="col-2 text-start">Charge</th>
                                        <th class="col-2 text-start">Rate</th>
                                        <th class="col-2 text-center">Staff</th>
                                        <th class="col-2">Added</th>
                                        <th class="col-1 text-end">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $role)
                                    <tr>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->rate ?? 'Not Set'}}</td>
                                        <td>{{$role->charge ?? 'Not Set' }}</td>
                                        <td class="text-center">{{$role->users->count()}}</td>
                                        <td>{{\Carbon\Carbon::parse($role->created_at)->format('d-m-Y')}}</td>
                                        <td class="text-end"><button class="btn btn-light">...</button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade p-4" id="accountants" role="tabpanel" aria-labelledby="accountant-tab">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h3>Accountants</h3>
                                <div>
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#accountantAddModal">Add New</button>
                                </div>
                            </div>

                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th class="col-3">Name</th>
                                        <th class="col-3">Address</th>
                                        <th class="col-2 text-center">Telephone</th>
                                        <th class="col-3 text-center">Email</th>
                                        <th class="col-1 text-end">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($accountants as $account)
                                    <tr>
                                        <td id="ac_name_{{$account->id}}">{{$account->name}}</td>
                                        <td>{{$account->full_address(',')}}</td>
                                        <td class="text-center">{{ $account->telephone }}</td>
                                        <td class="text-center">{{$account->email}}</td>
                                        <td class="text-end">
                                            
                                            <div class="dropdown">
                                                <button class="btn btn-secondary" id="dropDown{{$account->id}}" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-h"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropDown{{$account->id}}">
                                                    @can('update', $account)
                                                    <li><a class="dropdown-item" href="{{route('accountants.show', $account->id)}}">View</a></li>
                                                    
                                                    <li>
                                                        <a class="dropdown-item edit-btn" href="#"
                                                            data-id="{{$account->id}}" 
                                                            data-address-1="{{$account->address_1}}" 
                                                            data-address-2="{{$account->address_2}}" 
                                                            data-city="{{$account->city}}" 
                                                            data-postcode="{{$account->postcode}}" 
                                                            data-email="{{$account->email}}" 
                                                            data-telephone="{{$account->telephone}}" 
                                                        >Edit</a>
                                                    </li>
                                                    <form id="form{{$account->id}}" action="{{ route('accountants.destroy', $account->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a class="deleteBtn dropdown-item" href="#"
                                                           data-id="{{$account->id}}">Delete</a>
                                                    </form>
                                                    @endcan
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            
              

            
        </div>
    </section>

@endsection

@section('modals')

<!-- Add Document Type Modal -->
<div class="modal fade" id="documentAddModal" tabindex="-1" aria-labelledby="documentAddModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="documentAddModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('types.store')}}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="Name">Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="Type">Type</label>
                    <select name="type" class="form-control">
                        <option value="License">License</option>    
                        <option value="Qualification">Qualification</option>    
                        <option value="Medical">Medical</option>    
                    </select>    
                </div>
                <div class="form-group">
                    <label for="required">Required</label>
                    <select name="required" id="required" class="form-control">
                        <option value="1">Yes</option>
                        <option value="0">No</option></option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Add Document Type</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

  <!-- Add Document Type Modal -->
<div class="modal fade" id="roleAddModal" tabindex="-1" aria-labelledby="roleAddModalLabel" aria-hidden="true">

</div>
<div class="modal fade" id="accountantAddModal" tabindex="-1" aria-labelledby="accountantAddModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="accountAddModalLabel">Add New Accountant</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('accountants.store')}}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="Name">Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="address_1">Address</label>
                    <input type="text" name="address_1" class="form-control mb-2" required>
                    <input type="text" name="address_2" class="form-control">
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" name="city" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="city">Post Code</label>
                    <input type="text" name="postcode" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="telephone">Telephone</label>
                    <input type="tel" name="telephone" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Add Accountant</button>
            </div>
        </form>
      </div>
    </div>  
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Add New Accountant</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('accountants.store')}}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="Name">Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="address_1">Address</label>
                    <input type="text" name="address_1" class="form-control mb-2" required>
                    <input type="text" name="address_2" class="form-control">
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" name="city" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="city">Post Code</label>
                    <input type="text" name="postcode" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="telephone">Telephone</label>
                    <input type="tel" name="telephone" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Add Accountant</button>
            </div>
        </form>
      </div>
    </div>  
</div>

@endsection

@section('js')
<script>
    const editModal = new bootstrap.Modal(document.getElementById('editModal'), {backdrop: true});
    const editBtns = document.querySelectorAll('.edit-btn');

    editBtns.forEach((btn) => {
        btn.addEventListener('click', function(){
            editModal.show();
        });
    });

</script>

@endsection