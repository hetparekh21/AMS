<?php

namespace App\Http\Controllers;

use App\Models\courses;
use Illuminate\Http\Request;

class admin extends Controller
{
    public function admin_dashboard()
    {
        return view('admin.admin_dashboard');
    }

    public function admin_course()
    {

        $courses = courses::get(['course_name','course_code','course_id','semesters']);

        return view('admin.admin_course',compact('courses'));
    }
}
