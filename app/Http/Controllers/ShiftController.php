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
        return dd($request);

        $date = \Carbon\Carbon::parse($request->date);
        $start = $date->startOfWeek();

        for($i = 0; $i < count($request->user_id); $i++){
            $shift = new Shift;
            $shift->user_id = $request->user_id[$i];
            $shift->date = $date;
            $shift->start_time = $request->start_time;
            $shift->end_time = $request->end_time;
            $shift->client = $request->client_id;
            $shift->contact_name = $request->contact_name;
            $shift->details = $client->details;
            $shift->charge = $request->charge;
            $shift->rate = $request->rate;
            $shift->save();
        }

        if($request->monday == 1){

        }

        #parameters: array:17 [▼
      "_token" => "KyLlbZvcQAwGVtF2DgqP9G9YujZxEoZu5WIQb8aO"
      "date" => "2022-02-10"
      "start_time" => "06:00"
      "end_time" => "16:00"
      "client_id" => "1"
      "contact_name" => "John"
      "details" => "df sdfugjk,dfjghuydflgihlgiuhgo;ihdzfg;odfrihjg d;origjdfgibo jdfig jhdfpg dfpgj dp9fog dfg dfg dfg fg hnj yjmyher Details here..."
      "user_id" => array:2 [▶]
      "charge" => array:2 [▶]
      "rate" => array:2 [▶]
      "monday" => "1"
      "tuesday" => "1"
      "wednesday" => "1"
      "thursday" => "1"
      "friday" => "1"
      "alert" => "1"
      "approve" => "1"
    ]
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
