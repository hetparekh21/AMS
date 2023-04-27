<?php

namespace App\Http\Controllers\apis;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\teachers;

class teacher_api extends Controller
{
    public function get_teachers(){

        $teachers = teachers::get(["teacher_id","teacher_name"]);
        return response()->json($teachers);

    }
}
