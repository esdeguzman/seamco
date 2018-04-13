<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminsController extends Controller
{
    public function dashboard() {
        return view('admin.layout.dashboard');
    }
}
