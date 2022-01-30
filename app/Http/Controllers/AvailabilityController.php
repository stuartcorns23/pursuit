<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{

    public function set(Request $request){

        $availability = new Availability;
        $availability->user_id = $request->user_id; 
        $availability->date = $request->date; 
        if($request->select == 'am'){
            $availability->day = 1;
            $availability->night = 0;
        }elseif($request->select == 'pm'){
            $availability->day = 0;
            $availability->night = 1;
        }
        elseif($request->select == 'both'){
            $availability->day = 1;
            $availability->night = 1;
        }
        elseif($request->select == 'unavailable'){
            $availability->day = 0;
            $availability->night = 0;
        }
        $availability->save();

        return true;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($month, $year)
    {
       
        $date = \Carbon\Carbon::parse("{$month}/01/{$year}");
        $prevMonth = \Carbon\Carbon::parse("{$month}/01/{$year}")->subMonth();
        $nextMonth = \Carbon\Carbon::parse("{$month}/01/{$year}")->addMonth();

        $availability = Availability::all();
        return view('availability.view', compact('availability', 'date', 'nextMonth', 'prevMonth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
