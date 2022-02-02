@extends('layouts.admin')

@section('title', 'Users | Pursuit TMR')

@section('css')

@endsection

@section('content')
<section class="page-wrapper">
    <div class="page-content">
        <div class="w-100 d-flex justify-content-between align-items-center">
            <h1 class="text-center mb-4">Schedule</h1>
            <div class="p-2">
                @can('viewAll', auth()->user())
                <a href="{{route('users.create')}}" class="btn btn-success">Add New User</a>
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
            <div class="d-flex justify-content-between align-items-center">
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
                <div class="calendar-row">
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
                        <div class="border border-light calendar-cell nullDay">
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
                            @if($availability && $availability->unavailable() == true)
                            <div class="calendar-number bg-danger text-white">{{$i}} Unavailable</div>
                            @elseif($availability && $availability->available() == true)
                            <div class="calendar-number bg-success text-white">{{$i}} Available</div>
                            @else
                            <div class="calendar-number">{{$i}} Unset</div>
                            @endif

                            {{-- If the USer has a shift --}}
                            @if($shift = auth()->user()->has_shift($year.'-'.$date->format('m').'-'.$i))
                            <span class="badge d-block fs-5 mb-1" style="background-color: {{ $shift->client->icon_color ?? '#333'}}; color: {{$shift->client->text_color ?? '#FFF'}}">
                                {{ str_replace('Traffic Management', 'TM', $shift->client->name) }}
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

                            <span class="p-2 text-center small">
                                {{$available}} Ops Available
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
                        <div class="border border-light calendar-cell nullDay">
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
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dateDetailsModalLabel">30th January 2022</h5>
                <button class="btn btn-gray close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div id="dayDetails" class="modal-body text-dark">
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-danger" type="button" id="confirmBtn">Delete</button>
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
                dayDetails.insertAdjacentHTML('afterend', xhr.responseText);
                detailsModal.show();
            }
            xhr.open("POST", `/user/date`);
            xhr.send(formData);

            
        })
    });

</script>
@endsection