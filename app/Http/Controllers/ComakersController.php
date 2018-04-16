<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComakersController extends Controller
{
    public function __construct()
    {
        $this->middleware('member', ['except' => 'logout']);
    }
}
