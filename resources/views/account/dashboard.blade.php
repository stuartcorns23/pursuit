@extends('layouts.app')

@section('title', 'Dashboard | Pursuit TMR')
   
@section('css')

@endsection

@section('content')
    <section class="page-wrapper">
        <div class="page-content">
            <h1 class="text-center mb-4">Dashboard</h1>
            <h3>Welcome {{auth()->user()->first_name}},</h3>
            <p>This is your personal Pursuit TMR dashboard, below you have your shifts for the current week and the your availabilty for next
                (If you have not yet submitted your availabilty for next week please do so as soon as possible, this will give us the best 
                chance to provide you with a full week of work). We also displayed some statistics about your shift availability and completion.
            </p>
            <h3 class="mb-3">Shift for Week Beginning: </h3>
            <?php 
            $now = \Carbon\Carbon::now();
            ?>
            <div class="d-flex justify-content-between align-items-center flex-column flex-lg-row w-100">
                @for($i=0; $i<7; $i++)
                <?php
                    $day = $now->startOfWeek()->addDays($i);
                ?>
                <div class="card bg-transparent @if ($day->isToday()) border-success @else border-primary @endif m-2 shadow mw-50">
                    <div class="card-header @if ($day->isToday()) bg-success @else bg-primary @endif text-center text-white">{{ $day->format('l jS M Y') }}</div>
                    <div class="card-body">
                        {{-- Check if there is a Shift Set for today --}}
                        <img src="{{asset('images/signal-tm.png')}}" width="100%" alt="Signal Traffic Management" class="mb-4">
                        {{-- <h5 class="card-title text-center">Signal Traffic Management</h5> --}}
                        
                        <p class="text-center"><span class="fs-5">Start Time:</span><br><span class="fs-3">18:00</span></p>
                        <div class="text-center mb-4">
                            <a href="#" class="btn btn-primary text-center">More Details</a>
                        </div>
                        <div class="p-2 text-center">
                            @if($day->isPast())
                            <i class="fas fa-check-circle text-success"></i> Accepted on {{$day->format('d/m/y')}}
                            @else
                            &nbsp;<i class="fas fa-times-circle text-danger"></i>
                            @endif
                        </div>
                    </div>
                </div>
                @endfor
            </div>

            <h3 class="mb-3">Availabilty</h3>
            <?php 
            $now = \Carbon\Carbon::now()->addWeek();
            ?>
            <div class="d-flex flex-wrap justify-content-between w-100">
                @for($i=0; $i<7; $i++)
                <?php
                    $day = $now->startOfWeek()->addDays($i);
                ?>
                <div class="col-auto card bg-transparent @if ($day->isToday()) border-success @else border-primary @endif m-2 shadow">
                    <div class="card-header @if ($day->isToday()) bg-success @else bg-primary @endif text-center text-white">{{ $day->format('l jS M Y') }}</div>
                    <div class="card-body">
                        {{-- Check if there is a Shift Set for today --}}
                        <div>
                            <i class="fas fa-check-circle text-success"></i>&nbsp;<i class="fas fa-times-circle text-danger"></i>
                        </div>
                    </div>
                </div>
                @endfor
            </div>

            
        </div>
    </section>

    <section>

    </section>

@endsection

@section('modals')

@endsection

@section('js')

@endsection