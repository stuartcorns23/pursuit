<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- Custom styles for this template-->
    <style>
        table {
        caption-side: bottom;
        border-collapse: collapse;
        }

        .table {
        --bs-table-bg: transparent;
        --bs-table-accent-bg: transparent;
        --bs-table-striped-color: #212529;
        --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
        --bs-table-active-color: #212529;
        --bs-table-active-bg: rgba(0, 0, 0, 0.1);
        --bs-table-hover-color: #212529;
        --bs-table-hover-bg: rgba(0, 0, 0, 0.075);
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        vertical-align: top;
        border-color: #dee2e6;
        }

        .table-bordered > :not(caption) > * {
        border-width: 1px 0;
        }
        .table-bordered > :not(caption) > * > * {
        border-width: 0 1px;
        }

        .expenses thead tr{
            border-bottom: solid 5px #47b0e3;
            padding: 10px;
            font-weight: bold;
        }

        .expenses tr{
            border-bottom: solid 1px #47b0e3;
            padding:5px;
        }

        .main-text{
            color: #47b0e3;
        }

        .header{
            text-transform: uppercase;
        }

    </style>
</head>
<body>
            {{-- Hindsight Logo --}}
            <header id="header">
                <table width="100%"></i>
                    <tr>
                        <td align="left"><h1>{{$timesheet->user->company_name ?? $timesheet->user->fullname()}}</h1></td>
                        <td align="right" style="padding-right: 10px;">
                            <?php 
                            $start = \Carbon\Carbon::parse($timesheet->week_start);
                            $end = \Carbon\Carbon::parse($timesheet->week_end);
                            ?>
                            Week {{$start->format('W')}}: {{ $start->format('d-m-Y')}} to {{ $end->format('d-m-Y')}}<br>Operative: {{$timesheet->user->fullname()}}
                        </td>
                    </tr>
                </table>
            </header>
            <h3>Mileage Log</h3>
            <table width="100%" class="table table-bordered expenses">
                <thead style="background-color: #47b0e3; color: #FFF">
                    <tr style="border-bottom: solid 5px #47b0e3">
                        <th width="25%">Date</th>
                        <th width="25%">From</th>
                        <th width="25%">To</th>
                        <th width="25%">Miles</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $mileage = json_decode($timesheet->mileage); $total_miles = 0?>
                    @foreach($mileage as $key => $mile)
                    @php($total_miles += $mile->total)
                    <tr>
                        <td>{{ucFirst($key)}}</td>
                        <td>{{$mile->to}}</td>
                        <td>{{$mile->from}}</td>
                        <td>{{$mile->total}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Total Miles</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>45ppm/25ppm</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>£</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            <table style="background-color: #47b0e3; color: #FFF">
                <tr>
                    <td class="50%">Company Name:</td>
                    <td>{{$timesheet->user->company_name ?? $timesheet->user->fullname()}}</td>
                </tr>
                <tr>
                    <td class="50%">Agency:</td>
                    <td>Pursuit Traffic Management Recruitment Ltd</td>
                </tr>
                <tr>
                    <td class="50%">Week Ending:</td>
                    <td>{{ $end->format('d-m-Y')}}</td>
                </tr>
            </table>

            <hr>
            <h2 class="main-text header">Expense Claim Form</h2>
            <div class="date">
                {{-- Date gets enetered here --}}
            </div>

            <table class="expenses">
                <thead>
                    <tr>
                        <th colspan="2">Non-Receipted Claims</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $expenses = json_decode($timesheet->additional, true);?>
                    <tr>
                        <td width="80%">5 Hour Shift Allowance (£5)</td>
                        <td width="20%">
                            @if(array_key_exists('5hr', $expenses))
                                £{{$expenses['5hr']}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Above 5 Hours Shift Allowance (£10)</td>
                        <td width="20%">
                            @if(array_key_exists('5hr+', $expenses))
                                £{{$expenses['5hr+']}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">15 Hour Shift Allowance (£25)</td>
                        <td width="20%">
                            @if(array_key_exists('15hr+', $expenses))
                                £{{$expenses['15hr+']}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Personal Incident Expenses @ £10 per overnight/nightshift</td>
                        <td width="20%">
                            @if(array_key_exists('PIE', $expenses))
                                £{{$expenses['PIE']}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Washing of Workwear (10 MAX)</td>
                        <td width="20%">
                            @if(array_key_exists('wash', $expenses))
                                £{{$expenses['wash']}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Home Office @£6.00 per week</td>
                        <td width="20%">
                            @if(array_key_exists('office', $expenses))
                                £{{$expenses['office']}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Overnight @ £25.00 per night</td>
                        <td width="20%">
                            @if(array_key_exists('overnight', $expenses))
                                £{{$expenses['overnight']}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Toll Bridges</td>
                        <td width="20%">
                            @if(array_key_exists('toll', $expenses))
                                £{{$expenses['toll']}}
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>

            <table>
                <thead>
                    <tr>
                        <th colspan="2">Receipted Claims</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="80%">Accomodation</td>
                        <td width="20%">
                            @if(array_key_exists('accomodation', $expenses))
                                £{{$expenses['accomodation']}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Equipment</td>
                        <td width="20%">
                            @if(array_key_exists('equipment', $expenses))
                                £{{$expenses['equipment']}}
                            @endif    
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Stationary & Postage</td>
                        <td width="20%">
                            @if(array_key_exists('stationary', $expenses))
                                £{{$expenses['stationary']}}
                            @endif    
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Training</td>
                        <td width="20%">
                            @if(array_key_exists('training', $expenses))
                                £{{$expenses['training']}}
                            @endif    
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Car/Equipment Hire</td>
                        <td width="20%">
                            @if(array_key_exists('hire', $expenses))
                                £{{$expenses['hire']}}
                            @endif    
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Purchase of Workwear</td>
                        <td width="20%">
                            @if(array_key_exists('workwear', $expenses))
                            £{{$expenses['workwear']}}
                        @endif    
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Books & Journals</td>
                        <td width="20%">
                            @if(array_key_exists('books', $expenses))
                                £{{$expenses['books']}}
                            @endif    
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Parking</td>
                        <td width="20%">
                            @if(array_key_exists('parking', $expenses))
                                £{{$expenses['parking']}}
                            @endif    
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Other</td>
                        <td width="20%">
                            @if(array_key_exists('other', $expenses))
                                £{{$expenses['other']}}
                            @endif    
                        </td>
                    </tr>
                </tbody>
            </table>
            
        </td>
    </tr>
</table>
</body>
</html>
