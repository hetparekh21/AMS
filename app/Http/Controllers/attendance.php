<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class attendance extends Controller
{
    
    public function class_attendance($class_id){

        echo $class_id ;
        return view('attendance.class_attendance');

    }

}
