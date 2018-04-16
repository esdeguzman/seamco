<?php

namespace App\Http\Controllers;

use App\Comaker;
use App\CreditEvaluation;
use App\Loan;
use App\Member;
use App\Notifications\NewComakerRequest;
use App\PromissoryNote;
use App\Share;
use App\SharePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoansController extends Controller
{
    public function __construct()
    {
        $this->middleware('member', ['except' => ['logout', 'update']]);
    }

    public function create() {
        $comakers = Member::whereHas('sharePayments')->get();

        return view('member.loans.create', compact('comakers'));
    }

    public function index() {
        $member = Auth::guard('member')->user();
        $loans = Loan::where('member_id', $member->id)->get();

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

        return view('member.loans.index', compact('member', 'loans', 'currentShare', 'totalSharePayments', 'savings'));
    }

    public function show(Loan $loan) {
        return view('member.loans.show', compact('loan'));
    }

    public function store(Member $member, Request $request)
    {
        $this->validate($request, [
            'payment_terms' => 'required',
            'company_contact_number' => 'required',
            'take_home_pay' => 'required',
            'sss_gsis' => 'required',
            'residence_telephone_number' => 'required',
            'monthly_income' => 'required',
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

        $total_amount = $regular + $short_term + $pre_joining + $productive + $special + $appliance + $petty_cash;

        if ($total_amount == 0.0) {
            $request->session()->flash('error', 'Please apply for atleast one loan type by placing an amount to the right of the selected loan type');
            return back()->withInput();
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
        $newComakerRequest = Comaker::create([
            'member_id' => $request->comaker_id,
            'requested_by' => Auth::guard('member')->user()->id,
            'loan_id' => $loan->id,
        ]);

        $comaker = Member::find($newComakerRequest->member_id);

        // create credit evaluation
        $creditEvaluation = CreditEvaluation::create([
            'member_id' => $member->id
        ]);

        $loan->credit_evaluation_id = $creditEvaluation->id;
        $loan->save();

        $request->session()->flash('success', 'You have successfully applied for a loan, we will contact you as soon the decision has been made, or you can always check it in your MY LOANS tab!');

        return back();
    }

    public function update(Loan $loan, Request $request) {
        if($request->has('ch_response')) {
            if($request->ch_response == 'APPROVE') {
                $creditEvaluation = $loan->creditEvaluation;
                $creditEvaluation->approved_for_payment_by = Auth::guard('admin')->user()->id;
                $creditEvaluation->save();

                $loan->status = 1;
            }
        }

        if($request->has('cc_response')) {
            if($request->cc_response == 'APPROVE') {
                $creditEvaluation = $loan->creditEvaluation;
                $creditEvaluation->verified_by = Auth::guard('admin')->user()->id;
                $creditEvaluation->save();
            }
        }

        if(! is_null($request->approved_amount) && ! is_null($request->estimated_date_release) && ! is_null($request->interest)) {
            $approved_amount = str_replace(',', '', $request->approved_amount);
            $interest = str_replace(',', '', $request->interest);

            $creditEvaluation = $loan->creditEvaluation;
            $creditEvaluation->approved_amount = $approved_amount;
            $creditEvaluation->interest = $interest;
            $creditEvaluation->estimated_date_release = $request->estimated_date_release;
            $creditEvaluation->save();
        }

        if($request->has('gm_response')) {
            if($request->gm_response == 'APPROVE') {
                $creditEvaluation = $loan->creditEvaluation;
                $creditEvaluation->recommended_for_loan_extension_by = Auth::guard('admin')->user()->id;
                $creditEvaluation->save();
            }
        }

        $loan->save();

        return back();
    }
}
