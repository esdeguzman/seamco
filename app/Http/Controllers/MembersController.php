<?php

namespace App\Http\Controllers;

use App\Comaker;
use App\LoanPayment;
use App\Member;
use App\Share;
use App\SharePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class MembersController extends Controller
{
    public function __construct()
    {
        $this->middleware('member', ['except' => ['logout','updatePhoto']]);
    }

    public function show(Request $request) {
        $member = Member::find(Auth::guard('member')->user()->id);

        // get current max share
        $currentShare = Share::where('member_id', $member->id)->get()->last();

        // get all share payments
        $sharePayments = SharePayment::where('member_id', $member->id)->get();

        // compute total share payments
        $totalSharePayments = -1000;
        foreach ($sharePayments as $sharePayment) {
            if(is_null($sharePayment->remarks)) {
                $totalSharePayments += $sharePayment->amount;
            }
        }

        $savings = $currentShare->value - $totalSharePayments;

        $savings < 0 ? $savings = $savings * -1 : $savings = 0;

        if(count($member->sharePayments) == 0) {
            $request->session()->flash('info', 'Your application review has not yet been completed, please try again some other time or contact us at 09282683776/413-2230, Thank you!');
            Auth::guard('member')->logout();

            return back();
        }

        return view('member.show', compact('logout', 'member', 'sharePayments', 'savings', 'totalSharePayments'));
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

    public function updatePhoto(Member $member, Request $request) {
        if($request->file('photo')) {
            if(! is_null($member->photo_url)) {
                unlink( str_replace('\\', '/', public_path('storage')) .'/'. $member->photo_url);
            }

            $path = Storage::putFile('photos', new File($request->file('photo')));
            $member->photo_url = $path;
            $member->save();

            $request->session()->flash('success', 'You have successfully uploaded the photo!');

            return redirect()->route('admin.show-member', $member->id);
        }
    }
}
