@extends('layouts.admin')

@section('title', 'Add New Shift | Pursuit TMR')

@section('css')

@endsection

@section('content')
<section class="page-wrapper">
    <div class="page-content">
        <form action="{{route('timesheets.store')}}" method="POST">

        <div class="w-100 d-flex justify-content-between align-items-center">
            <h1 class="text-center mb-4">Add New Shift</h1>
            <div class="p-2">
                <div class="p-2">
                    <a href="{{route('timesheets.index')}}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </div>
        
        <x.handlers-alert :errors="$errors"></x.handlers-alert>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <p>Complete the following information for hte previous week of work with Pursuit TM Recruitment. </p>
      
            <div class="d-flex justify-content-center">
                <div class="col-12 col-md-8" >
                    <div class="card shadow h-100" >
                        <div class="card-body text-secondary" >
                            @csrf
                            <div class="form-group row mb-2">
                                <div class="col-4">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" class="form-control">
                                </div>
                                <div class="col-4">
                                    <label for="start_time">Start</label>
                                    <input type="time" class="form-control" name="start_time">
                                </div>
                                <div class="col-4">
                                    <label for="end_time">End</label>
                                    <input type="time" class="form-control" name="end_time">
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="client_id">Client</label>
                                <select name="client_id" class="form-control">
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->fullname()}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row mb-4">
                                <div class="col-4">
                                    <label for="contact_name">Contact Name/Report to:</label>
                                    <input type="text" name="contact_name" class="form-control">
                                </div>
                                <div class="col-4">
                                    <label for="charge">Client Charge:</label>
                                    <input type="currency" name="charge" class="form-control">
                                </div>
                                <div class="col-4">
                                    <label for="rate">User Rate:</label>
                                    <input type="currency" name="rate" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="details"  class="form-control" cols="30" rows="10">Enter Details here...</textarea>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="user_id">Operative</label>
                                <select name="user_id" class="form-control">
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->fullname()}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">Monday</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                    <label class="form-check-label" for="inlineCheckbox2">Tuesday</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" disabled>
                                    <label class="form-check-label" for="inlineCheckbox3">Wednesday</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                        <label class="form-check-label" for="inlineCheckbox1">Thursday</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                        <label class="form-check-label" for="inlineCheckbox2">Friday</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" disabled>
                                        <label class="form-check-label" for="inlineCheckbox3">Saturday</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" disabled>
                                            <label class="form-check-label" for="inlineCheckbox3">Sunday</label>
                                            </div>
                            </div>
                            
                            <p>
                                <label for="imageFile">Upload a photo of yourself:</label>
                                <input type="file" id="imageFile" capture="user" accept="image/*">
                                </p>
                            <hr>
                            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                Send to Accountants
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                Send to a Receipt to Email
                                </label>
                            </div>
                        </div>
                    </div >
                </div >
            </div>
    </form>
    </div>
</section>

@endsection

@section('modals')

@endsection

@section('js')


@endsection