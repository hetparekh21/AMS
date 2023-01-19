<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// class related

Route::any('/get_classes/{uid}', [classes_api::class,'get_classes'])->name('get.classes');

// course related

Route::any('/get_course', [courses_api::class,'get_courses'])->name('get.course');

// semester related

Route::any('/get_semester',[semesters_api::class,'get_semester'])->name('get.semester');

// subject related

Route::any('/get_subjects',[subjects_api::class,'get_subjects'])->name('get.subjects');
