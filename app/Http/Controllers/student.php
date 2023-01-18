<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class student extends Controller
{
    public function student_dashboard()
    {
        return view('student/student_dashboard');
    }

}
