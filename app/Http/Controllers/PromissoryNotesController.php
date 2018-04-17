<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PromissoryNotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('member', ['except' => 'logout']);
    }
}
