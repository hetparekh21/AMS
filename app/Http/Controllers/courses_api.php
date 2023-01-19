<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\courses;
use App\Models\teachers;

class courses_api extends Controller
{

    public function get_courses()
    {
        $user_id = $_GET['user_id'];

        $courses  = courses::join('subjects', 'subjects.course_id', '=', 'courses.course_id')
            ->join('sub_tech', 'subjects.subject_id', '=', 'sub_tech.subject_id')
            ->join('teachers', 'teachers.teacher_id', '=', 'sub_tech.teacher_id')
            ->where('teachers.uid', $user_id)
            ->distinct()
            ->get(['courses.course_id', 'courses.course_name'])
            ->toArray();

        return response()->json($courses);
    }
}
