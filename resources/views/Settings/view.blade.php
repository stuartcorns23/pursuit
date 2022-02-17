@extends('layouts.admin')

@section('title', 'Dashboard | Pursuit TMR')
   
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
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
                    </li>
                </ul>
                <div class="tab-content bg-light" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
                    <div class="tab-pane fade p-4 text-dark" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div>
                            <div class="d-flex justify-content-between align-items-center">
                                <h3>Documents</h3>
                                <div>
                                    <button class="btn btn-success">Add New</button>
                                    <button class="btn btn-warning">Upload</button>
                                </div>
                            </div>

                            <table class="table table-striped table-responsive">
                                <th>
                                    <tr>
                                        <th>Document Name</th>
                                        <th>Document Type</th>
                                        <th>Required</th>
                                        <th>Added</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($documents as $document)
                                    <tr>
                                        <td>Driver License</td>
                                        <td>License</td>
                                        <td>Required</td>
                                        <td>17/02/2022</td>
                                        <td>Options</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                </div>
            </div>
            
              

            
        </div>
    </section>

@endsection

@section('modals')

@endsection

@section('js')

@endsection