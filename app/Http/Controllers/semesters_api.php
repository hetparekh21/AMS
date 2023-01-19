<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\semesters;
use App\Models\teachers;

class semesters_api extends Controller
{

    public function get_semester()
    {
        $user_id = $_GET['user_id'];
        $course_id = $_GET['course_id'];

        $teacher_id = teachers::where('uid', $user_id)->first();

        $semesters = semesters::join('subjects', 'subjects.semester_id', '=', 'semesters.semester_id')
            ->join('sub_tech', 'subjects.subject_id', '=', 'sub_tech.subject_id')
            ->join('teachers', 'teachers.teacher_id', '=', 'sub_tech.teacher_id')
            ->where('subjects.course_id', $course_id)
            ->where('teachers.uid', $user_id)
            ->distinct()
            ->get(['semesters.semester_id', 'semesters.semester_name'])
            ->toArray();

        return response()->json($semesters);
    }
}
