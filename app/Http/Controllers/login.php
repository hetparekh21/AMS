<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class login extends Controller
{

    public function index()
    {

        //check if user is already loggedin

        if (Auth::check()) {
            return login::sort_user();
        }

        return view('login');
    }

    public function login(Request $req)
    {

        if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {

            session()->regenerate();

            return login::sort_user();
        } else {

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    private static function sort_user()
    {

        $user = Auth::user();

        if ($user->role_id == 2) {

            return redirect()->intended(route('teacher.dashboard'));
        } elseif ($user->role_id == 3) {

            return redirect()->intended(route('student.dashboard'));
        } elseif ($user->role_id == 1) {

            return redirect()->intended(route('admin.dashboard'));
        }
    }
}
