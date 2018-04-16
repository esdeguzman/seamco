<?php

namespace App\Http\Controllers;

use App\Comaker;
use Illuminate\Http\Request;

class ComakersController extends Controller
{
    public function __construct()
    {
        $this->middleware('member', ['except' => 'logout']);
    }

    public function update(Comaker $comaker, Request $request) {
        if($request->response == 'APPROVED COMAKER REQUEST') {
            $comaker->status = 1;

            $request->session()->flash('success', 'You have successfully approved this loan\'s comaker request!');
        }
    else if($request->response == 'DENY COMAKER REQUEST') {
            $comaker->status = 0;

            $comaker->loan->creditEvaluation->delete();
            $loan = $comaker->loan;
            $loan->status = 0;
            $loan->save();

            $request->session()->flash('success', 'You have successfully denied this loan\'s comaker request!, loan request has been closed!');
        }

        $comaker->save();

        return back();
    }
}
