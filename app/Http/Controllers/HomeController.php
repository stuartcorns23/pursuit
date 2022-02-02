<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;

class HomeController extends Controller
{
    
    public function index()
    {
        $clients = Client::all();
        return view('welcome', compact('clients'));
    }

    public function login()
    {
        return view('account.login');
    }

    public function staff()
    {
        return view('account.dashboard');
    }
}
