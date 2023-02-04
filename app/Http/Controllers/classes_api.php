<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\classes;
use App\Models\User;

class classes_api extends Controller
{
    public static function get_all_classes($uid)
    {

        $user_role =  User::where('id', '=', $uid)->get('role_id')->toarray();

        if ($user_role[0]['role_id'] == 1) {

            $classes = classes::join('subjects', 'classes.subject_id', '=', 'subjects.subject_id')->
            join('semesters', 'semesters.semester_id', '=', 'subjects.semester_id')->
            join('sub_tech', 'subjects.subject_id', '=', 'sub_tech.subject_id')->
            join('teachers', 'teachers.teacher_id', '=', 'sub_tech.teacher_id')->
            orderby('classes.date', 'desc')->
            get(['classes.class_id', 'classes.class_code', 'subjects.subject_name', 'classes.date', 'semesters.semester_name'])->
            toArray();

            return response()->json($classes);
        }

        $classes = classes::join('subjects', 'classes.subject_id', '=', 'subjects.subject_id')->
        join('semesters', 'semesters.semester_id', '=', 'subjects.semester_id')->
        join('sub_tech', 'subjects.subject_id', '=', 'sub_tech.subject_id')->
        join('teachers', 'teachers.teacher_id', '=', 'sub_tech.teacher_id')->
        where('teachers.uid', $uid)->orderby('classes.date', 'desc')->
        get(['classes.class_id', 'classes.class_code', 'subjects.subject_name', 'classes.date', 'semesters.semester_name'])->paginate(10);

        
    //    echo $classes->links();

        return response()->json($classes);
        // echo '<pre>';
        // print_r($classes);

        // print_r($classes->links()) ;
    }

    public static function get_classes($uid, $query)
    {

        // $classes = classes::join('subjects', 'classes.subject_id', '=', 'subjects.subject_id')->
        // join('sub_tech', 'subjects.subject_id', '=', 'sub_tech.subject_id')->
        // join('teachers', 'teachers.teacher_id', '=', 'sub_tech.teacher_id')->
        // join('semesters', 'semesters.semester_id', '=', 'subjects.semester_id')->
        // join('courses','courses.course_id','=','subjects.course_id')->

        // where('classes.class_code','like','%'.$query.'%')->
        // // where('teachers.uid',$uid)->
        // orwhere('subjects.subject_name','like','%'.$query.'%')->
        // orwhere('semesters.semester_name','like','%'.$query.'%')->
        // orwhere('courses.course_name','like','%'.$query.'%')->
        // orwhere('classes.date','like','%'.$query.'%')->
        // orwhere('classes.class_id','like','%'.$query.'%')->

        // having('teachers.teacher_id = '.$uid)->
        // get(['teachers.teacher_id','classes.class_id', 'classes.class_code', 'subjects.subject_name', 'classes.date', 'semesters.semester_name'])->
        // toArray();

        $classes = DB::select('SELECT t.teacher_id ,c.class_id, c.class_code, s.subject_name, c.date, se.semester_name from classes c
        INNER JOIN subjects s ON s.subject_id = c.subject_id
        INNER JOIN sub_tech st ON st.subject_id = s.subject_id
        INNER JOIN teachers t ON t.teacher_id = st.teacher_id
        INNER JOIN courses co ON co.course_id = s.course_id
        INNER JOIN semesters se ON se.semester_id = s.semester_id
         where c.class_id LIKE "%' . $query . '%" OR c.date LIKE "%' . $query . '%" OR c.class_code LIKE "%' . $query . '%"
         OR s.subject_name LIKE "%' . $query . '%" OR se.semester_name LIKE "%' . $query . '%"
         OR co.course_name LIKE "%' . $query . '%" HAVING t.uid = ' . $uid . ';');

        return response()->json($classes);
    }
}
