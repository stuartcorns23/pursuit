<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use Illuminate\Http\Request;

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
