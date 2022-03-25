<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- Custom styles for this template-->
    <style>
        .container{
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .left-column{
            width: 70%;
             background-color: #cccccc
        }

        .right-column{
            width:30%;
        }

        .expenses thead tr{
            border-bottom: solid 5px #666;
            padding: 10px;
            font-weight: bold;
        }

        .expenses tr{
            border-bottom: solid 1px #666;
            padding:5px;

        }

    </style>
</head>
<body>
     <div class="container">
         <div class="left-column">
            {{-- Hindsight Logo --}}

            <h3>Mileage Log</h3>
            <table>
                <thead>
                    <tr>
                        <th width="25%">Date</th>
                        <th width="25%">From</th>
                        <th width="25%">To</th>
                        <th width="25%">Miles</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $mileage = json_decode($timesheet->mileage);?>
                    @foreach($mileage as $key => $mile)
                    <tr>
                        <td>{{ucFirst($key)}}</td>
                        <td>{{$mile->to}}</td>
                        <td>{{$mile->from}}</td>
                        <td>{{$mile->total}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
         </div>
         <div class="right-column">
            <h2>Expense Claim Form</h2>
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
                    <?php $expenses = json_decode($timesheet->additional);?>
                    <tr>
                        <td width="80%">5 Hour Shift Allowance (£5)</td>
                        <td width="20%">
                            @if(array_key_exists('5hr', $expenses))
                                {{$expenses['5hr']}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Above 5 Hours Shift Allowance (£10)</td>
                        <td width="20%">
                            @if(array_key_exists('5hr+', $expenses))
                                {{$expenses['5hr+']}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">15 Hour Shift Allowance (£25)</td>
                        <td width="20%">
                            @if(array_key_exists('15hr+', $expenses))
                                {{$expenses['15hr+']}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Personal Incident Expenses @ £10 per overnight/nightshift</td>
                        <td width="20%">
                            @if(array_key_exists('PIE', $expenses))
                                {{$expenses['PIE']}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Washing of Workwear (10 MAX)</td>
                        <td width="20%">
                            @if(array_key_exists('wash', $expenses))
                                {{$expenses['wash']}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Home Office @£6.00 per week</td>
                        <td width="20%">
                            @if(array_key_exists('office', $expenses))
                                {{$expenses['office']}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Overnight @ £25.00 per night</td>
                        <td width="20%">
                            @if(array_key_exists('overnight', $expenses))
                                {{$expenses['overnight']}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Toll Bridges</td>
                        <td width="20%">
                            @if(array_key_exists('toll', $expenses))
                                {{$expenses['toll']}}
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
                            @if(array_key_exists('accomodation'))
                                {{$expenses['accomodation']}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Equipment</td>
                        <td width="20%">
                            @if(array_key_exists('equipment'))
                                {{$expenses['equipment']}}
                            @endif    
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Stationary & Postage</td>
                        <td width="20%">
                            @if(array_key_exists('stationary'))
                                {{$expenses['stationary']}}
                            @endif    
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Training</td>
                        <td width="20%">
                            @if(array_key_exists('training'))
                                {{$expenses['training']}}
                            @endif    
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Car/Equipment Hire</td>
                        <td width="20%">
                            @if(array_key_exists('hire'))
                                {{$expenses['hire']}}
                            @endif    
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Purchase of Workwear</td>
                        <td width="20%">
                            @if(array_key_exists('workwear'))
                            {{$expenses['workwear']}}
                        @endif    
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Books & Journals</td>
                        <td width="20%">
                            @if(array_key_exists('books'))
                                {{$expenses['books']}}
                            @endif    
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Parking</td>
                        <td width="20%">
                            @if(array_key_exists('parking'))
                                {{$expenses['parking']}}
                            @endif    
                        </td>
                    </tr>
                    <tr>
                        <td width="80%">Other</td>
                        <td width="20%">
                            @if(array_key_exists('other'))
                                {{$expenses['other']}}
                            @endif    
                        </td>
                    </tr>
                </tbody>
            </table>
            
         </div>
     </div>
</body>
</html>
