<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Models\Type;
use App\Models\Role;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function index()
    {
        $documents = Type::all();
        $roles = Role::all();
        return view('settings.view', compact('documents', 'roles'));
    }
}
