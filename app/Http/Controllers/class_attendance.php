<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class class_attendance extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $user_role = $user->role_id;

        return view('attendance',compact('user_role'));
    }
}
