<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\courses;
use App\Models\subjects;
use App\Models\semesters;
use App\Models\teachers;

use App\Http\Controllers\courses_api ;
use App\Http\Controllers\semesters_api ;
use App\Http\Controllers\subjects_api ;
use App\Http\Controllers\classes_api ;

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

Route::any('/get_classes/{uid}', [classes_api::class,'get_classes'])->name('get.classes');

Route::any('/get_course', [courses_api::class,'get_courses'])->name('get.course');

Route::any('/get_semester',[semesters_api::class,'get_semester'])->name('get.semester');

Route::any('/get_subjects',[subjects_api::class,'get_subjects'])->name('get.subjects');
