<?php

namespace App\Http\Controllers\apis;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\subjects;

class subjects_api extends Controller
{

    public function get_subjects()
    {
        $user_id = $_GET['user_id'];
        $course_id = $_GET['course_id'];
        $semester_id = $_GET['semester_id'];

        $subjects = subjects::join('semesters', 'semesters.semester_id', '=', 'subjects.semester_id')
            ->join('courses', 'courses.course_id', '=', 'subjects.course_id')
            ->join('sub_tech', 'subjects.subject_id', '=', 'sub_tech.subject_id')
            ->join('teachers', 'teachers.teacher_id', '=', 'sub_tech.teacher_id')
            ->where('teachers.uid', $user_id)
            ->where('subjects.course_id', $course_id)
            ->where('subjects.semester_id', $semester_id)
            ->distinct()
            ->get(['subjects.subject_id', 'subjects.subject_name'])
            ->toArray();

        return response()->json($subjects);
    }

    public function get_all_subjects($uid)
    {

        $subjects = subjects::join('semesters', 'semesters.semester_id', '=', 'subjects.semester_id')
            ->join('courses', 'courses.course_id', '=', 'subjects.course_id')
            ->join('sub_tech', 'subjects.subject_id', '=', 'sub_tech.subject_id')
            ->join('teachers', 'teachers.teacher_id', '=', 'sub_tech.teacher_id')
            ->where('teachers.uid', $uid)
            ->get(['subjects.subject_id', 'subjects.subject_name', 'courses.course_name', 'semesters.semester_name'])
            ->toArray();

        return response()->json($subjects);
    }

    public function get_available_subjects()
    {

        $subjects = subjects::where("course_id", null)->get(["subject_id", "subject_name"]);
        return response()->json($subjects);
    }

    public function get_subject_by_id(Request $request,$id = null)
    {

        if($id == null){
            $id = $request->input("subject_id");
        }

        if ($id == null) {
            $subject = subjects::get();
        } else {
            $subject = subjects::leftjoin("sub_tech","sub_tech.subject_id","subjects.subject_id")->where("subjects.subject_id", $id)->get(['subjects.*','sub_tech.teacher_id']);
        }

        return response()->json($subject);
    }
}
