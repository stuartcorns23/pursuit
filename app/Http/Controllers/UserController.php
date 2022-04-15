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
use App\Notifications\ApprovedAccount;

use App\Models\Accountant;

use App\Jobs\SendUserDetails;

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

        $accountants = Accountant::all();
        $roles = Role::all();
        return view('users.create', compact('roles', 'accountants'));
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
            'company_name' => $request->email,  
            'address_1' => $request->address_1,  
            'address_2' => $request->address_2,  
            'city' => $request->city,  
            'postcode' => $request->postcode,  
            'photo_id' => $request->photo_id,  
            'role_id' => $role->id ?? 0,  
            'password' => $password,
            'admin' => $request->admin,
            'confirmed' => 1,
        ])->save()){

            SendUserDetails::dispatch($user, $unhash)->afterResponse();
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

        $accountants = Accountant::all();
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles', 'accountants'));
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
            $request->only('first_name', 'last_name', 'phone', 'email', 'company_name', 'address_1', 'address_2', 'city', 'postcode', 'admin', 'photo_id', 'role_id', 'accountant_id'),
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
   
        $array = [];

        if($shift = auth()->user()->has_shift($date->format('Y-m-d'))){
            $shift_array = [
                'client_id' => $shift->client->name,
                'contact_name' => $shift->contact_name,
                'start_time' => $shift->start_time,
                'finish_time' => $shift->finish_time,
                'details' => $shift->details,
                'charge' => $shift->charge,
                'rate' => $shift->rate,
                'pay_type' => $shift->pay_type,
                'status' => $shift->status,
                'response_date' => $shift->response_date,
                'completed' => $shift->completed
            ];
            $array['shift'] = $shift_array;
        }
        

        $availability = auth()->user()->availability($date->format('Y-m-d'));
        if($availability && $availability->unavailable() == true){
            $array['availability'] = 'false';
        }elseif($availability && $availability->available() == true){
            $array['availability'] = 'true';
        }

        if(auth()->user()->admin == 1){

            if($avails = \App\Models\Availability::dateFilter($request->date)->availableFilter()->get()){
                $av = [];
                foreach($avails as $available){
                    $av[] = $available->user->fullname();
                }
                if(!empty($av)){
                    $array['available'] = $av;
                }
            }
            

            if($unavails = \App\Models\Availability::dateFilter($request->date)->unavailableFilter()->get()){
                $unav = [];
                foreach($unavails as $unavailable){
                    $unav[$unavailable->user->id] = $unavailable->user->fullname();
                }
                if(!empty($unav)){
                    $array['unavailable'] = $unav;
                }
            }
            
                if(!empty($av) && !empty($unav)){
                $unset = \App\Models\User::count() - count($av) - count($unav);
                $array['unset'] = $unset;
            }
            


            
        }
        return $array;
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

    public function changePassword(User $user){
        return view('users.password', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmNewPassword' => 'required',
        ]);
        $user = auth()->user();
        $hashCheck = \Illuminate\Support\Facades\Hash::check($request->oldPassword, auth()->user()->password);
        $newCheck = $request->newPassword === $request->confirmNewPassword;
        if($hashCheck && $newCheck === true)
        {
            $newPasswordHashed = Hash::make($request->newPassword);
            $user->password = $newPasswordHashed;
            $user->save();
            session()->flash('success_message', auth()->user()->first_name . ', you have successfully updated your Password.');

                   return redirect(route("users.show", $user->id));

        }else{
            return redirect(route("user.change.password", $user->id))
                ->with('danger_message', "Your Password Didn't match your current password please try again!");
        }
    }

    public function storePass(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    
    }

}
