<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Jobs\SubmitTimesheet;
use App\Models\Accountant;

class TimesheetController extends Controller
{
    
    public function index()
    {
        if(auth()->user()->admin == 1){
            $timesheets = Timesheet::all();
        }else{
            $timesheets = Timesheet::whereUserId(auth()->user()->id)->get();
        }
        return view('timesheets.view', compact('timesheets'));
    }

    public function create()
    {
        $accountants = Accountant::all();
        $clients = Client::all();
        return view('timesheets.create', compact('clients', 'accountants'));
    }


    public function store(Request $request)
    {
        $timesheet = new Timesheet;

        $timesheet->user_id = auth()->user()->id;

        $timesheet->week_start = $request->start_date;
        $timesheet->week_end = $request->end_date;

        $shifts = [];
        $mileage = [];
        $shifts_total = 0;
        $wages = 0;

        for($i = 0; $i < 7; $i++){
            
            $day = \Carbon\Carbon::now()->startOfWeek()->subWeek()->addDays($i);

            //if the {day}_field is checked
            $value = strtolower($day->format('l'));
            $shift = "{$value}_shift";
            $arr = [];
            if($request->$shift == 1){
                
                $time = "{$value}_time";
                $arr['shift'] = $request->$time;
                $client = "{$value}_client";
                $arr['client'] = $request->$client;
                $start = "{$value}_start";
                $arr['start'] = $request->$start;
                $end = "{$value}_end";
                $arr['end'] = $request->$end;
                
                $start_time = $day->format('d-m-Y')." ".$request->$start;
                $end_time = $day->format('d-m-Y')." ".$request->$end;
                $type = "{$value}_pay_type";
                $arr['pay_type'] = $request->$type;
                //get the rate variable
                $shift = "{$value}_shift_rate";
                if($request->$type == 'per-hour'){
                    $diffInHours = \Carbon\Carbon::parse($start_time)->diffInHours(\Carbon\Carbon::parse($end_time));
                    $hourly = $request->$shift * $diffInHours;
                    $wages += $hourly;
                }else{
                    $wages += $request->$shift;
                }
                
                $arr['rate'] = $request->$shift;
                
                $arr['date'] = $day->format('Y-m-d');

                $shifts_total++;
            }
        

            $miles = [];
            $from = "{$value}_from_miles";
            $miles['from'] = $request->$from;
            $to = "{$value}_to_miles";
            $miles['to'] = $request->$to;
            $total = "{$value}_total";
            $miles['total'] = $request->$total;

            $shifts[$value] = $arr;
            $mileage[$value] = $miles;
        }

        $expenses = [];
        for($i=0; $i < count($request->expense); $i++){
            $expenses[$request->expense[$i]] = $request->value[$i];
        }


        $timesheet->shifts = json_encode($shifts);
        $timesheet->mileage = json_encode($mileage);
        $timesheet->additional = json_encode($expenses);
        $timesheet->total_shifts = $shifts_total;
        $timesheet->total_wages = $wages;
        $timesheet->comments = $request->comments;
        $timesheet->save();
    
        //The Job for creating the timesheet PDF and sending it to Accountants and Pursuit TMR
        SubmitTimesheet::dispatch($timesheet, 1)->afterResponse();

        if($request->send_receipt == 1){
            SendTimesheet::dispatch($timesheet, 1)->afterResponse();
        }

        if($request->update_accountants == 1 && $request->accountants != 0){
            SendAccountantTimesheet::dispatch($timesheet, 1)->afterResponse();
        }

        $message = "Thank you for submitting your timesheet, it has been sent to Pursuit and to your accountants";
        session()->flash('success_message', $message);

        return redirect(route('timesheets.index'));


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function show(Timesheet $timesheet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function edit(Timesheet $timesheet)
    {
        $accountants = Accountant::all();
        $clients = Client::all();
        return view('timesheets.edit', compact('clients', 'timesheet', 'accountants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timesheet $timesheet)
    {
        $timesheet->week_start = $request->start_date;
        $timesheet->week_end = $request->end_date;

        $shifts = [];
        $mileage = [];
        $shifts_total = 0;
        $wages = 0;

        for($i = 0; $i < 7; $i++){
            
            $day = \Carbon\Carbon::now()->startOfWeek()->subWeek()->addDays($i);

            //if the {day}_field is checked
            $value = strtolower($day->format('l'));
            $shift = "{$value}_shift";
            $arr = [];
            if($request->$shift == 1){
                
                $time = "{$value}_time";
                $arr['shift'] = $request->$time;
                $client = "{$value}_client";
                $arr['client'] = $request->$client;
                $start = "{$value}_start";
                $arr['start'] = $request->$start;
                $end = "{$value}_end";
                $arr['end'] = $request->$end;
                $shift = "{$value}_shift_rate";
                $wages += $request->$shift;
                $arr['rate'] = $request->$shift;
                $arr['pay_type'] = $request->pay_type;
                $arr['date'] = $day->format('Y-m-d');

                $shifts_total++;
            }
        

            $miles = [];
            $from = "{$value}_from_miles";
            $miles['from'] = $request->$from;
            $to = "{$value}_to_miles";
            $miles['to'] = $request->$to;
            $total = "{$value}_total";
            $miles['total'] = $request->$total;

            $shifts[$value] = $arr;
            $mileage[$value] = $miles;
        }

        $expenses = [];
        for($i=0; $i < count($request->expense); $i++){
            $expenses[$request->expense[$i]] = $request->value[$i];
        }

        $timesheet->shifts = json_encode($shifts);
        $timesheet->mileage = json_encode($mileage);
        $timesheet->additional = json_encode($expenses);
        $timesheet->total_shifts = $shifts_total;
        $timesheet->total_wages = $wages;
        $timesheet->comments = $request->comments;
        $timesheet->save();
    
        //The Job for creating the timesheet PDF and sending it to Accountants and Pursuit TMR
        //UpdateTimesheet::dispatch($timesheet, 1)->afterResponse();

        $message = "Thank you for submitting your timesheet, it has been sent to Pursuit and to your accountants";
        session()->flash('success_message', $message);

        return redirect(route('timesheets.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timesheet $timesheet)
    {
        //
    }
}
