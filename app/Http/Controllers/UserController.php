<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Shift;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;

use App\Policies\UserPolicy;
use AWS;
use App\Notifications\NewAccount;

class UserController extends Controller
{
    public function index()
    {
        if(auth()->user()->cant('viewAll', User::class))
        {
            return abort(403, 'Unauthorized Access to the Users');
        }

        $users = User::all();
        return view('users.view', compact('users'));
    }

    public function create()
    {
        if(auth()->user()->cant('viewAll', User::class))
        {
            return abort(403, 'Unauthorized - Create Users');
        }
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        if(auth()->user()->cant('viewAll', User::class))
        {
            return abort(403, 'Unauthorized - Create Users');
        }

        $validation = $request->validate([
            "first_name" => "required|max:255",
            "last_name" => "required|max:255",
            "phone" => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'required|unique:users|email:rfc,dns,spoof,filter',
            'address_1' => 'required',
            'city' =>'required',
            'postcode' => 'required',
            'admin' => 'required'
        ]);
        $role = Role::firstOrCreate(array('name' => $request->role));
        $user = new User;
        $unhash = $user->random_password(12);
        $password = Hash::make($unhash);
        if($user->fill([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone, 
            'email' => $request->email,  
            'address_1' => $request->address_1,  
            'address_2' => $request->address_2,  
            'city' => $request->city,  
            'postcode' => $request->postcode,  
            'photo_id' => $request->photo_id,  
            'role_id' => $role->id ?? 0,  
            'password' => $password,
            'admin' => $request->admin
        ])->save()){
            session()->flash('success_message', 'User has been successfully created!');
            return redirect(route('users.index'));
        }else{
            session()->flash('error_message', 'There was an error! please try');
            return redirect(route('users.create'));
        }

    }

    public function show(User $user)
    {
        if(auth()->user()->cant('viewAll', User::class))
        {
            return abort(403, 'Unauthorized - View User');
        }

        $shifts = Shift::whereUserId($user->id);
        return view('users.show', compact('user', 'shifts'));
    }

    public function edit(User $user)
    {
        if(auth()->user()->cant('viewAll', User::class))
        {
            return abort(403, 'Unauthorized - Edit Users');
        }

        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        if(auth()->user()->cant('viewAll', User::class))
        {
            return abort(403, 'Unauthorized - Update Users');
        }

        $validation = $request->validate([
            "first_name" => "required|max:255",
            "last_name" => "required|max:255",
            "phone" => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => ['required', \Illuminate\Validation\Rule::unique('users')->ignore($user->id), 'email:rfc,dns,spoof,filter'],
            'address_1' => 'required',
            'city' =>'required',
            'postcode' => 'required',
            'admin' => 'required'
        ]);
        $role = Role::firstOrCreate(array('name' => $request->role));
        $user->fill(array_merge(
            $request->only('first_name', 'last_name', 'phone', 'email', 'address_1', 'address_2', 'city', 'post_code', 'admin', 'photo_id', 'role_id'),
            ['role_id' => $role->id]
        ))->save();
      
        session()->flash('success_message', $user->fullname() . ' has been updated successfully');

        return redirect(route('users.index'));


    }

    public function destroy(User $user)
    {
        if(auth()->user()->cant('viewAll', User::class))
        {
            return abort(403, 'Unauthorized - Delete Users');
        }
        
        $name = $user->fullname();
        $user->delete();
        //Mail::to('apollo@clpt.co.uk')->send(new \App\Mail\DeletedUser(auth()->user(), $name));
        session()->flash('danger_message', $name . ' was deleted from the system');

        return redirect(route('users.index'));
    }

    public function viewDate(Request $request){
        $date = \Carbon\Carbon::parse($request->date);
        
        $output = "";

        if($shift = auth()->user()->has_shift($date->format('Y-m-d'))){
            $output .= "<h3>{$shift->client->name}</h3>";
            $output .= "<p>Shift: {$shift->client->start_time} - {$shift->client->end_time}</p>";
            $output .= "<p>Report to: {$shift->contact_name}</p>";
            $output .= "<p>{$shift->details}</p>";
            $output .= "<p>Rate: £{$shift->rate}</p>";
            if($shift->status == 1){
                $output .= "<p>Accepted on ".\Carbon\Carbon::parse($shift->response_date)->format('d-m-Y \a\t H:i')."</p>";
            }elseif($shift->status == 2){
                $output .= "<p>Rejected on ".\Carbon\Carbon::parse($shift->response_date)->format('d-m-Y \a\t H:i')."</p>";
            }else{
                $output .= "<p><a href='#'>Awaiting Response</a></p>";
            }
        }

        $availability = auth()->user()->availability($date->format('Y-m-d'));
        $output .= "<hr>";
        $output .= "<h4>Availability</h4>";
        if($availability->unavailable() == true){
            $output .= "<div class='calendar-availability bg-danger text-white'>";
            $output .= "<i class='fas fa-times'></i> <span class='d-inline d-md-none d-xl-inline'>Unavailable</span></div>";
        }elseif($availability && $availability->available() == true){
            $output .= "<div class='calendar-availability bg-success text-white'>";
            $output .= "<i class='fas fa-check'></i> <span class='d-inline d-md-none d-xl-inline'>Available</span></div>";
        }else{
            $output .= "<div class='calendar-availability bg-secondary text-white'>";
            $output .= "<i class='fas fa-question'></i> <span class='d-inline d-md-none d-xl-inline'>Unset</span> </div>";
           
        }

        if(auth()->user()->admin == 1){

            $output .= "<table class='table table-responsive'>
                <thead>
                <tr>
                <th>Availabile</th>
                <th>Unavailable</th>
                <th>Unset</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                <td><ul>";

            foreach(\App\Models\Availability::availableFilter($date)->get() as $available){
                $output .= "<li>{$available->user->fullname()}</li>";
            }
            
            $output .= "</ul></td><td></td><td></td></tr>
                </tbody>
            </table>";

            return $output;
        }
    }

    public function newUser($id)
    {
        if(auth()->user()->cant('viewAll', User::class))
        {
            return abort(403, 'Unauthorized - Approve Users');
        }
        $user = User::find($id);
        return view('users.approval', compact('user'));
    }

    public function approveUser($id){
        if(auth()->user()->cant('viewAll', User::class))
        {
            return abort(403, 'Unauthorized - Approve User');
        }

        $user = User::find($id);
        $user->confirmed = 1;
        $user->save();

        $user->notify(new ApprovedAccount());
        //Send an email confirming the Account

        session()->flash('success_message', 'You have approved the User Account. The user may now login and access the differnet features across the paltform.');
        return redirect(route('users.index'));

    }

    public function denyUser(User $user){
        if(auth()->user()->cant('viewAll', User::class))
        {
            return abort(403, 'Unauthorized - Deny User');
        }

        $user->delete();
        session()->flash('danger_message', 'You have denied the User access to the platform - they have been removed from the system');
        return redirect(route('users.index'));

    }


    public function sendSMS($id){
        $user = User::find($id);
        $user->notify(new NewAccount());
    }

}
