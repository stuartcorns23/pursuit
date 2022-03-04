<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\Mail;
use AWS;
use App\Notifications\EmailNewShift;
use App\Notifications\TextNewShift;

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

    public function create()
    {
        $users = User::all();
        $clients = Client::all();
        return view('shifts.create', compact('users', 'clients'));
    }

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
                    $shift->status = 0;
                    if($request->approved == 1){
                        $shift->status = 1;
                        $shift->responded_date = \Carbon\Carbon::now();
                    }
                    
                    $shift->save();
                }
            }
        }

        if($request->alert == 1){
            //UPdate the user suing a notifcation
            $users = User::whereIn('id', $request->user_id)->get(); 
            
            foreach($users as $user){
            
                $user->notify(new TextNewShift());
                \Notification::route('mail', $user->email)->notifyNow(new EmailNewShift());
                /* Mail::to($user->email)
                    ->send(new EmailNewShift()); */
            }
        }



        session()->flash('success_message', 'Shifts were created for X users');
        return redirect(route('shifts.index'));

    }

    public function show(Shift $shift)
    {
        //
    }

    public function edit(Shift $shift)
    {
        //
    }


    public function update(Request $request, Shift $shift)
    {
        //
    }

    public function destroy(Shift $shift)
    {
        //
    }

    public function accept(Shift $shift)
    {

    }

    public function reject(Shift $shift)
    {

    }
}
