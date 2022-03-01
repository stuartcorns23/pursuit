@extends('layouts.admin')

@section('title', 'New Timesheet | Pursuit TMR')

@section('css')

@endsection

@section('content')
<section class="page-wrapper">
    <div class="page-content">
        <form action="{{route('timesheets.store')}}" method="POST">

        <div class="w-100 d-flex justify-content-between align-items-center">
            <h1 class="text-center mb-4">Submit Timesheet</h1>
            <div class="p-2">
                <div class="p-2">
                    <a href="{{route('timesheets.index')}}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-success">Submit</button>
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

        <p>Complete the following information for the previous week of work with Pursuit TM Recruitment. </p>
      
            <div class="d-flex justify-content-center">
                <div class="col-12 col-md-8" >
                    <div class="card shadow h-100" >
                        <div class="card-body text-secondary" >
                            @csrf
                            <div class="form-group row">
                                <div class="col-6">
                                    <label for="start_date">Start of Week</label>
                                    <input type="date" class="form-control" name="start_date" value="{{\Carbon\Carbon::now()->subWeek()->startOfWeek()->format('Y-m-d')}}">
                                </div>
                                <div class="col-6">
                                    <label for="end_date">End of Week</label>
                                    <input type="date" class="form-control" name="end_date" value="{{\Carbon\Carbon::now()->subWeek()->endOfWeek()->format('Y-m-d')}}">
                                </div>
                            </div>
                            <hr>
                            <h4 class="text-primary">Shifts</h4>
                            <div class="shifts mb-4">
                                @for($i=0; $i < 7; $i++)
                                @php($day = \Carbon\Carbon::now()->startOfWeek()->subWeek()->addDays($i))
                                @php($shift = \App\Models\Shift::whereDate('date', '=', $day)->whereUserId(auth()->user()->id)->first())
                                <label for="{{strtolower($day->format('l'))}}">{{$day->format('l')}} @if($shift){{$shift->rate}}@endif</label>
                                <div class="row">
                                    <div class="col-3 d-flex justify-content-between align-items-center">
                                        <div>
                                            <input name="{{strtolower($day->format('l'))}}_shift" class="form-check-input me-2" type="checkbox" id="checkboxNoLabel" value="1" aria-label="...">
                                        </div>
                                        <select name="{{strtolower($day->format('l'))}}_time" class="form-control">
                                            <option value="0" selected="selected">Please select</option>
                                            <option value="am">AM Shift</option>
                                            <option value="pm">PM Shift</option>
                                        </select>  
                                    </div>
                                    <div class="col-3">
                                        <select name="{{strtolower($day->format('l'))}}_client" class="form-control">
                                            <option selected>Please select a client</option>
                                            @foreach($clients as $client)
                                            <option value="{{$client->id}}" @if($shift && $shift->client_id == $client->id){{ 'selected' }}@endif>{{$client->name}}</option>
                                            @endforeach
                                        </select>  
                                    </div>    
                                    <div class="col-2">
                                        <input type="time" value="{{$shift->start_time ?? '18:00'}}" name="{{strtolower($day->format('l'))}}_start" class="form-control">
                                        
                                    </div>
                                    <div class="col-2">
                                        <input type="time" value="{{$shift->finish_time ?? '06:00'}}" name="{{strtolower($day->format('l'))}}_end" class="form-control">    
                                    </div> 
                                    <div class="col-2">
                                        <input type="currency" value="{{$shift->rate ?? ''}}" placeholder="£" name="{{strtolower($day->format('l'))}}_shift_rate" class="form-control">    
                                    </div>   
                                </div>
                                @endfor
                            </div>

                            <div class="form-group mb-4 d-flex justify-content-start align-items-center">
                                <!-- Rounded switch -->
                                <label class="switch">
                                    <input type="checkbox" id="expenses_toggle">
                                    <span class="slider-toggle round"></span>
                                </label>
                                <span class="ms-2">Add Expenses</span>
                            </div>
                            
                            <div id="expenses" class="d-none">
                                <h4 class="text-primary">Mileage</h4>
                                <div class="miles mb-4">
                                    @for($i=0; $i < 7; $i++)
                                    @php($day = \Carbon\Carbon::now()->startOfWeek()->subWeek()->addDays($i))
                                        <label for="{{strtolower($day->format('l'))}}">{{$day->format('l')}}</label>
                                        <div class="row">
                                            <div class="col-4">
                                                <input type="text" placeholder="From" name="{{strtolower($day->format('l'))}}_from_miles" class="form-control">
                                            </div>
                                            <div class="col-4">
                                                <input type="text" placeholder="To" name="{{strtolower($day->format('l'))}}_to_miles" class="form-control">
                                            </div>
                                            <div class="col-4">
                                                <input type="text" placeholder="Total Miles" name="{{strtolower($day->format('l'))}}_total" class="form-control">
                                            </div>
                                        </div>
                                        
                                    @endfor
                                </div>
                            


                                <h4 class="text-primary">Expenses</h4>
                                <div class="expenses mb-2">
                                    <label for="expenses">Expenses</label>
                                    
                                    <div class="row">
                                        <div class="col-8">
                                            <select name="expense1" class="form-control">
                                                <option value="5hr">5 Hour Shift Allowance (£5)</option>
                                                <option value="5hr+">Above 5 Hour Shift Allowance (£10)</option>
                                                <option value="15hr+">15 Hour Shift Allowance (£25)</option>
                                                <option value="PIE">Personal Incidental Expenses (@£10 per overnight/nightshift)</option>
                                                <option value="wash">Washing of Workwear (MAX £10 per week)</option>
                                                <option value="office">Home Office (£6 per week)</option>
                                                <option value="overnight">Overnight (£25 per night)</option>
                                                <option value="toll">Toll Bridges</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <input type="text" name="value1" placeholder="£" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <button class="btn btn-secondary">Add Another Expense</button>
                                </div>
                            </div>
                            
                            <h4 class="text-primary">Options</h4>
                            <div class="form-group">
                                <label for="accountants">Accounts</label>
                                <select name="accountants" id="" class="form-control">
                                    <option value="Hindsight">Hindsight</option>
                                    <option value="Hindsight">Quay Accounts</option>
                                </select>
                            </div>
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

    <script>

        const toggle = document.querySelector('#expenses_toggle');
        const expenses = document.querySelector('#expenses');

        toggle.addEventListener('change', function(){
            expenses.classList.toggle('d-none');
        })

    </script>

@endsection