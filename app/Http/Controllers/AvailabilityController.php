<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use App\Models\Shift;
use Illuminate\Http\Request;
use App\Models\User;


class AvailabilityController extends Controller
{

    public function set(Request $request){

        $request->select === 'am' || $request->select === 'both' ? $day = 1: $day = 0;
        $request->select === 'pm' || $request->select === 'both' ? $night = 1: $night = 0;
    
        $availability = Availability::updateOrCreate(
            ['user_id' => $request->user_id, 'date' => $request->date],
            ['day' => $day, 'night' => $night]
        );
       
        return true;

    }

    public function check(Request $request){
        $message = '';
        $users = User::where('id', '=', $request->user_id)->get();
        $date = \Carbon\Carbon::parse($request->date);
        $days = explode(',',$request->days);
        foreach($users as $user){
            $unavailable = [];
            $shifts = [];
            for($d=0; $d<7; $d++){
                $start = $date->startOfWeek()->addDays($d);
                $day = strtolower($start->format('l'));
                if(in_array($day, $days)){
                    $availability = Availability::where('user_id', '=', $user->id)
                                ->whereDate('date', $start->format('Y-m-d'))->first();
                    $shift = Shift::where('user_id', '=', $user->id)
                                ->whereDate('date', $start->format('Y-m-d'))->first();
                    if($shift == true){
                        $shifts[] = ucfirst($day);
                    }

                    if($availability && $availability->unavailable() == true){
                        $unavailable[] = ucfirst($day);
                    }
                }
            }
            if(!empty($shifts)){
                $message .= "<li>{$user->fullname()} is already working on ".implode(', ',$shifts)." of this week</li>";
            }
            
            if(!empty($unavailable)){
                $message .= "<li>{$user->fullname()} is unavailable on ".implode(', ',$unavailable)."</li>";
            }
        }

        return "<ul>{$message}</ul>";
    }
   
    public function index($month, $year)
    {
        $date = \Carbon\Carbon::parse("{$month}/01/{$year}");
        $prevMonth = \Carbon\Carbon::parse("{$month}/01/{$year}")->subMonth();
        $nextMonth = \Carbon\Carbon::parse("{$month}/01/{$year}")->addMonth();

        $availability = Availability::all();
        return view('availability.view', compact('availability', 'date', 'nextMonth', 'prevMonth'));
    }

    public function create()
    {
        return view('availability.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Availability  $availability
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Availability $availability)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Availability  $availability
     * @return \Illuminate\Http\Response
     */
    public function destroy(Availability $availability)
    {
        //
    }
}
