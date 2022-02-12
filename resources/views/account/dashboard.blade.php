@extends('layouts.admin')

@section('title', 'Dashboard | Pursuit TMR')
   
@section('css')

@endsection

@section('content')
    <section class="page-wrapper">
        <div class="page-content">
            @if($timesheets === 0)
            <div class="alert alert-danger"> You haven't uploaded a timesheet for last week, please do this know to prevent delay in your payment. <a href="{{route('timesheets.create')}}">Submit Timesheet here</a></div>
            @endif
            <h1 class="text-center mb-4">Dashboard</h1>
            <div class="row mb-4">
                <div class="col-12 col-lg-4 order-1 mb-4 mb-lg-0">
                    <div class="card bg-dark p-4 box">
                        <h3>Welcome {{auth()->user()->first_name}},</h3>
                        <p>This is your personal Pursuit TMR dashboard, below you have your shifts for the current week and the your availabilty for next
                            (If you have not yet submitted your availabilty for next week please do so as soon as possible, this will give us the best 
                            chance to provide you with a full week of work). We also displayed some statistics about your shift availability and completion.
                        </p>
                    </div>
                    
                </div>
                <div class="col-12 col-lg-4 order-2 mb-4 mb-lg-0">
                    <div class="card bg-dark p-4 box">
                        xxx
                    </div>
                </div>
                <div class="col-12 col-lg-4 order-2 order-lg-1 mb-4 mb-lg-0">
                    <div class="card bg-dark p-4 box">
                        <h3 class="text-center">To Do List</h3>
                        <ul class="list-group list-group-flush">
                            {{-- Check to see if there is a Drivers License Uploaded  --}}
                            <li class="list-group-item list-group-item-dark"><i class="fas fa-exclamation-triangle text-danger"></i> Upload Drivers License</li>
                            <li class="list-group-item list-group-item-dark"><i class="fas fa-exclamation-triangle text-danger"></i> Upload OCCY Health Certificate</li>
                            <li class="list-group-item list-group-item-dark"><i class="fas fa-exclamation-triangle text-danger"></i> Upload Lantra Card</li>
                            <li class="list-group-item list-group-item-dark"><i class="fas fa-exclamation-circle text-warning"></i> Update Availability</li>
                        </ul>

                    </div>
                </div>
            </div>
            <?php 
            $now = \Carbon\Carbon::now();
            ?>

            <div class="row mb-4">
                <div class="col-12 col-lg-4 order-1 mb-4 mb-lg-0">
                    <div class="card bg-dark p-4">
                        <h4 class="text-center text-uppercase">Shifts Week Commencing: {{ $now->startOfWeek()->format('d\/m\/Y')}}</h4>
                        <div class="slider">
                            @for($i=0; $i<7; $i++)
                            <?php
                                $day = $now->startOfWeek()->addDays($i);
                            ?>
                            <div class="slide d-flex flex-column justify-content-center align-items-center">
                                @if($shift = auth()->user()->has_shift($day->format('Y-m-d')))
                                {{-- Check if there is a Shift Set for today --}}
                                <div style="max-width: 200px; max-height: 66px;" class="mb-4">
                                    <img src="{{asset('images/signal-tm.png')}}" width="100%" alt="Signal Traffic Management" class="mb-4">
                                </div>
                                {{-- <h5 class="card-title text-center">Signal Traffic Management</h5> --}}
                                
                                <p class="text-center"><span class="fs-5">Start Time: 18:00</span></p>
                                
                                <div class="text-center mb-2 mb-sm-4">
                                    <a href="#" class="btn btn-primary text-center">More Details</a>
                                </div>

                                <div class="text-center p-sm-2">
                                    @if($day->isPast())
                                    <i class="fas fa-check-circle text-success"></i> Accepted on {{$day->format('d/m/y')}}
                                    @else
                                    &nbsp;<i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </div>
                                @else
                                <h5 class="text-center">{{$day->format('l')}}<br>{{$day->format('jS M Y')}}</h5>
                                <p>No Shift Currently Available</p>

                                @endif
                            </div>
                            @endfor
                            <div class="btn btn-left btn-light"><i class="fas fa-chevron-left"></i></div>
                            <div class="btn btn-right btn-light"><i class="fas fa-chevron-right"></i></div>
                        </div>
                    </div>
                </div>
 
                <div class="col-12 col-lg-8 order-2 mb-4 mb-lg-0">
                    <div class="card bg-dark p-4 box position-relative">
                        <h4 class="text-center text-uppercase">Week Availability</h4>
                        <div class="availabilitySlider d-flex justify-content-start align-items-center">
                            
                            
                            @php($nextWeek = $now->addWeek())
                            @for($i=0; $i<7; $i++)
                                <?php
                                    $day = $nextWeek->startOfWeek()->addDays($i);
        
                                    /* {{-- Check if there is a Shift Set for today --}} */
                                
                                    $availability = \App\Models\Availability::where('user_id', '=', auth()->user()->id)
                                                    ->whereDate('date', $day->format('Y-m-d'))->first();
                                ?>
                                <div class="availabilitySlide">
                                    <div class="m-2 p-2">
                                    <h5 class="text-center">{{$day->format('jS M Y')}}</h5>
                                    @if($availability && $availability->unavailable() == true)
                                        <p class="text-center d-block text-danger">Unavailable</p>
                                    @elseif($availability && $availability->available() == true)
                                        <p class="text-center d-block text-success">Available</p>
                                    @else
                                        <p class="text-center d-block text-warning">Not Set</p>
                                    @endif
                                    <div class="btn-group text-center w-100 mb-2" role="group" aria-label="Basic example">
                                        <button 
                                            type="button" 
                                            class="availabilityBtn btn @if($availability && $availability->am() == true) btn-success @else btn-secondary @endif"
                                            data-id="{{ auth()->user()->id }}"
                                            data-date="{{ $day->format('Y-m-d') }}"
                                            data-select="am"
                                        >
                                            AM
                                        </button>
                                        <button 
                                            type="button" 
                                            class="availabilityBtn btn @if($availability && $availability->pm() == true) btn-success @else btn-secondary @endif"
                                            data-id="{{ auth()->user()->id }}"
                                            data-date="{{ $day->format('Y-m-d') }}"
                                            data-select="pm"
                                        >
                                            PM
                                        </button>
                                        <button 
                                            type="button" 
                                            class="availabilityBtn btn @if($availability && $availability->both() == true) btn-success @else btn-secondary @endif"
                                            data-id="{{ auth()->user()->id }}"
                                            data-date="{{ $day->format('Y-m-d') }}"
                                            data-select="both"
                                        >
                                            Both
                                        </button>
                                    </div>
                                    <button 
                                        type="button"
                                        class="availabilityBtn btn @if($availability && $availability->unavailable() == true) btn-danger text-white @else btn-secondary @endif w-100"
                                        data-id="{{ auth()->user()->id }}"
                                        data-date="{{ $day->format('Y-m-d') }}"
                                        data-select="unavailable"
                                    >
                                        Unavailable
                                    </button>
                                </div>
                            </div>
                            @endfor
                            <div class="btn availability-btn-left btn-light"><i class="fas fa-chevron-left"></i></div>
                            <div class="btn availability-btn-right btn-light"><i class="fas fa-chevron-right"></i></div>
                        </div>
                        <div class="position-absolute bottom-0 start-0 end-0 text-center pb-4">
                            <button class="btn btn-secondary">
                                View Schedule
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                
                <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <div class="card bg-dark p-4 box">
                        <h4 class="text-center text-uppercase">Days Available (Per Week)</h4>
                        <div id="availableAmounts"  style="height: 300px;" class="text-white">

                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <div class="card bg-dark p-4 box">
                        <h4 class="text-center text-uppercase">Shifts Assigned (Per Week)</h4>
                        <div id="shiftAmounts" style="height: 300px;">

                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <div class="card bg-dark p-4 box">
                        <h4 class="text-center text-uppercase">Incoming Earnings (Per Week)</h4>
                        <div id="weeklyIncomings" style="height: 300px;">

                        </div>
                    </div>
                </div>

            </div>

            
        </div>
    </section>

    <section>

    </section>

@endsection

@section('modals')

@endsection

@section('js')

    <script>
        'use strict'

        let aBtns = document.querySelectorAll('.availabilityBtn');

        aBtns.forEach(item =>{
            item.addEventListener('click', function(){
                let date = this.getAttribute('data-date');
                let user = this.getAttribute('data-id');
                let select = this.getAttribute('data-select');

                let formData = new FormData();
                formData.append('date', date);
                formData.append('user_id', user);
                formData.append('select', select);

                let xhr = new XMLHttpRequest();

                xhr.onprogress = function(e){
                  //Get the model where the data attribute == the dates
                  let btns = document.querySelectorAll(`[data-date="${date}"]`);
                    btns.forEach((i) => {
                        i.classList.remove('btn-success');
                        i.classList.remove('btn-danger');
                        i.classList.add('btn-secondary');
                        if(i.getAttribute('data-select') === select){
                            select === "unavailable" ? i.classList.add('btn-danger','text-white') : i.classList.add('btn-success');
                        }
                    });
                }

                xhr.onload = function(e) {
                    //Place th JSON Images into the modal
                    console.log(xhr.responsiveText);
                }
                xhr.open("POST", `/availability/set`);
                xhr.send(formData);
            });
        });

        ///Slider Function

        const slides = document.querySelectorAll('.slide');
        const slider = document.querySelector('.slider');
        const btnLeft = document.querySelector('.btn-left');
        const btnRight = document.querySelector('.btn-right');

        let currSlide = new Date().getDay() - 1;
        currSlide < 0 ? currSlide = 6: currSlide;
        const maxSlides = slides.length;

       

        const gotToSlide = function(slide){
            slides.forEach((s, i) => s.style.transform = `translateX(${100 * (i - slide)}%)`);
        }

        const nextSlide = function (){
            if(currSlide === maxSlides - 1){
                currSlide = 0;
            }else{
                currSlide++;
            }
            
            gotToSlide(currSlide);
        }

        const prevSlide = function (){
            if(currSlide === 0){
                currSlide = maxSlides - 1;
            }else{
                currSlide--;
            }
            
            gotToSlide(currSlide);
        }

        gotToSlide(currSlide);

        btnRight.addEventListener('click', nextSlide);
        btnLeft.addEventListener('click', prevSlide);

        const slides2 = document.querySelectorAll('.availabilitySlide');
        const slider2 = document.querySelector('.availabilitySlider');
        const btnLeft2 = document.querySelector('.availability-btn-left');
        const btnRight2 = document.querySelector('.availability-btn-right');
    
        let currSlide2 = 0;
        const maxSlides2 = slides2.length;

       

        const gotToSlide2 = function(slide){
            slides2.forEach((s, i) => s.style.transform = `translateX(${100 * (i - slide)}%)`);
        }

        const nextSlide2 = function (){
            if(currSlide2 === maxSlides2 - 4){
                currSlide2 = 0;
            }else{
                currSlide2++;
            }
            
            gotToSlide2(currSlide2);
        }

        const prevSlide2 = function (){
            if(currSlide2 === 0){
                currSlide2 = maxSlides2 - 4;
            }else{
                currSlide2--;
            }
            
            gotToSlide2(currSlide2);
        }

        gotToSlide2(currSlide2);

        btnRight2.addEventListener('click', nextSlide2);
        btnLeft2.addEventListener('click', prevSlide2);
    </script>
        <!-- Charting library -->
    <script src="https://unpkg.com/chart.js@^2.9.3/dist/Chart.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>

    <script>
        const availableChart = new Chartisan({
            el: '#availableAmounts',
            url: "@chart('available_amounts')",
            loader: {
                color: '#1d71b8',
                size: [30, 30],
                type: 'bar',
                textColor: '#1d71b8',
                text: 'Loading some chart data...',
            },
            hooks: new ChartisanHooks()
                .responsive()
                .colors(['#1d71b8'])
                .datasets([
                    {
                        type: 'line', color: "#ffffff" // text colour
                    }
                ])
                .custom(function ({data, merge, server}) {
                    return merge(data, {
                        options: {
                            scales: {
                                xAxes: [{
                                    gridLines: { color: "#a2a2a2" }, 
                                    ticks: {
                                        fontColor: "white",
                                        stepSize: 1,
                                    }
                                }],
                                yAxes: [{
                                    gridLines: { color: "#a2a2a2" }, 
                                    ticks: {
                                        fontColor: "white",
                                        stepSize: 1,
                                        beginAtZero: true
                                    }
                                }]
                            },
                            legend: {
                                labels: {
                                    fontColor: '#ffffff'
                                }
                            }
                        }
                    })
                })
        });

        const shiftChart = new Chartisan({
        el: '#shiftAmounts',
        url: "@chart('shift_amounts')",
        });
        
        const weekChart = new Chartisan({
        el: '#weeklyIncomings',
        url: "@chart('week_incomings')",
        });

    </script>

@endsection