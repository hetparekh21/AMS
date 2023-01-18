<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\courses;
use App\Models\subjects;
use App\Models\semesters;
use App\Models\teachers;
use App\Models\sub_tech;
use App\Models\classes;
use App\Models\att_jsons;
use App\Models\students;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/get_course', function () {

    $user_id = $_POST['user_id'];

    $teacher_id = teachers::where('uid', $user_id)->first();

    $courses  = courses::join('subjects', 'subjects.course_id', '=', 'courses.course_id')
    ->join('sub_tech', 'subjects.subject_id', '=', 'sub_tech.subject_id')
    ->join('teachers', 'teachers.teacher_id', '=', 'sub_tech.teacher_id')
    ->where('teachers.teacher_id', $teacher_id->teacher_id)
    ->distinct()
    ->get(['courses.course_id', 'courses.course_name'])
    ->toArray();
    
    return response()->json($courses);
})->name('get.course');

Route::any('/get_semester', function () {

    $user_id = $_POST['user_id'];
    $course_id = $_POST['course_id'];

    $teacher_id = teachers::where('uid', $user_id)->first();

    $semesters = semesters::join('subjects', 'subjects.semester_id', '=', 'semesters.semester_id')
    ->join('sub_tech', 'subjects.subject_id', '=', 'sub_tech.subject_id')
    ->join('teachers', 'teachers.teacher_id', '=', 'sub_tech.teacher_id')
    ->where('subjects.course_id', $course_id)->where('teachers.teacher_id', $teacher_id->teacher_id)
    ->distinct()
    ->get(['semesters.semester_id', 'semesters.semester_name'])
    ->toArray();

    return response()->json($semesters);

})->name('get.semester');

Route::any('/get_subjects',function(){

    $user_id = $_POST['user_id'];
    $course_id = $_POST['course_id'];
    $semester_id = $_POST['semester_id'];

    $teacher_id = teachers::where('uid', $user_id)->first();

    $subjects = subjects::join('semesters', 'semesters.semester_id', '=', 'subjects.semester_id')
    ->join('sub_tech', 'subjects.subject_id', '=', 'sub_tech.subject_id')
    ->join('teachers', 'teachers.teacher_id', '=', 'sub_tech.teacher_id')
    ->where('subjects.course_id', $course_id)->where('semesters.semester_id', $semester_id)->where('teachers.teacher_id', $teacher_id->teacher_id)
    ->distinct()
    ->get(['subjects.subject_id', 'subjects.subject_name'])
    ->toArray();

    return response()->json($subjects);

})->name('get.subjects');
