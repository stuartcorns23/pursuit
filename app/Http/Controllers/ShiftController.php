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
        if(auth()->user()->admin == 1){
            $shifts = Shift::all();
        }else{
            $shifts = Shift::whereUserId(auth()->user()->id)->get();
        }
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
                    $shift->pay_type = $request->pay_type;
                    $shift->status = 0;
                    if($request->approved == 1){
                        $shift->status = 1;
                        $shift->responded_date = \Carbon\Carbon::now();
                    }
                    
                    $shift->save();
                }
            }
        }

        $users = User::whereIn('id', $request->user_id)->get(); 

        if($request->alert == 1){
            //UPdate the user suing a notifcation
            
            
            foreach($users as $user){
            
                $user->notify(new TextNewShift());
                \Notification::route('mail', $user->email)->notifyNow(new EmailNewShift());
                /* Mail::to($user->email)
                    ->send(new EmailNewShift()); */
            }
        }

        if($users->count() > 1){
            $msg = "Shifts were created for {$users->count()} users";
        }else{
            $msg = "Shifts were created for {$users[0]->fullname()}";
        }

        session()->flash('success_message', $msg);
        return redirect(route('shifts.index'));

    }

    public function show(Shift $shift)
    {
        $clients = Client::all();
        return view('shifts.show', compact('shift', 'clients'));
    }

    public function edit(Shift $shift)
    {
        $clients = Client::all();
        return view('shifts.edit', compact('shift', 'clients'));
    }


    public function update(Request $request, Shift $shift)
    {
        $validation = $request->validate([
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'client_id' => 'required',
            'details' => 'required',
            'rate' => 'required',
        ]);

        $shift->fill($request->only('date', 'start_time', 'finish_time', 'client_id', 'details', 'contact_name', 'charge', 'rate', 'pay_type'))->save();
        session()->flash('success_message', "The shift for {$shift->user->fullname()} has been updated!");
        return redirect(route('shifts.index'));
    }

    public function destroy(Shift $shift)
    {
        //
    }

    public function accept(Shift $shift)
    {
        $shift->status = 1;
        $shift->responded_date = \Carbon\Carbon::now();
        $shift->save();

        session()->flash('success_message', 'You have accepted the shift. Click the shift to view more details');
        return redirect(route('shifts.index'));
    }

    public function reject(Shift $shift)
    {
        $shift->status = 2;
        $shift->responded_date = \Carbon\Carbon::now();
        $shift->save();



        session()->flash('danger_message', 'You have rejected the shift. Someone from Pursuit will be in contact shortly or email info@pursuit-tmr.co.uk to give reasons for your decsion');
        return redirect(route('shifts.index'));
    }
}
