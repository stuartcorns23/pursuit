@extends('layouts.app')

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

                        <div class="border  calendar-cell border-light">
                            <div class="calendar-number">
                                {{$i}}
                            </div>
                            {{-- If the USer has a shift --}}
                            @if(auth()->user()->has_shift($year.'-'.$date->format('m').'-'.$i))
                            <span class="badge bg-info">
                                Shift at Signal Traffic Management
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
                            @if($available != 0)
                            <span class="badge bg-success">
                                {{$available}} Operatives Available
                            </span>
                            @endif
                            {{-- State the Operatives Unavailable --}}
                            <?php 
                                $unavailable = \App\Models\Availability::where('day', '=', 0)
                                                                    ->where('night', '=', 0)
                                                                    ->whereDate('date', $year.'-'.$date->format('m').'-'.$i)
                                                                    ->count();
                            ?>
                            @if($unavailable != 0)
                            <span class="badge bg-warning">
                                {{$unavailable}} Operative Unavailable
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
            <div class="modal-body text-dark">
                <h3>Your Shift Details:</h3>
                <table>
                    <tr>
                        <td>Client</td>
                        <td>Signal Traffic Management</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>Holbrook Road. Kidderminster. DY10 0SF</td>
                    </tr>
                    <tr>
                        <td>Start Time</td>
                        <td>18:00</td>
                    </tr>
                    <tr>
                        <td>End Time</td>
                        <td>6:00</td>
                    </tr>
                    <tr>
                        <td>Rate</td>
                        <td>£110.00</td>
                    </tr>
                    <tr>
                        <td colspan="2"><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. 
                            The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', 
                            making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a 
                            search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, 
                            sometimes on purpose (injected humour and the like).</p>
                        </td>
                    </tr>
                </table>
                <hr>
                Operative Aailability
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
    let calendarCells = document.querySelectorAll(".calendar-cell:not(.nullDay)");

    calendarCells.forEach(item => {
        item.addEventListener('click', function(){
            /* Get information on the date that is passed to the Controller */
            detailsModal.show();
        })
    });

</script>
@endsection