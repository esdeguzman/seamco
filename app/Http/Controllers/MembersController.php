<?php

namespace App\Http\Controllers;

use App\Comaker;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class MembersController extends Controller
{
    public function __construct()
    {
        $this->middleware('member', ['except' => 'logout']);
    }

    public function show(Request $request) {
        $member = Member::find(Auth::guard('member')->user()->id);
        $logout = false;

        if(count($member->sharePayments) == 0) {
            $logout = true;
        }

        return view('member.show', compact('logout', 'member'));
    }

    public function changePassword(Member $member, Request $request) {
        if(Hash::check($request->old_password, $member->password)) {
            $member->password = bcrypt($request->password);
            $member->save();

            $request->session()->flash('success', 'You have successfully changed your password!');
            return redirect()->route('members.show');
        } else {
            $request->session()->flash('passwordError', 'Old password did not match!');
            return redirect()->route('members.show');
        }
    }

    public function update(Member $member, Request $request) {
        if($request->file('photo')) {
            if(! is_null($member->photo_url)) {
                unlink( str_replace('\\', '/', public_path('storage')) .'/'. $member->photo_url);
            }

            $path = Storage::putFile('photos', new File($request->file('photo')));
            $member->photo_url = $path;
            $member->save();

            $request->session()->flash('success', 'You have successfully uploaded your photo!');

            return redirect()->route('members.show', $member->id);
        }
    }
}
