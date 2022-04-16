@extends('layouts.admin')

@section('title', 'Availability | Pursuit TMR')

@section('css')

@endsection

@section('content')
<section class="page-wrapper">
    <div class="page-content">
        <form action="{{route('timesheets.store')}}" method="POST">

        <div class="w-100 d-flex justify-content-between align-items-center">
            <h1 class="text-center mb-4">Availability</h1>
            <div class="p-2">
                <div class="p-2">
                    <a href="{{route('dashboard')}}" class="btn btn-secondary"><i class="fas fa-chart-line"></i> <span class="d-none d-sm-inline d-md-none d-lg-inline d-xl-none d-xxl-inline">Back to Dashboard<span></span></a>
                    <a href="{{route('availability.index')}}" class="btn btn-secondary"><i class="fas fa-calendar-alt"></i> <span class="d-none d-sm-inline d-md-none d-lg-inline d-xl-none d-xxl-inline">Back to Calendar</span></a>
                </div>
            </div>
        </div>
        
        <x.handlers-alert :errors="$errors"></x.handlers-alert>

        <p>Complete the following information for hte previous week of work with Pursuit TM Recruitment. </p>
      
            <div class="d-flex justify-content-center">
                <div class="col-12 col-xl-10" >
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="row">
                            @for($i=1;$i<=4;$i++)
                            
                                <div class="col-12 col-md-6 p-4">
                                    @php
                                        $newWeek = \Carbon\Carbon::now()->startOfWeek();
                                        $newWeek->addWeeks($i);
                                    @endphp
                                    <h4 class="mb-2">Week Beginning: {{$newWeek->format("d-m-y")}}</h4>
                                    @for($d=0; $d < 7; $d++)
                                        @php
                                            $day = \Carbon\Carbon::parse($newWeek->format("d-m-Y"))->addDays($d);
                                            $availability = \App\Models\Availability::where('user_id', '=', auth()->user()->id)
                                                    ->whereDate('date', $day->format('Y-m-d'))->first();
                                        @endphp
                                        <table class="table table-striped table-responsive">
                                            <tbody>
                                                <tr>
                                                    <th class="text-start col-3 col-xl-4">
                                                        <span class="d-none d-xl-inline">{{$day->format('l')}}</span>
                                                        <span class="d-inline">{{$day->format('jS')}}</span>
                                                        <span class="d-none d-md-inline">{{$day->format('M')}}</span>
                                                    </th>
                                                    <td class="text-center col-2">
                                                        <button 
                                                            type="button" 
                                                            class="availabilityBtn btn @if($availability && $availability->am() == true) btn-success @else btn-secondary @endif"
                                                            data-id="{{ auth()->user()->id }}"
                                                            data-date="{{ $day->format('Y-m-d') }}"
                                                            data-select="am"
                                                        >
                                                        <i class="fas fa-sun"></i> <span class="d-none d-sm-inline d-md-none d-lg-inline d-xl-none d-xxl-inline">AM</span>
                                                        </button>
                                                    </td>
                                                    <td class="text-center col-2">
                                                        <button 
                                                            type="button" 
                                                            class="availabilityBtn btn @if($availability && $availability->pm() == true) btn-success @else btn-secondary @endif"
                                                            data-id="{{ auth()->user()->id }}"
                                                            data-date="{{ $day->format('Y-m-d') }}"
                                                            data-select="pm"
                                                        >
                                                        <i class="fas fa-moon"></i> <span class="d-none d-sm-inline d-md-none d-lg-inline d-xl-none d-xxl-inline">PM</span>
                                                        </button>
                                                    </td>
                                                    <td class="text-center col-2">
                                                        <button 
                                                            type="button" 
                                                            class="availabilityBtn btn @if($availability && $availability->both() == true) btn-success @else btn-secondary @endif"
                                                            data-id="{{ auth()->user()->id }}"
                                                            data-date="{{ $day->format('Y-m-d') }}"
                                                            data-select="both"
                                                        >
                                                        <i class="fas fa-calendar-day"></i> <span class="d-none d-sm-inline d-md-none d-lg-inline d-xl-none d-xxl-inline">Both</span>
                                                        </button>
                                                    </td>
                                                    <td class="text-center col-3">
                                                        <button 
                                                            type="button"
                                                            class="availabilityBtn btn @if($availability && $availability->unavailable() == true) btn-danger text-white @else btn-secondary @endif w-100"
                                                            data-id="{{ auth()->user()->id }}"
                                                            data-date="{{ $day->format('Y-m-d') }}"
                                                            data-select="unavailable"
                                                        >
                                                        <i class="fas fa-ban"></i> <span class="d-none d-sm-inline d-md-none d-lg-inline d-xl-none d-xxl-inline">Unavailable</span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @endfor
                                </div>
                                
                            @endfor
                            </div>
                        </div>
                    </div>
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
            let btns = document.querySelectorAll(`button[data-date="${date}"]`);
            btns.forEach((i) => {
                i.classList.remove('btn-success');
                i.classList.remove('btn-danger');
                i.classList.add('btn-secondary');
                if(i.getAttribute('data-select') === select){
                    if(select === "unavailable"){
                        i.classList.remove('btn-success');
                        i.classList.add('btn-danger','text-white');
                    }else{
                        i.classList.remove('btn-danger');
                        i.classList.add('btn-success');
                    }
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
</script>

@endsection