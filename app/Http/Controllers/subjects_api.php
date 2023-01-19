<?php

namespace App\Http\Controllers;

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

}
