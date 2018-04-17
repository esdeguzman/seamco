<?php

namespace App\Http\Controllers;

use App\Loan;
use App\PromissoryNote;
use Illuminate\Http\Request;

class PromissoryNotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('member', ['except' => 'logout']);
    }

    public function create(Loan $loan) {
        if(is_null($loan->promissoryNote)) $promissoryNote = $this->store($loan);

        return view('member.promises.create', compact('promissoryNote'));
    }

    public function store($loan) {
        return PromissoryNote::create([
            'loan_id' => $loan->id,
            'member_id' => $loan->member_id,
            'credit_evaluation_id' => $loan->creditEvaluation->id,
            'principal_amount' => $loan->creditEvaluation->approved_amount,
            'interest' => $loan->creditEvaluation->interest,
            'terms' => $loan->payment_terms,
        ]);
    }
}
