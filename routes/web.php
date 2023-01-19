<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// controllers
use App\Http\Controllers\teacher;
use App\Http\Controllers\student;
use App\Http\Controllers\admin;
use App\Http\Controllers\login;
use App\Http\Controllers\class_attendance;

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

// Show Qr Code

Route::get('/qr/{code}', function ($code) {
    // flash some data to session
    session()->flash('message', 'some route for students'.$code);
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

        Route::get('/account', [teacher::class, 'teacher_account_settings'])->name('teacher.account');

        Route::get('/{id}', [class_attendance::class, 'index'])->name('attendance');

        Route::post('/initiate',[teacher::class,'initiate_class'])->name('teacher.initiate.class');

        Route::post('/create_template', [teacher::class, 'create_template'])->name('teacher.create.template');

        Route::post('/handel_template/{id}', [teacher::class, 'handel_template'])->name('teacher.handel.template');

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
