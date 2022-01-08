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
<body class="">
    <sidebar class="sidebar-wrapper py-2">
        <div class="logo d-flex w-100 justify-content-center align-items-center">
            <img src="{{asset('images/pursuit-icon.svg')}}" width="100%" style="max-width: 100px;">
        </div>
    </sidebar>
    <section class="topbar d-flex justify-content-between align-items-center">
        <div class="w-100 d-flex align-items-center justify-content-between">
            <div class="p-2">
                Options
            </div>
            <div class="d-flex justify-content-between align-items-center norder-left border-light">
                <div class="bg-light rounded-circle border border-light" style="width: 40px; height: 40px; margim-right: 10px">

                </div>
                <div>
                    {{ auth()->user()->fullname()}}<br>
                    {{ 'TM Operative'}}
                </div>
            </div>
        </div>
    </section>
    <section class="page-wrapper">
        <div class="page-content">
            <h1>Dashboard</h1>
            <h2>Shifts</h2>
            <?php 
            $now = \Carbon\Carbon::now();
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
                        <h5 class="card-title">Signal Traffic Management</h5>
                        <p class="card-text">
                            Hoobrook Industrial Estate<br>
                            Worcester Road<br>
                            Kidderminster<br>
                            DY10 1HY
                        </p>
                        <p>Start Time: 18:00</p>
                        <a href="#">More Details</a>
                        <div>
                            <i class="fas fa-check-circle text-success"></i>&nbsp;<i class="fas fa-times-circle text-danger"></i>
                        </div>
                    </div>
                </div>
                @endfor
            </div>

            <h2>Availabilty</h2>
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
</body>
</html>