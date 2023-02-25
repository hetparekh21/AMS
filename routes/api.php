<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\apis\courses_api ;
use App\Http\Controllers\apis\semesters_api ;
use App\Http\Controllers\apis\subjects_api ;
use App\Http\Controllers\apis\classes_api ;
use App\Http\Controllers\apis\student_api;
use App\Http\Controllers\apis\templates_api ;
use App\Http\Controllers\apis\dynamic_qr ;

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

Route::any('/dynamic_qr/{class_code}', [dynamic_qr::class,'dynamic_qr'])->name('dynamic_qr');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// class related

Route::Post('/get_classes/{uid}', [classes_api::class,'get_classes'])->name('get.classes');

Route::Post('/get_teacher_classes/{uid}', [classes_api::class,'get_teacher_classes'])->name('get.teacher.classes');

// student related

Route::Post('/get_students/{uid}', [student_api::class,'get_students'])->name('get.students');

// template related

Route::get('/get_templates/{uid}',[templates_api::class,'get_templates'])->name('get.templates');

// course related

Route::get('/get_course', [courses_api::class,'get_courses'])->name('get.course');

// semester related

Route::get('/get_semester',[semesters_api::class,'get_semester'])->name('get.semester');

// subject related

Route::get('/get_subjects',[subjects_api::class,'get_subjects'])->name('get.subjects');

Route::any('/get_all_subjects/{uid}',[subjects_api::class,'get_all_subjects'])->name('get.all.subjects');
