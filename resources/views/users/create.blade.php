@extends('layouts.admin')

@section('title', 'Create User | Pursuit TMR')

@section('css')

@endsection

@section('content')
<section class="page-wrapper">
    <div class="page-content">
        <form action="{{ route('users.store')}}" method="POST">

        <div class="w-100 d-flex justify-content-between align-items-center">
            <h1 class="text-center mb-4">Users</h1>
            <div class="p-2">
                <a class="btn btn-secondary" href="{{route('users.index')}}">Back</a>
                <button class="btn btn-success" type="submit">Save</button>
            </div>
        </div>
        @if(session('danger_message'))
    <div class="alert alert-danger"> {!! session('danger_message')!!} </div>
@endif

@if(session('success_message'))
    <div class="alert alert-success"> {!!session('success_message')!!} </div>
@endif

        <p>Here are all of the users within the application</p>
        
        <div class="row row-eq-height container m-auto" >
            <div class="col-12" >
                <div class="card shadow h-100" >
                    <div class="card-body" >
                       
                            <div class="row" >
                            
                                <div class="col-12 col-md-6 p-4 mb-3" >
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            @csrf
                                            <div class="col-12 col-sm-6">
                                                <label for="first_name">First Name<span class="text-danger">*</span></label>
                                                <input class="form-control <?php if ($errors->has('first_name')) {?>border-danger<?php }?>" type="text" name="first_name">
                                                @if ($errors->has('first_name')) {!!'<p class="small text-danger">'.$errors->first('first_name').'</p>'!!}@endif
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <label for="last_name">Last Name<span class="text-danger">*</span>:</label>
                                                <input class="form-control <?php if ($errors->has('last_name')) {?>border-danger<?php }?>" type="text" name="last_name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group  mb-3">
                                        <label for="telephone">Telephone<span class="text-danger">*</span></label>
                                        <input class="form-control <?php if ($errors->has('telephone')) {?>border-danger<?php }?>" name="telephone" type="tel">    
                                    </div>  
                                    <div class="form-group  mb-3">
                                        <label for="email">Email<span class="text-danger">*</span></label>
                                        <input class="form-control <?php if ($errors->has('email')) {?>border-danger<?php }?>" name="email" type="email">    
                                    </div>   
                                    <div class="form-group  mb-3">
                                        <label for="company_name">Company Name</label>
                                        <input class="form-control <?php if ($errors->has('company_name')) {?>border-danger<?php }?>" name="company_name" type="text">    
                                    </div>  
                                    <div class="form-group mb-3">
                                        <label for="address_1">Address<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control mb-3 <?php if ($errors->has('address_1')) {?>border-danger<?php }?>" name="address_1">
                                        <input type="text" class="form-control <?php if ($errors->has('address_2')) {?>border-danger<?php }?>" name="address_2">
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="row">
                                            <div class="col-12 col-sm-8">
                                                <label for="city">City<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control <?php if ($errors->has('city')) {?>border-danger<?php }?>" name="city">
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <label for="postcode">Post Code<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control <?php if ($errors->has('postcode')) {?>border-danger<?php }?>"  name="postcode">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="admin" class="form-label">Admin Permissions<span class="text-danger">*</span></label>
                                        <select name="admin" id="admin" class="form-control">
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
                                        </select>
                                        <p class="text-muted small">** Allowing unauthorised users with 'Admin' permissions could be damaging! Please be careful
                                            as to whom this permission is granted</p>
                                    </div>
                                </div >
                                <div class="col-12 col-md-6 p-4 mb-3 " >
                                    <div class="bg-light p-4" >
                                        <div class="model_title text-center h4 mb-3" >User Image<span class="text-danger">*</span></div >
                                        <div class="model_image p-4 text-center" >
                                            <input type="hidden" class="form-control" id="photo_id" name="photo_id" readonly>
                                            <img id="profileImage"
                                                    src="{{ asset('images/profile.jpg') }}" width="50%"
                                                    alt="Select Profile Picture" data-bs-toggle="modal" data-bs-target="#imageModal">
                                        </div >
                                        <div class="form-group">
                                            <label for="exampleDataList" class="form-label">Datalist example<span class="text-danger">*</span></label>
                                            <input class="form-control" list="datalistOptions" id="exampleDataList" name="role" placeholder="Type to search...">
                                            <datalist id="datalistOptions">
                                                @foreach($roles as $role)
                                                <option value="{{$role->name}}">
                                                    @endforeach
                                            </datalist>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                    </div >
                </div >
            </div >
        </div >
    </form>
    </div>
</section>

@endsection

@section('modals')
<div id="imageModal" class="modal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Photo Modal</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>Select an image below:.</p>
            <?php $photos = App\Models\Photo::all();?>
            <div id="photoLibrary">
                <div class="imgThumb">
                    <img src="{{ asset('images/profile.jpg') }}" width="80px" alt="Default Picture"
                class="selectPhoto" data-url="{{ asset('images/profile.jpg') }}" data-id="0">
                </div>
                @foreach($photos as $photo)
                <div class="imgThumb">
                    <img src="{{ asset($photo->path) }}" width="80px" alt="{{ $photo->name }}"
                        class="selectPhoto" data-url="{{ asset($photo->path) }}" data-id="{{$photo->id}}">
                </div>
                @endforeach
            </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">Upload New Image</button>
        </div>
      </div>
    </div>
</div>

<div id="uploadModal" class="modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Upload New Image</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="uploadMediaForm" method="POST">
            <div class="modal-body">
                <p>Select an image below:.</p>
                    @csrf
                    @method('POST')
                    Name: <input type="text" placeholder="Enter File Name" name="name" id="upload_name" class="form-control">
                    Select file : <input type='file' name='file' id='upload_file' class='form-control'><br>
                
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" id="uploadBtn">Upload New Image</button>
            </div>
        </form>
      </div>
    </div>
</div>
  
@endsection

@section('js')

<script type="text/javascript">

    const imageHolder = document.querySelector('#imageModal');
    const imageModal = new bootstrap.Modal(document.getElementById('imageModal'), {backdrop: true});
    const uploadHolder = document.querySelector('#uploadModal');
    const uploadModal = new bootstrap.Modal(document.querySelector('#uploadModal'), {backdrop: true});
    const profileImage = document.querySelector("#profileImage");
    const photoId = document.querySelector("#photo_id");

    const uploadName = document.querySelector("#upload_name");
    const uploadField = document.querySelector("#upload_file");

    const imgUploadForm = document.querySelector("#uploadMediaForm");

    const selectPhoto = document.querySelectorAll('.selectPhoto');
    const library = document.querySelector('#photoLibrary');

    imgUploadForm.onsubmit = async (e) => {
        e.preventDefault();
        console.log('calling');

        let response = await fetch('/photo/upload', {
        method: 'POST',
        body: new FormData(imgUploadForm)
        });

        let result = await response.json();
        profileImage.src = result.path;
        photoId.value = result.id;
        console.log(result);
        updatePhotos();
        
    }

    selectPhoto.forEach(photo => {
        photo.addEventListener('click', function(e){
            profileImage.src = this.getAttribute('data-url');
            photoId.value = this.getAttribute('data-id');
            imageModal.hide();
        })
    })

    function updatePhotos(page = 1){

        var xhr = new XMLHttpRequest();

        xhr.onload = function(e) {
            //Place the JSON Images into the modal
            let response = JSON.parse(xhr.responseText);
            let output = "";

            
            Object.entries(response.photos).forEach(([key, value]) => {
                output += `<img src="${value}" width="80px" alt=""
                        class="selectPhoto" data-url="${value}" data-id="${key}">`;
            });
            console.log(output);
            library.innerHTML = output;
            uploadModal.hide();
        }
        xhr.open("GET", `/photo/${page}/get`);
        xhr.send();
    }

</script>

@endsection