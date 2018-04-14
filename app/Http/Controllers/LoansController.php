<?php

namespace App\Http\Controllers;

use App\Comaker;
use App\Loan;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoansController extends Controller
{
    public function __construct()
    {
        $this->middleware('member', ['except' => 'logout']);
    }

    public function create() {
        return $comakers = Member::whereHas('sharePayments')->get();

        return view('member.loans.create', compact('comakers'));
    }

    public function store(Member $member, Request $request) {
        $this->validate($request, [
            'payment_terms' => 'required',
            'company_contact_number' => 'required',
            'take_home_pay' => 'required',
            'sss_gsis' => 'required',
            'residence_telephone_number' => 'required',
            'comaker_id' => 'required'
        ]);

        $regular = $request->regular ? str_replace(',', '', $request->regular) : 0.0;
        $short_term = $request->short_term ? str_replace(',', '', $request->short_term) : 0.0;
        $pre_joining = $request->pre_joining ? str_replace(',', '', $request->pre_joining) : 0.0;
        $productive = $request->productive ? str_replace(',', '', $request->productive) : 0.0;
        $special = $request->special ? str_replace(',', '', $request->special) : 0.0;
        $appliance = $request->appliance ? str_replace(',', '', $request->appliance) : 0.0;
        $petty_cash = $request->petty_cash ? str_replace(',', '', $request->petty_cash) : 0.0;
        $monthly_income = str_replace(',', '', $request->monthly_income);
        $take_home_pay = str_replace(',', '', $request->take_home_pay);

        return $total_amount = $regular + $short_term + $pre_joining + $productive + $special + $appliance + $petty_cash;

        if ($total_amount == 0.0) {
            $request->session()->flash('error', 'Please apply for atleast one loan type by placing an amount to the right of the selected loan type');
            return back();
        }

        $loan = new Loan();
        $loan->member_id = Auth::guard('member')->user()->id;
        $loan->regular = $regular;
        $loan->short_term = $short_term;
        $loan->pre_joining = $pre_joining;
        $loan->productive = $productive;
        $loan->special = $special;
        $loan->appliance = $appliance;
        $loan->petty_cash = $petty_cash;
        $loan->total_amount = $total_amount;
        $loan->payment_terms = $request->payment_terms;
        $loan->company_contact_number = $request->company_contact_number;
        $loan->monthly_income = $monthly_income;
        $loan->take_home_pay = $take_home_pay;
        $loan->sss_gsis = $request->sss_gsis;
        $loan->residence_telephone_number = $request->residence_telephone_number;
        $loan->total_amount = $total_amount;
        $loan->save();

        // create comaker
        // null response: for tracking if it has been answered
        // null status: for approval of comaker request
        $comaker = new Comaker();
        $comaker->user_id = $request->comaker_id;
        $comaker->loan_id = $loan->id;
        $comaker->save();

        $request->session()->flash('success', 'You have successfully applied for a loan, we will contact you as soon the decision has been made, or you can always check it in your MY LOANS tab!');

        return 'success';
    }
}
