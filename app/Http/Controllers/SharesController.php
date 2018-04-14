<?php

namespace App\Http\Controllers;

use App\Member;
use App\Share;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SharesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => 'logout']);
    }

    public function update(Member $member, Request $request) {
        $share = Share::create([
            'member_id' => $member->id,
            'admin_id' => Auth::guard('admin')->user()->id,
            'value' => str_replace(',', '', $request->max_share),
        ]);

        return back();
    }
}
