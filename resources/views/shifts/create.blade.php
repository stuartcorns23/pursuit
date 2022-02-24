@extends('layouts.admin')

@section('title', 'Add New Shift | Pursuit TMR')

@section('css')

@endsection

@section('content')
<section class="page-wrapper">
    <div class="page-content">
        <form action="{{route('shifts.store')}}" method="POST">

        <div class="w-100 d-flex justify-content-between align-items-center">
            <h1 class="text-center mb-4">Add New Shift</h1>
            <div class="p-2">
                <div class="p-2">
                    <a href="{{route('timesheets.index')}}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </div>

        <div class="availability-errors d-none alert alert-danger">

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
                                    <input id="shift_date" type="date" name="date" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" class="form-control">
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
                            {{-- Put this in a row along with contact name col ratio 8-4 --}}
                            <div class="form-group mb-2">
                                <div class="row">
                                    <div class="col-8">
                                        <label for="client_id">Client</label>
                                <select name="client_id" class="form-control">
                                    @foreach($clients as $client)
                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                    @endforeach
                                </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="contact_name">Contact Name/Report to:</label>
                                        <input type="text" name="contact_name" class="form-control">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <textarea name="details"  class="form-control" cols="30" rows="10">Enter Details here...</textarea>
                            </div>
                            <hr>
                            {{-- This needs to have there own row and javascript can add the same rowss
                                in the row is charge and payment --}}

                            <div class="operators mb-4">
                            
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="user_id">Operative</label>
                                                <select name="user_id[]" class="form-control operatives">
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->fullname()}}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                    
                                        <div class="col-4">
                                            <label for="charge">Client Charge:</label>
                                            <input type="currency" name="charge[]" class="form-control">
                                        </div>
                                        <div class="col-3">
                                            <label for="rate">User Rate:</label>
                                            <input type="currency" name="rate[]" class="form-control">
                                        </div>
                                        <div class="col-1 d-flex justify-content-end align-items-end">
                                            <i class="fas fa-times fa-2x"></i>
                                        </div>
                                    </div>                                                                                                                                                                                                                                                                                                                                                                                                            
                            
                            
                                </div>   
                            </div>
                            <button type="button" class="add-op btn btn-secondary">+Add another Operative</button>
                            
                                
                            
                            <hr>
                            <div class="form-group">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input day-checkbox" type="checkbox" name="monday" value="1">
                                    <label class="form-check-label " for="monday">Monday</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input day-checkbox" type="checkbox" name="tuesday" value="1">
                                    <label class="form-check-label" for="tuesday">Tuesday</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input day-checkbox" type="checkbox" name="wednesday" value="1">
                                    <label class="form-check-label" for="wednesday">Wednesday</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input day-checkbox" type="checkbox" name="thursday" value="1">
                                    <label class="form-check-label" for="thursday">Thursday</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input day-checkbox" type="checkbox" name="friday" value="1">
                                    <label class="form-check-label" for="friday">Friday</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input day-checkbox" type="checkbox" name="saturday" value="1" >
                                    <label class="form-check-label" for="saturday">Saturday</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input day-checkbox" type="checkbox" name="sunday" value="1" >
                                    <label class="form-check-label" for="sunday">Sunday</label>
                                </div>
                            </div>
                            <hr>
                            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="alert" checked>
                                <label class="form-check-label" for="alert">
                                Alert Operative (Via Email and Text)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="approve" checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                Auto Approve the Shifts
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
<script>
    const newOpBtn = document.querySelector('.add-op');
    const operatives = document.querySelector('.operators');
    const elements = document.querySelectorAll('.operators .form-group');
    

    newOpBtn.addEventListener('click', function(e){
        if(elements.length >= 1){
            element = elements[0].cloneNode(true);
            operatives.appendChild(element);
            initOperativeFields();
        }
    });


    function initOperativeFields(){
        let rows = document.querySelectorAll('.operators .form-group');
        
        if(rows.length > 1){
            rows.forEach((item) => {
                item.addEventListener('click', function(e){
                    if(e.target.classList.contains('fa-times')){
                        item.remove();
                        initOperativeFields();
                        initOpertiveNames();
                    }
                });
            });
        }
        
    }

    const shiftDate = document.querySelector('#shift_date');
    const operators = document.querySelectorAll('.operatives');
    const dayChecked = document.querySelectorAll('.day-checkbox');

    shiftDate.addEventListener('change', checkAvail);

    operators.forEach((item) => {
        item.addEventListener('change', checkAvail);
    });

    dayChecked.forEach((item) => {
        item.addEventListener('change', checkAvail);
    });

    function initOpertiveNames(){
        let names = document.querySelectorAll('.operatives');
        operators.forEach((item) => {
            item.addEventListener('change', checkAvail);
        });
    }

    function checkAvail(){
        let date = shiftDate.value;
        let ops = document.querySelectorAll('[name="user_id"]');
        dayChecked.foreach((item) => {
            if(item.checked){
                days[item.name] = item.value;
            }
        })
        console.log(days);


        /* let ops = [];
        let days = [];
        operators.forEach((item) => {
            ops.push(item.value);
        });
        daysChecked.foreach((item) => {
            if(item.checked){
                days.push(item.value);
            }
        })


        let xhr = new XMLHttpRequest();

        xhr.onprogress = function(e){
            
        }

        xhr.onload = function(e) {
            //Place th JSON Images into the modal
            console.log(xhr.responsiveText);
        }
        xhr.open("POST", `/availability/set`);
        xhr.send(formData); */


    }

</script>

@endsection