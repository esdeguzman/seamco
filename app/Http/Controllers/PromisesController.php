<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PromisesController extends Controller
{
    public function __construct()
    {
        $this->middleware('member', ['except' => 'logout']);
    }
}
