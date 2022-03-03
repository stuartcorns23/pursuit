@extends('layouts.admin')

@section('title', 'Documents | Pursuit TMR')

@section('css')

@endsection

@section('content')
<section class="page-wrapper">
    <div class="page-content">
        <div class="w-100 d-flex justify-content-between align-items-center">
            <h1 class="text-center mb-4">Documents</h1>
            <div class="p-2">
                <a href="#" class="btn btn-warning">Download PDF</a>
                <a href="{{route('documents.create')}}" class="btn btn-success">Upload Document</a>
            </div>
        </div>
        
        <x-handlers.alerts />

        <p class="fs-5">The list of documents uploaded by the operative and users in the system</p>

        <div class="w-100">

            <table class="table-view striped" width="100%">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">Document ID</th>
                        <th class="text-start">User</th>
                        <th class="text-start">File</th>
                        <th>Type</th>
                        <th>Expiry</th>
                        <th>Checked</th>
                        <th class="text-center" width="5%">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($documents as $document)
                    <tr>
                        <td class="text-center">{{$document->id}}</td>
                        <td class="text-center">{{$document->user->fullname()}}</td>
                        <td>@if($document->getFirstMedia()){{$document->getFirstMedia()->name}}@endif</td>
                        <td>{{$document->type->name}}</td>
                        <td>{{ \Carbon\Carbon::parse($document->expiry)->format('d-m-Y')}}</td>
                        <td>Checked</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-secondary" id="dropDown{{$document->id}}" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropDown{{$document->id}}">
                                    
                                    @if(!empty($document->getFirstMedia()))
                                    <a class="dropdown-item" href="{{$document->getFirstMedia()->getFullUrl()}}">Download Document</a>
                                    @endif
                                    <a class="dropdown-item" href="{{route('documents.edit', $document->id)}}">Edit</a>
                                    <form id="form{{$document->id}}" action="{{ route('documents.destroy', $document->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a class="deleteBtn dropdown-item" href="#"
                                           data-id="{{$document->id}}">Delete</a>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @if($documents->count() === 0)
                        <tr>
                            <td colspan="7" class="text-center">No documents have been returned</td>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-center" width="5%">Document ID</th>
                        <th class="text-start">User</th>
                        <th class="text-start">File</th>
                        <th>Type</th>
                        <th>Expiry</th>
                        <th>Checked</th>
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