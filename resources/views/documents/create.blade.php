@extends('layouts.admin')

@section('title', 'Create User | Pursuit TMR')

@section('css')

@endsection

@section('content')
<section class="page-wrapper">
    <div class="page-content">
        <form action="{{ route('documents.store')}}" method="POST">

        <div class="w-100 d-flex justify-content-between align-items-center">
            <h1 class="text-center mb-4">Documents</h1>
            <div class="p-2">
                <button class="btn btn-secondary">Back</button>
                <button class="btn btn-success">Save</button>
            </div>
        </div>
        @if(session('danger_message'))
    <div class="alert alert-danger"> {!! session('danger_message')!!} </div>
@endif

@if(session('success_message'))
    <div class="alert alert-success"> {!!session('success_message')!!} </div>
@endif

        <p>Upload a new document to your profile</p>
        
        <div class="row row-eq-height container m-auto" >
            <div class="col-12" >
                <div class="card shadow h-100" >
                    <div class="card-body" >
                       <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" placeholder="name">
                        </div>
                        <div class="form-group">
                            <label for="type">Document Type</label>
                            <select name="type" id="" class="form-control">
                                <option value="license">License</option>    
                            </select>    
                        </div>  
                        <div class="form-group">
                            <label for="expiry">Expiry Date</label>
                            <input type="date" name="expiry" id="" class="form-control">    
                        </div>
                        <div class="form-group">
                            <label for="file">File</label>
                            <input type="file" class="form-control">    
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