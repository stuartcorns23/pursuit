<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account | Pursuit TM Recruitment</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body class="dark-theme">
    <x-layouts.sidebar />
    <x-layouts.topbar />
    
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
            <div class="d-flex justify-content-between w-100">
                @for($i=0; $i<7; $i++)
                <?php
                    $day = $now->startOfWeek()->addDays($i);
                ?>
                <div class="card bg-transparent @if ($day->isToday()) border-success @else border-primary @endif m-2 shadow">
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
    <section class="page-footer">
        Copyright &copy; 2022. All rights reserved
    </section>
    {{-- <div class="d-flex vw-100 vh-100 w-100 align-items-center justify-content-center">
        <div id="holder" class="border p-4 rounded shadow bg-white w-50">
            <div class="p-2 mb-4 text-center">
                <img src="{{ asset('images/pursuit-tmr-1.jpg')}}" alt="Pursuit TMR" width="300px"/>
            </div>
            <div class="row">
                <div class="col-12">
                    You Are Logged in!!
                    <div>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <script src="{{ asset('js/app.js')}}"></script>
</body>
</html>