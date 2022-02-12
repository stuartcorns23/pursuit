<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Client;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shifts = Shift::all();
        return view('shifts.view', compact('shifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $clients = Client::all();
        return view('shifts.create', compact('users', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $date = \Carbon\Carbon::parse($request->date);
        $success = 0;
        $errors = [];

        for($d=0; $d<7; $d++){
            $start = $date->startOfWeek()->addDays($d);
            $day = strtolower($start->format('l'));
            if($request->$day == 1){
                for($i = 0; $i < count($request->user_id); $i++){
                    $shift = new Shift;
                    $shift->user_id = $request->user_id[$i];
                    $shift->date = $start;
                    $shift->start_time = $request->start_time;
                    $shift->finish_time = $request->end_time;
                    $shift->client_id = $request->client_id;
                    $shift->contact_name = $request->contact_name;
                    $shift->details = $request->details;
                    $shift->charge = $request->charge[$i];
                    $shift->rate = $request->rate[$i];
                    if($request->approved == 1){
                        $shift->status = 1;
                        $shift->responded_date = \Carbon\Carbon::now();
                    }
                    
                    $shift->save();
                }
            }
        }

        if($request->update == 1){
            //UPdate the user suing a notifcation
        }

        session()->flash('success_message', 'Shifts were created for X users');
        return redirect(route('shifts.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function show(Shift $shift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function edit(Shift $shift)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shift $shift)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shift $shift)
    {
        //
    }
}
