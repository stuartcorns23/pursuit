<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Photo;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return view('clients.view', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            "name" => "required|max:255",
            "contact" => "required|max:255",
            "telephone" => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'required|unique:users|email:rfc,dns,spoof,filter',
            'address_1' => 'required',
            'city' =>'required',
            'postcode' => 'required',
        ]);
        
        $client = new Client;
        
        if($client->fill([
            'name' => $request->name,
            'contact' => $request->contact,
            'telephone' => $request->telephone, 
            'email' => $request->email,  
            'address_1' => $request->address_1,  
            'address_2' => $request->address_2,  
            'city' => $request->city,  
            'postcode' => $request->postcode,  
            'photo_id' => $request->photo_id
        ])->save()){
            /* Mail::to($request->email)->send(new \App\Mail\NewUserPassword($user, $unhash)); */
            session()->flash('success_message', 'Client has been successfully created!');
            return redirect(route('clients.index'));
        }else{
            session()->flash('danger_message', 'There was an issue, please try again or contact helpdesk@tandonta.com!');
            return redirect(route('clients.create'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $validation = $request->validate([
            "name" => "required|max:255",
            "contact" => "required|max:255",
            "telephone" => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => ['required', \Illuminate\Validation\Rule::unique('clients')->ignore($client->id), 'email:rfc,dns,spoof,filter'],
            'address_1' => 'required',
            'city' =>'required',
            'postcode' => 'required',
        ]);
        $client->fill(
            $request->only('name', 'contact', 'telephone', 'email', 'address_1', 'address_2', 'city', 'post_code', 'photo_id'))->save();
      
        session()->flash('success_message', $client->name . ' has been updated successfully');

        return redirect(route('clients.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $name = $client->name;
        $client->delete();
        //Mail::to('apollo@clpt.co.uk')->send(new \App\Mail\DeletedUser(auth()->user(), $name));
        session()->flash('danger_message', $name . ' was deleted from the system');

        return redirect(route('clients.index'));
    }
}
