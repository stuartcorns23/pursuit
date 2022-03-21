@extends('layouts.admin')

@section('title', 'New Timesheet | Pursuit TMR')

@section('css')

@endsection

@section('content')
<section class="page-wrapper">
    <div class="page-content">
        <form action="{{route('timesheets.update', $timesheet->id)}}" method="POST">

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

        <p>Complete the following information for the previous week of work with Pursuit TM Recruitment. </p>
      
            <div class="d-flex justify-content-center">
                <div class="col-12 col-lg-10" >
                    <div class="card shadow h-100" >
                        <div class="card-body text-secondary" >
                            @method('PATCH')
                            @csrf
                            <div class="form-group row">
                                <div class="col-6">
                                    <label for="start_date">Start of Week</label>
                                    <input type="date" class="form-control" name="start_date" value="{{\Carbon\Carbon::parse($timesheet->week_start)->startOfWeek()->format('Y-m-d')}}">
                                </div>
                                <div class="col-6">
                                    <label for="end_date">End of Week</label>
                                    <input type="date" class="form-control" name="end_date" value="{{\Carbon\Carbon::parse($timesheet->week_end)->endOfWeek()->format('Y-m-d')}}">
                                </div>
                            </div>
                            <hr>
                            <h4 class="text-primary">Shifts</h4>
                            <div class="shifts mb-4">
                                <?php $shifts = json_decode($timesheet->shifts, true);?>
                                @for($i=0; $i < 7; $i++)
                                @php($day = \Carbon\Carbon::now()->startOfWeek()->subWeek()->addDays($i))
                                @php($shift = $shifts[strtolower($day->format('l'))])
            
                                <label for="{{strtolower($day->format('l'))}}">{{$day->format('l')}} </label>
                                <div class="row">
                                   
                                    <div class="col-12 col-md-2 d-flex justify-content-between align-items-center">
                                        <div>
                                            <input name="{{strtolower($day->format('l'))}}_shift" class="form-check-input me-2" type="checkbox" id="checkboxNoLabel" 
                                            value="1" @if(array_key_exists(strtolower($day->format('l')), $shifts)) checked @endif />
                                        </div>
                                        <select name="{{strtolower($day->format('l'))}}_time" class="form-control">
                                            <option value="0" selected="selected">Please select</option>
                                            <option value="am" @if(isset($shift['shift']) && $shift['shift'] == 'am') selected @endif>AM Shift</option>
                                            <option value="pm" @if(isset($shift['shift']) && $shift['shift'] == 'pm') selected @endif>PM Shift</option>
                                        </select>  
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <select name="{{strtolower($day->format('l'))}}_client" class="form-control">
                                            <option selected>Please select a client</option>
                                            @foreach($clients as $client)
                                            <option value="{{$client->id}}" @if($shift && $shift['client'] == $client->id){{ 'selected' }}@endif>{{$client->name}}</option>
                                            @endforeach
                                        </select>  
                                    </div>    
                                    <div class="col-12 col-md-2">
                                        <input type="time" value="{{$shift['start'] ?? '18:00'}}" name="{{strtolower($day->format('l'))}}_start" class="form-control">
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <input type="time" value="{{$shift['end'] ?? '06:00'}}" name="{{strtolower($day->format('l'))}}_end" class="form-control">    
                                    </div> 
                                    <div class="col-12 col-md-2">
                                        <input type="currency" value="{{$shift['rate'] ?? ''}}" placeholder="£" name="{{strtolower($day->format('l'))}}_shift_rate" class="form-control">    
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <select name="pay_type" class="form-control">
                                            <option value="per-shift" @if(isset($shift['pay_type']) && $shift['pay_type'] == 'per-shift') selected @endif>Per Shift</option>    
                                            <option value="per-hour" @if(isset($shift['pay_type']) && $shift['pay_type'] == 'per-hour') selected @endif>Per Hour</option>    
                                        </select>    
                                    </div>   
                                </div>
                                @endfor
                            </div>

                            <div class="form-group mb-4">
                                <label for="comments">Any comments:</label>
                                <textarea name="comments" name="comments" cols="30" rows="10" class="form-control">

                                    {{$timesheet->comments}}
                                </textarea>
                            </div>

                            <div class="form-group mb-4 d-flex justify-content-start align-items-center">
                                <!-- Rounded switch -->
                                <label class="switch">
                                    <input type="checkbox" id="expenses_toggle" 
                                    @if($timesheet->additional || $timesheet->mileage) checked @endif
                                    >
                                    <span class="slider-toggle round"></span>
                                </label>
                                <span class="ms-2">Add Expenses</span>
                            </div>
                            
                            <?php $mileage = json_decode($timesheet->mileage, true);?>
                            <div id="expenses" class="@if(!$timesheet->additional && !$timesheet->mileage) d-none @endif">
                                <h4 class="text-primary">Mileage</h4>
                                <div class="miles mb-4">
                                    @for($i=0; $i < 7; $i++)
                                    @php($day = \Carbon\Carbon::now()->startOfWeek()->subWeek()->addDays($i))
                                    @php($mile = $mileage[strtolower($day->format('l'))])
                                        <label for="{{strtolower($day->format('l'))}}">{{$day->format('l')}}</label>
                                        <div class="row">
                                            <div class="col-4">
                                                <input type="text" placeholder="From" name="{{strtolower($day->format('l'))}}_from_miles" 
                                                class="form-control" value="{{$mile['from']}}">
                                            </div>
                                            <div class="col-4">
                                                <input type="text" placeholder="To" name="{{strtolower($day->format('l'))}}_to_miles" 
                                                class="form-control" value="{{$mile['to']}}">
                                            </div>
                                            <div class="col-4">
                                                <input type="text" placeholder="Total Miles" name="{{strtolower($day->format('l'))}}_total" 
                                                class="form-control" value="{{$mile['total']}}">
                                            </div>
                                        </div>
                                        
                                    @endfor
                                </div>
                            


                                <h4 class="text-primary">Expenses</h4>
                                <div class="additions mb-2">
                                    <label for="expenses">Expenses</label>
                                    
                                    <?php $additional = json_decode($timesheet->additional, true);?>
                                    @foreach($additional as $key => $value)
                                    <div class="row mb-2">
                                        <div class="col-8">
                                            <select name="expense[]" class="form-control">
                                                <option value="5hr" @if($key == '5hr') selected @endif>5 Hour Shift Allowance (£5)</option>
                                                <option value="5hr+" @if($key == '5hr+') selected @endif>Above 5 Hour Shift Allowance (£10)</option>
                                                <option value="15hr+" @if($key == '15hr+') selected @endif>15 Hour Shift Allowance (£25)</option>
                                                <option value="PIE" @if($key == 'PIE') selected @endif>Personal Incidental Expenses (@£10 per overnight/nightshift)</option>
                                                <option value="wash" @if($key == 'wash') selected @endif>Washing of Workwear (MAX £10 per week)</option>
                                                <option value="office" @if($key == 'office') selected @endif>Home Office (£6 per week)</option>
                                                <option value="overnight" @if($key == 'overnight') selected @endif>Overnight (£25 per night)</option>
                                                <option value="toll" @if($key == 'toll') selected @endif>Toll Bridges</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <input type="text" name="value[]" placeholder="£" class="form-control" value="{{$value}}">
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="mb-4">
                                    <button type="button" class="add-expense btn btn-secondary">Add Another Expense</button>
                                </div>
                            </div>
                            
                            <h4 class="text-primary">Options</h4>
                            <div class="form-group mb-4">
                                <label for="accountants">Accounts</label>
                                <select name="accountants" id="" class="form-control" disabled>
                                    <option value="0">Not Set</option>
                                    <option value="Hindsight">Hindsight</option>
                                    <option value="Hindsight">Quay Accounts</option>
                                </select>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" @if(!auth()->user()->accountant) disabled @endif>
                                <label class="form-check-label" for="flexCheckChecked">
                                Update Accountants
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

        const additions = document.querySelector('.additions');
        const additionElements = additions.querySelectorAll('.row');
        const addExpenseBtn = document.querySelector('.add-expense');

        addExpenseBtn.addEventListener('click', (e) => {
            element = additionElements[0].cloneNode(true);
            additions.appendChild(element);
        });

    </script>

@endsection