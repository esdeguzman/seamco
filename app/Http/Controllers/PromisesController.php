<?php

namespace App\Http\Controllers;

use App\Promise;
use App\PromissoryNote;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PromisesController extends Controller
{
    public function __construct()
    {
        $this->middleware('member', ['except' => 'logout']);
    }

    public function store(PromissoryNote $promissoryNote, Request $request) {
        $rules = [];
        $totalAmount = 0;
        $toBePaid = $promissoryNote->principal_amount + $promissoryNote->interest;
        $maxPromise = Carbon::parse($promissoryNote->creditEvaluation->estimated_date_release)->addMonth($promissoryNote->terms);

        for($i = 0; $i < $promissoryNote->terms * 2; $i++) {
            $rules = array_add($rules, 'due_date_'.$i, 'required_with:amount_'.$i);
            $rules = array_add($rules, 'amount_'.$i, 'required_with:due_date_'.$i);
        }

        $this->validate($request, $rules);

        foreach($request->except('_token') as $key => $value) {
            if(str_contains($key, 'due_date')) {
                if(Carbon::parse($value)->gt($maxPromise)) {
                    $request->session()->flash('info', 'You only have until ' . $maxPromise->toFormattedDateString() . ' to pay your loan, please check the entered due dates.');

                    return back()->withInput();
                }
                continue;
            } else if(is_null($value)) continue;
            $totalAmount += str_replace(',', '', $value);
        }

        if($totalAmount < $toBePaid) {
            $lack = $toBePaid - $totalAmount;
            $request->session()->flash('info', 'Promised amounts are not sufficient to pay approved amount plus its interest! You still lack P ' . number_format($lack,2));

            return back()->withInput();
        } else if($totalAmount > $toBePaid) {
            $excess = $totalAmount - $toBePaid;
            $request->session()->flash('info', 'Promised amounts exceeds the amount you have to pay! Your excess is P ' . number_format($excess,2) . '.');

            return back()->withInput();
        }

        for($i = 0; $i < count($request->except('_token')); $i++) {
            if(is_null(request('amount_' . $i))) continue;
            $promise = new Promise();
            $promise->promissory_note_id = $promissoryNote->id;
            $promise->due_date = request('due_date_'.$i);
            $promise->amount = str_replace(',', '', request('amount_'.$i));
            $promise->save();
        }

        return redirect()->route('loans.show', $promissoryNote->loan->id);
    }
}
