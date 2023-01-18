<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class admin extends Controller
{
    public function admin_dashboard()
    {
        return view('admin/admin_dashboard');
    }

}
