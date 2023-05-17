<?php

namespace App\Http\Controllers\apis;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\teachers;
use App\Models\subjects;
use Illuminate\Support\Facades\DB;

class teacher_api extends Controller
{
    public function get_teachers(Request $req , $teacher_id = null){

        if($teacher_id == null){
            $teacher_id = $req->input("teacher_id");
        }

        if($teacher_id != null){
            $teachers = teachers::join("users","users.id","teachers.uid")->where("teacher_id",$teacher_id)->get(["teacher_id","teacher_name","users.email","users.pass_"]);
        }else{
            $teachers = teachers::join("users","users.id","teachers.uid")->get(["teacher_id","teacher_name","users.email","users.pass_"]);
        }

        return response()->json($teachers);

    }

    /*
    *   @param $teacher_id
    *   @param $flag 0 for assigned subjects and 1 for available subjects
    *   @return json
    */
    public function get_available_subjects(Request $req , $flag = 0,$teacher_id = null){

        if($teacher_id == null){
            $teacher_id = $req->input("teacher_id");
        }

        if($teacher_id == null || $teacher_id == ""){
            return "lol";
        }elseif($flag == 1){
            $subjects = DB::select("SELECT s.subject_id , s.subject_name from subjects s WHERE s.course_id IS NOT null AND s.subject_id NOT IN (SELECT st.subject_id FROM sub_tech st WHERE st.teacher_id = $teacher_id)");
        }else{
            $subjects = DB::select("SELECT s.subject_id , s.subject_name from subjects s WHERE s.course_id IS NOT null AND s.subject_id IN (SELECT st.subject_id FROM sub_tech st WHERE st.teacher_id = $teacher_id)");
        }

        return response()->json($subjects);

    }
}
