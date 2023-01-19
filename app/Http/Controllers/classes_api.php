<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\classes;
use App\Models\subjects;

class classes_api extends Controller
{
    public static function get_classes($uid)
    {

        $classes = classes::join('subjects', 'classes.subject_id', '=', 'subjects.subject_id')->
        join('semesters', 'semesters.semester_id', '=', 'subjects.semester_id')->
        join('sub_tech', 'subjects.subject_id', '=', 'sub_tech.subject_id')->
        join('teachers', 'teachers.teacher_id', '=', 'sub_tech.teacher_id')->
        where('teachers.uid',$uid)->
        orderby('classes.date','desc')->
        get(['classes.class_id', 'classes.class_code', 'subjects.subject_name', 'classes.date', 'semesters.semester_name'])->
        toArray();

        return response()->json($classes);
    }
}
