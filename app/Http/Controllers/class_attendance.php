<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class class_attendance extends Controller
{
    public function index($id)
    {
        echo $id ;
        return view('attendance');
    }
}
