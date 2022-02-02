@extends('layouts.admin')

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
            <?php 
            $now = \Carbon\Carbon::now();
            ?>
            <h3 class="my-5 text-center">Shift for Week Beginning: {{ $now->startOfWeek()->format('jS F Y')}}</h3>
            <div class="d-flex justify-content-between align-items-start flex-column flex-lg-row w-100">
                @for($i=0; $i<7; $i++)
                <?php
                    $day = $now->startOfWeek()->addDays($i);
                ?>
                <div class="day-card card bg-transparent @if ($day->isToday()) border-success @else border-primary @endif shadow">
                    <div class="card-header @if ($day->isToday()) bg-success @else bg-primary @endif text-center text-white">{{ $day->format('l jS M Y') }}</div>
                    <div class="card-body">
                        @if($shift = auth()->user()->has_shift($day->format('Y-m-d')))
                        {{-- Check if there is a Shift Set for today --}}
                        <img src="{{asset('images/signal-tm.png')}}" width="100%" alt="Signal Traffic Management" class="mb-4">
                        {{-- <h5 class="card-title text-center">Signal Traffic Management</h5> --}}
                        
                        <p class="text-center"><span class="fs-5">Start Time:</span><br><span class="fs-3">18:00</span></p>
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
                        @endif
                    </div>
                </div>
                @endfor
            </div>

            <h3 class="my-5 text-center">Availabilty</h3>
            <?php 
            $now = \Carbon\Carbon::now()->addWeek();
            ?>
            <div class="d-flex flex-wrap flex-column flex-sm-row justify-content-between w-100">
                @for($i=0; $i<7; $i++)
                <?php
                    $day = $now->startOfWeek()->addDays($i);
                ?>
                <div class="day-card card bg-transparent @if ($day->isToday()) border-success @else border-primary @endif shadow">
                    <div class="card-header @if ($day->isToday()) bg-success @else bg-primary @endif text-center text-white">{{ $day->format('l jS M Y') }}</div>
                    <div class="card-body text-center">
                        {{-- Check if there is a Shift Set for today --}}
                        <?php
                            $availability = \App\Models\Availability::where('user_id', '=', auth()->user()->id)
                                            ->whereDate('date', $day->format('Y-m-d'))->first();


                        ?>
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
                                class="availabilityBtn btn @if($availability && $availability->unavailable() == true) btn-danger text-white @else btn-secondary text-danger @endif w-100"
                                data-id="{{ auth()->user()->id }}"
                                data-date="{{ $day->format('Y-m-d') }}"
                                data-select="unavailable"
                            >
                                Unavailable
                            </button>
                    </div>
                </div>
                @endfor
            </div>

            <a href="#">Add More Dates</a>

            
        </div>
    </section>

    <section>

    </section>

@endsection

@section('modals')

@endsection

@section('js')

    <script>

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

                xhr.onload = function(e) {
                    //Place the JSON Images into the modal
                    console.log(xhr.responseText);
                }
                xhr.open("POST", `/availability/set`);
                xhr.send(formData);
            });
        });

    </script>

@endsection