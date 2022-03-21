<?php

namespace App\Http\Controllers;

use App\Models\Accountant;
use Illuminate\Http\Request;

class AccountantController extends Controller
{
    
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required',
            'address_1' => 'required',
            'city' => 'required',
            'postcode' => 'required',
            'telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'required|unique:users|email:rfc,dns,spoof,filter',
        ]);

        $accountant = new Accountant;
        $account->fill([
            'name' => $request->name,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'city' => $request->city,
            'postcode' => $request->postcode,
            'telephone' => $request->telephone,
            'email' => $request->email,
        ])->save();

        session()->flash('success_message', 'You have successfully added an Accountant to the system');
        return redirect(route('settings.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Accountant  $accountant
     * @return \Illuminate\Http\Response
     */
    public function show(Accountant $accountant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Accountant  $accountant
     * @return \Illuminate\Http\Response
     */
    public function edit(Accountant $accountant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Accountant  $accountant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accountant $accountant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Accountant  $accountant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accountant $accountant)
    {
        //
    }
}
