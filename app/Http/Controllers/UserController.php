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
        
        $object = [];
        if($availability = auth()->user()->availability($date->format('Y-m-d'))){
           $arr = [];
           $arr['day'] = 1;
           $arr['night'] = 1;
           $object['availability'] = $arr;
        }

        if($shift = auth()->user()->has_shift($date->format('Y-m-d'))){
            $object['shift'] = $shift->toArray();
        }
       
        return json_encode($object);
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
