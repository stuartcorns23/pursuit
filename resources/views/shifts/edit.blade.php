@extends('layouts.admin')

@section('title', 'Add New Shift | Pursuit TMR')

@section('css')

@endsection

@section('content')
<section class="page-wrapper">
    <div class="page-content">
        <form action="{{route('shifts.update', $shift->id)}}" method="POST">

        <div class="w-100 d-flex justify-content-between align-items-center">
            <h1 class="text-center mb-4">Add New Shift</h1>
            <div class="p-2">
                <div class="p-2">
                    <a href="{{route('shifts.index')}}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-success save-btn">Save</button>
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
                <div class="col-12 col-xl-8" >
                    <div class="card shadow h-100" >
                        <div class="card-body text-secondary" >
                            @csrf 
                            @method('PATCH')                                                     
                            <div class="form-group row mb-2">                                                      
                                <div class="col-4">                                                      
                                    <label for="date">Date</label></label>
                                    <input id="shift_date" type="date" name="date" value="{{\Carbon\Carbon::parse($shift->date)->format('Y-m-d')}}" class="form-control">
                                </div>
                                <div class="col-4">
                                    <label for="start_time">Start</label>
                                    <input type="time" class="form-control" name="start_time" value="{{$shift->start_time}}" required>
                                </div>
                                <div class="col-4">
                                    <label for="end_time">End</label>
                                    <input type="time" class="form-control" name="end_time" value="{{$shift->finish_time}}" required>
                                </div>
                            </div>
                            {{-- Put this in a row along with contact name col ratio 8-4 --}}
                            <div class="form-group mb-2">
                                <div class="row">
                                    <div class="col-8">
                                        <label for="client_id">Client</label>
                                <select name="client_id" class="form-control">
                                    @foreach($clients as $client)
                                        <option value="{{$client->id}}" @if($client->id == $shift->client_id) selected @endif>{{$client->name}}</option>
                                    @endforeach
                                </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="contact_name">Contact Name/Report to:</label>
                                        <input type="text" name="contact_name" class="form-control" value="{{$shift->contact_name}}">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <textarea name="details"  class="form-control" cols="30" rows="10">{{$shift->details}}</textarea>
                            </div>
                            <hr>
                            {{-- This needs to have there own row and javascript can add the same rowss
                                in the row is charge and payment --}}

                            <div class="operators mb-4">
                            
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="charge">Client Charge:</label>
                                            <input type="currency" name="charge" class="form-control" value="{{$shift->charge}}">
                                        </div>
                                        <div class="col-6">
                                            <label for="rate">User Rate:</label>
                                            <input type="currency" name="rate" class="form-control" value="{{$shift->rate}}">
                                        </div>
                                    </div>                                                                                                                                                                                                                                                                                                                                                                                                            
                            
                            
                                </div>   
                            </div>
                            
                            <hr>
                            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="alert">
                                <label class="form-check-label" for="alert">
                                Alert Operative of changes? (Via Email and Text)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="approve" checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                Auto Approve the Shift
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
                    }
                });
            });
        }

        initOperativeNames();
        
    }

    const shiftDate = document.querySelector('#shift_date');
    const operators = document.querySelectorAll('.operatives');
    const dayChecked = document.querySelectorAll('.day-checkbox');
    const errorMessage = document.querySelector('.availability-errors');
    const saveBtn = document.querySelector('.save-btn');

    shiftDate.addEventListener('change', checkAvail);

    operators.forEach((item) => {
        item.addEventListener('change', checkAvail);
    });

    dayChecked.forEach((item) => {
        item.addEventListener('change', checkAvail);
    });

    function initOperativeNames(){
        let names = document.querySelectorAll('.operatives');
        names.forEach((item) => {
            item.addEventListener('change', checkAvail);
        });
    }

    function checkAvail(){
        let date = shiftDate.value;
        let ops = [];
        let forms = document.querySelectorAll('[name="user_id[]"]');
        forms.forEach((item) => {
            ops.push(item.value);
        });
        let days = [];
        dayChecked.forEach((item) => {
            if(item.checked){
                days.push(item.name);
            }
        });
        console.log(days);

        let formData = new FormData();
        formData.append('date', date);
        formData.append('user_id', ops);
        formData.append('days', days);

        let xhr = new XMLHttpRequest();

        xhr.onprogress = function(e){
            
        }

        xhr.onload = function(e) {
            //Place th JSON Images into the modal
            console.log(xhr.responseText);
            if(xhr.responseText !== '<ul></ul>'){
                errorMessage.innerHTML = xhr.responseText;
                errorMessage.classList.remove('d-none');
                saveBtn.classList.add('disabled'); 
                window.scrollTo(0,0); 
            }else{
                errorMessage.innerHTML = '';
                errorMessage.classList.add('d-none');
                saveBtn.classList.remove('disabled');
            }
            
        }
        xhr.open("POST", `/availability/check`);
        xhr.send(formData); 
    }

</script>

@endsection