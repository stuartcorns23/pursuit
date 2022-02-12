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

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.view', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {

        $validation = $request->validate([
            "first_name" => "required|max:255",
            "last_name" => "required|max:255",
            "telephone" => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
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
            'telephone' => $request->telephone, 
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
            /* Mail::to($request->email)->send(new \App\Mail\NewUserPassword($user, $unhash)); */
            session()->flash('success_message', 'User has been successfully created!');
            return redirect(route('users.index'));
        }else{
            session()->flash('error_message', 'User has been successfully created!');
            return redirect(route('users.create'));
        }

    }

    public function show(User $user)
    {
        $shifts = Shift::whereUserId($user->id);
        return view('users.show', compact('user', 'shifts'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        /* if(auth()->user()->cant('update', $user))
        {
            return redirect(route('errors.forbidden', 'You do not have permissions to update the selected user'));
        } */

        $validation = $request->validate([
            "first_name" => "required|max:255",
            "last_name" => "required|max:255",
            "telephone" => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => ['required', \Illuminate\Validation\Rule::unique('users')->ignore($user->id), 'email:rfc,dns,spoof,filter'],
            'address_1' => 'required',
            'city' =>'required',
            'postcode' => 'required',
            'admin' => 'required'
        ]);
        $role = Role::firstOrCreate(array('name' => $request->role));
        $user->fill(array_merge(
            $request->only('first_name', 'last_name', 'telephone', 'email', 'address_1', 'address_2', 'city', 'post_code', 'admin', 'photo_id', 'role_id'),
            ['role_id' => $role->id]
        ))->save();
      
        session()->flash('success_message', $user->fullname() . ' has been updated successfully');

        return redirect(route('users.index'));


    }

    public function destroy(User $user)
    {/* 
        if(auth()->user()->cant('delete', $user))
        {
            return redirect(route('errors.forbidden', 'You either don\'t have permission to remove this user or you are trying to remove yourself!'));
        } */

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
}
