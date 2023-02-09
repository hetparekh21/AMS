<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// controllers
use App\Http\Controllers\teacher;
use App\Http\Controllers\student;
use App\Http\Controllers\admin;
use App\Http\Controllers\login;
use App\Http\Controllers\class_attendance;
use App\Http\Controllers\attendance;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Attendance Routes

// Show Qr Code
Route::get('/qr/{code}', function ($code) {
    // flash some data to session
    session()->flash('message', 'some route for students' . $code);
    return view('qr');
})->name('qr');


// Admin Routes
Route::middleware('guard_admin')->group(function () {

    Route::group(['prefix' => '/admin'], function () {

        Route::get('/', [admin::class, 'admin_dashboard'])->name('admin.dashboard');
    });
});

// Student Routes
Route::middleware('guard_student')->group(function () {
    Route::group(['prefix' => '/student'], function () {

        Route::get('/', [student::class, 'student_dashboard'])->name('student.dashboard')->middleware('auth');
    });
});

// Teacher Routes 
Route::middleware('guard_teacher')->group(function () {

    Route::group(['prefix' => '/teacher'], function () {

        Route::get('/', [teacher::class, 'teacher_dashboard'])->name('teacher.dashboard');

        Route::get('/class', [teacher::class, 'teacher_class'])->name('teacher.class');

        Route::get('/subject', [attendance::class, 'subject_index'])->name('teacher.subject');

        Route::any('/attendance', [attendance::class, 'attendance_index'])->name('teacher.attendance');

        Route::post('/initiate', [teacher::class, 'initiate_class'])->name('teacher.initiate.class');

        Route::post('/create_template', [teacher::class, 'create_template'])->name('teacher.create.template');

        Route::post('/handel_template/{id}', [teacher::class, 'handel_template'])->name('teacher.handel.template');
    });

    Route::group(['prefix' => '/subject_attendance'],function (){

        Route::get('/{subject_id}', [attendance::class, 'subject_attendance'])->name('attendance.subject');

    });

    Route::group(['prefix' => '/class_attendance'], function () {

        Route::get('/{class_id}', [attendance::class, 'class_attendance'])->name('attendance.class');

        Route::post('/absent', [attendance::class, 'mark_absent'])->name('attendance.mark.absent');

        Route::post('/present', [attendance::class, 'mark_present'])->name('attendance.mark.present');

        Route::post('/from_suspicious', [attendance::class, 'from_suspicious'])->name('attendance.mark.from_suspicious');

        Route::get('/export/{class_id}', [attendance::class, 'export'])->name('attendance.export');
    });
});

// Login Logout 
Route::get('/', function () {
    return redirect()->route('login.index');
});


Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login.index');
})->name('logout');

Route::group(['prefix' => 'login'], function () {

    Route::get('/', [login::class, 'index'])->name('login.index');

    Route::post('/', [login::class, 'login'])->name('login.login');
});
