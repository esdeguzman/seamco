<?php

namespace App\Http\Controllers;

use App\Loan;
use App\LoanPayment;
use App\Promise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanPaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => 'logout']);
    }

    public function store(Loan $loan, Promise $promise, Request $request) {
        $this->validate($request, [
            'paid_amount' => 'required'
        ]);

        if($request->amount_due == $request->paid_amount) {
            $paid_amount = str_replace(',', '', $request->paid_amount);
            $totalAmountPaid = $paid_amount;

            $loanPayments = LoanPayment::where('loan_id', $loan->id)->get();

            if($loanPayments->count() > 0) {
                foreach ($loanPayments as $loanPayment) {
                    $totalAmountPaid += $loanPayment->amount;
                }
            }

            LoanPayment::create([
                'loan_id' => $loan->id,
                'member_id' => $loan->member_id,
                'promise_id' => $promise->id,
                'admin_id' => Auth::guard('admin')->user()->id,
                'amount' => $paid_amount,
                'loan_balance' => ($loan->promissoryNote->principal_amount + $loan->promissoryNote->interest) - $totalAmountPaid,
            ]);

            $promise->status = 1;
            $promise->save();

            $request->session()->flash('info', 'You have successfully received members\'s loan payment!');
        } else {
            $request->session()->flash('info', 'Entered loan payment is not equal to dued amount.');
        }

        return back();
    }
}
