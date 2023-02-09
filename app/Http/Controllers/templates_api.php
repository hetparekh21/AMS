<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\templates;
use App\Models\teachers;

class templates_api extends Controller
{
    public function get_templates($uid)
    {
        $teacher = teachers::where('uid', $uid)->get('teacher_id');

        $templates = templates::join('subjects', 'templates.subject_id', '=', 'subjects.subject_id')
            ->join('semesters', 'subjects.semester_id', '=', 'semesters.semester_id')
            ->join('courses', 'subjects.course_id', '=', 'courses.course_id')
            ->select('id','subjects.subject_name', 'courses.course_name', 'semesters.semester_name')
            ->where('templates.teacher_id', $teacher[0]['teacher_id'])
            ->get();
            
        return json_encode($templates);
    }
}
