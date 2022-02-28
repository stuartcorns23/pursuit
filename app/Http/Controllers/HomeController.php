<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\Type;

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
        $nextWeekEnd = \Carbon\Carbon::now()->subWeek()->endOfWeek();
        $timesheets = auth()->user()->timesheets()->where('week_end', '=', $nextWeekEnd->format('Y-m-d'))->count();
        $types = Type::all();
        if(auth()->user()->confirmed === 1){
            return view('account.dashboard', compact('timesheets', 'types'));
        }else{
            return view('account.confirm', compact('timesheets'));
        }
        
    }
}
