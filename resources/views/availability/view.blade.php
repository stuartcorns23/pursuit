@extends('layouts.admin')

@section('title', 'Users | Pursuit TMR')

@section('css')

@endsection

@section('content')
<section class="page-wrapper">
    <div class="page-content">
        <div class="w-100 d-flex justify-content-between align-items-center flex-column flex-lg-row">
            <h1 class="text-center mb-4 order-2 order-lg-1">Schedule</h1>
            <div class="p-2 order-1 order-lg-2">
                @can('viewAll', auth()->user())
                <a href="{{route('users.create')}}" class="btn btn-success">Add Availability</a>
                <a href="{{route('users.create')}}" class="btn btn-secondary">Download Month Schedule</a>
                <a href="{{route('users.create')}}" class="btn btn-light">Help</a>
                @endcan
            </div>
        </div>
        @if(session('danger_message'))
            <div class="alert alert-danger"> {!! session('danger_message')!!} </div>
        @endif

        @if(session('success_message'))
            <div class="alert alert-success"> {!!session('success_message')!!} </div>
        @endif

        <p class="fs-5">Here are all of the users within the application</p>

        <div class="w-100">
            <div class="d-flex justify-content-between flex-column flex-lg-row align-items-center">
                <h3>{{ $date->format('F Y')}}</h3>
                <div class="p-2">
                    <a class="btn btn-primary" href="{{ route('availability.index', [$prevMonth->format('m'), $prevMonth->format('Y')])}}">{{ $prevMonth->format('F Y')}}</a>
                    <a class="btn btn-primary" href="{{ route('availability.index', [$nextMonth->format('m'), $nextMonth->format('Y')])}}">{{ $nextMonth->format('F Y')}}</a>
                </div>
            </div>
            
            <?php
                $count = 0;
                $now = \Carbon\Carbon::now()->format('j');
                $startDay = $date->startOfMonth()->format('w');
                $start = $date->startOfMonth()->format('j');
                
                $end = $date->endOfMonth()->format('j');
                $year = $date->format('Y');
            ?>
            <div class="calendar">
                <div class="calendar-row d-none d-lg-flex">
                    <div class="border border-light calendar-header">
                        Monday
                    </div>
                    <div class="border border-light calendar-header">
                        Tuesday
                    </div>
                    <div class="border border-light calendar-header">
                        Wednesday
                    </div>
                    <div class="border border-light calendar-header">
                        Thursday
                    </div>
                    <div class="border border-light calendar-header">
                        Friday
                    </div>
                    <div class="border border-light calendar-header">
                        Saturday
                    </div>
                    <div class="border border-light calendar-header">
                        Sunday
                    </div>
                </div>

                
                <div class="calendar-row">
                    @for($sd = 1; $sd < $startDay; $sd++)
                        <div class="border border-light calendar-cell nullDay d-none d-md-inline-block">
                            -
                        </div>
                        @php($count++)
                    @endfor


                    @for($i = $start; $i <= $end; $i++)                        
                        <?php
                        $day = \Carbon\Carbon::parse($year.'-'.$date->format('m').'-'.$i);
                        $availability = \App\Models\Availability::where('user_id', '=', auth()->user()->id)
                                        ->whereDate('date', $day->format('Y-m-d'))->first();
                        ?>      
                        <div class="border calendar-cell border-light" data-date="{{$day->format('Y-m-d')}}" >
                                
                            {{-- Check to see if the user has made availability --}}
                            <div class="d-flex justify-content-between align-items-start flex-row flex-xl-row">
                                <div class="calendar-number" style="margin-right: 5px;">
                                    <span class="d-none d-md-inline-block ">{{$i}}</span>
                                    <span class="d-inline-block d-md-none">{{$day->format('D jS')}}</span>
                                    <span class="d-inline-block d-md-none">{{$day->format('M Y')}}</span>
                                </div>
                                @if($shift = auth()->user()->has_shift($year.'-'.$date->format('m').'-'.$i))
                                <div class="calendar-availability bg-primary text-white">
                                    <i class="fas fa-times"></i> <span class="d-inline d-md-none d-xl-inline">Assigned</span>
                                </div>
                                @else
                                    @if($availability && $availability->unavailable() == true)
                                    <div class="calendar-availability bg-danger text-white">
                                        <i class="fas fa-times"></i> <span class="d-inline d-md-none d-xl-inline">Unavailable</span>
                                    </div>
                                    @elseif($availability && $availability->available() == true)
                                    <div class="calendar-availability bg-success text-white">
                                        <i class="fas fa-check"></i> <span class="d-inline d-md-none d-xl-inline">Available</span></div>
                                    @else
                                    <div class="calendar-availability bg-secondary text-white">
                                        <i class="fas fa-question"></i> <span class="d-inline d-md-none d-xl-inline">Unset</span>
                                    </div>
                                    @endif
                                @endif
                            </div>
                        
                            

                            {{-- If the USer has a shift --}}
                            @if($shift = auth()->user()->has_shift($year.'-'.$date->format('m').'-'.$i))
                            <span class="badge d-block fs-5 mb-1" style="background-color: {{ $shift->client->icon_color ?? '#333'}}; color: {{$shift->client->text_color ?? '#FFF'}}">
                                <i class="fas fa-hard-hat"></i> <span class="d-inline d-md-none d-xl-inline">{{ str_replace('Traffic Management', 'TM', $shift->client->name) }}</span>
                            </span>
                            @endif
                            {{-- If the User is an admin--}}
                
                            {{-- State the Operative Available --}}
                            <?php 
                                $available = \App\Models\Availability::where('day', '=', 1)
                                                                    ->whereDate('date', $year.'-'.$date->format('m').'-'.$i)
                                                                    ->orWhere('night', '=', 1)
                                                                    ->whereDate('date', $year.'-'.$date->format('m').'-'.$i)
                                                                    ->count(); 
                            ?>

                            @if(auth()->user()->admin == 1)

                            <span class="p-2 text-center small badge bg-warning text-dark mb-1">
                                Ops: {{$available}} Available
                            </span>
                            <br>
                            <span class="p-2 text-center small badge bg-primary">
                                Shifts: {{$available}} Assigned
                            </span>

                            @endif
                            
                            @if("{$i}/{$date->format('m')}/{$year}" == \Carbon\Carbon::now()->format('j/m/Y'))
                            <div class="calendar-bar"></div>
                            @endif

                        </div>
                        @php($count++)
                        @if($count >= 7)
                        @php($count = 0)
                            </div>
                            <div class="calendar-row">
                        @endif

                    @endfor

                    @for($ed = $count; $ed < 7; $ed++)
                        <div class="border border-light calendar-cell nullDay d-none d-md-inline-block">
                            -
                        </div>
                        @php($count++)
                    @endfor
                </div>
            </div>
            

        </div>
    </div>
</section>

@endsection

@section('modals')
<!-- Delete Modal-->
<div class="modal fade bd-example-modal-lg" id="dateDetailsModal" tabindex="-1" role="dialog"
    aria-labelledby="dateDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="dateDetailsModalLabel">30th January 2022</h5>
                <button class="btn btn-gray close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div id="dayDetails" class="modal-body text-dark">
                <h3>HTM</h3>
                <p>Shift: 06:00am - 16:00pm
                    <br>Report to: Dean Hollis
                </p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse cum quasi ex odit non laborum exercitationem magni quis aspernatur temporibus, vitae in modi animi distinctio nisi aperiam praesentium blanditiis commodi pariatur inventore aut itaque! Molestias et dolorem at reprehenderit illum deleniti quasi nisi, mollitia magnam consequuntur officiis perferendis quidem, voluptates, excepturi cumque perspiciatis ullam deserunt? Et deleniti repudiandae repellat tenetur.</p>
                <p>Rate: £145.00</p>
                <p>Accepted on 07/02/2022</p>
                <hr>
                <h3>Availability</h3>
                <p>Available</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>

    /* Calendar Functions */
    const detailsModal = new bootstrap.Modal(document.getElementById('dateDetailsModal'), {backdrop: true});
    const dayDetails = document.querySelector("#dayDetails");
    const modalTitle = document.querySelector('.modal-title');
    let calendarCells = document.querySelectorAll(".calendar-cell:not(.nullDay)");

    calendarCells.forEach(item => {
        item.addEventListener('click', function(){
            /* Get information on the date that is passed to the Controller */
            let date = item.getAttribute('data-date');
            let formData = new FormData();
            formData.append('date', date);
            const xhr = new XMLHttpRequest();

            xhr.onload = function(e) {
                //Place the JSON Images into the modal
                console.log(xhr.responseText);
                modalTitle.innerHTML = date;
                //dayDetails.innerHTML = xhr.responseText;
                detailsModal.show();
            }
            xhr.open("POST", `/user/date`);
            xhr.send(formData);

            
        })
    });

</script>
@endsection