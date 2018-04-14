<?php

namespace App\Http\Controllers;

use App\Member;
use App\Share;
use App\SharePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SharePaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => 'logout']);
    }

    public function store(Member $member, Request $request) {
        // get current max share
        $currentShare = Share::where('member_id', $member->id)->get()->last();

        // get last balance
        $sharePayments = SharePayment::where('member_id', $member->id)->get();
        $currentBalance = 0;
        $savings = 0;
        $lastBalance = $sharePayments->first();
        $amount = str_replace(',', '', $request->amount);
        $totalSharePayments = $amount;

        if(is_null($lastBalance)) {
            // make it equal to zero
            $lastBalance = 0;
            $currentBalance = $currentShare->value - $amount;
        } else {
            foreach ($sharePayments as $sharePayment) {
                if(is_null($sharePayment->remarks)) {
                    $totalSharePayments += $sharePayment->amount;
                }
            }

            $currentBalance = $currentShare->value - $totalSharePayments;

            if($currentBalance < 0) {
                $savings = $currentBalance * -1;
                $currentBalance = 0;
            }
        }

        $currentBalance -= 1000;
        $savings -= 1000;

        $sharePayment = SharePayment::create([
            'admin_id' => Auth::guard('admin')->user()->id,
            'member_id' => $member->id,
            'amount' => $amount,
            'share_balance' => $currentBalance < -2000 ? 0 : $currentBalance * -1,
            'savings' => $savings < 0 ? 0 : $savings,
        ]);

        return back();
    }

    public function edit(SharePayment $sharePayment) {
        return view('admin.share-payments.edit', compact('sharePayment'));
    }

    public function update(SharePayment $sharePayment, Request $request) {
        $sharePayment->remarks = $request->remarks;
        $sharePayment->updatedBy = Auth::guard('admin')->user()->id;
        $sharePayment->save();

        return redirect()->route('admin.show-member', $sharePayment->member_id);
    }
}
