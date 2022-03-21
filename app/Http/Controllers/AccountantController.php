<?php

namespace App\Http\Controllers;

use App\Models\Accountant;
use Illuminate\Http\Request;

class AccountantController extends Controller
{
    
    ///////////////////////////////////////////
    /////////////View Functions////////////////
    ///////////////////////////////////////////

    public function index()
    {
        $validation = $request->validate([
            'name' => 'required',
            'address_1' => 'required',
            'city' => 'required',
            'postcode' => 'required',
            'telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'required|unique:users|email:rfc,dns,spoof,filter',
        ]);
    }

    public function show(Accountant $accountant)
    {
        //
    }

    ///////////////////////////////////////////
    ////////////// Create Functions ///////////
    ///////////////////////////////////////////

    public function store(Request $request)
    {
        $validation = $request->validate([
            "name" => "required|max:255",
            "telephone" => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'required|unique:users|email:rfc,dns,spoof,filter',
            'address_1' => 'required',
            'city' =>'required',
            'postcode' => 'required',
        ]);

        $accountant = new Accountant;
        $accountant->fill([
            'name' => $request->name,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'city' => $request->city,
            'postcode' => $request->postcode,
            'telephone' => $request->telephone,
            'email' => $request->email,
        ]);
        $accountant->save();

        session()->flash('success_message', $request->name.' has been added successfully!');
        return redirect(route('settings.index'));
    }


    ///////////////////////////////////////////
    ////////////// Create Functions ///////////
    ///////////////////////////////////////////
    
    public function update(Request $request, Accountant $accountant)
    {
        //
    }

    ///////////////////////////////////////////
    ////////////// Delete Functions ///////////
    ///////////////////////////////////////////
    public function destroy(Accountant $accountant)
    {
        //
    }
}
