<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\apis\courses_api;
use App\Http\Controllers\apis\semesters_api;
use App\Http\Controllers\apis\subjects_api;
use App\Http\Controllers\apis\classes_api;
use App\Http\Controllers\apis\student_api;
use App\Http\Controllers\apis\templates_api;
use App\Http\Controllers\apis\dynamic_qr;
use App\Http\Controllers\apis\teacher_api;
use App\Models\dynamic_mapper;

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

Route::get('/clear_mapper/{code}', function ($code) {

    $result = dynamic_mapper::where('class_code', $code)->delete();
    dump($result);
 
 })->name('clear.mapper');

Route::any('/dynamic_qr/{class_code}', [dynamic_qr::class, 'dynamic_qr'])->name('dynamic_qr');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Teacher related

Route::get('/get_teacher/{teacher_id?}',[teacher_api::class,'get_teachers'])->name('get.teacher');

Route::any('/get_available_subjects/{flag}/{teacher_id?}', [teacher_api::class,'get_available_subjects'])->name('get.available.subjects');

// class related

Route::Post('/get_classes/{uid}', [classes_api::class, 'get_classes'])->name('get.classes');

Route::Post('/get_teacher_classes/{uid}', [classes_api::class, 'get_teacher_classes'])->name('get.teacher.classes');

// student related

Route::Post('/get_students/{uid}', [student_api::class, 'get_students'])->name('get.students');

Route::any('/get_student_by_id/{student_id?}',[student_api::class, 'get_student_by_id'])->name('get.student.id');

// template related

Route::get('/get_templates/{uid}', [templates_api::class, 'get_templates'])->name('get.templates');

// course related

Route::get('/get_course', [courses_api::class, 'get_courses'])->name('get.course');

// semester related

Route::get('/get_semester/{student?}', [semesters_api::class, 'get_semester'])->name('get.semester');

// subject related

Route::get('/get_subjects', [subjects_api::class, 'get_subjects'])->name('get.subjects');

Route::any('/get_all_subjects/{uid}', [subjects_api::class, 'get_all_subjects'])->name('get.all.subjects');

Route::get('/get_available_subjects',[subjects_api::class,'get_available_subjects'])->name('get.subjects.plain');

Route::any('/get_subject_by_id',[subjects_api::class,'get_subject_by_id'])->name('get.subjects.id');