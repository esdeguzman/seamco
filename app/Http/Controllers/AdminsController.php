<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Loan;
use App\Member;
use App\Share;
use App\SharePayment;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => 'logout']);
    }

    public function dashboard() {
        $members = Member::whereHas('shares')->get();
        $applicants = Member::whereHas('application', function ($query) {
            $query->where('fees_informed', null)
                    ->orWhere('id_has_been_released', null)
                    ->orWhere('share_cert_given', null);
        })->get();
        $loanApplications = Loan::where('status',null)->get();
        $admins = Admin::all();

        return view('admin.dashboard', compact('members', 'applicants', 'loanApplications', 'admins'));
    }

    public function show(Admin $admin) {
        return view('admin.show', compact('admin'));
    }

    public function update(Admin $admin, Request $request) {
        if($request->file('photo')) {
            if(! is_null($admin->photo_url)) {
                unlink( str_replace('\\', '/', public_path('storage')) .'/'. $admin->photo_url);
            }

            $path = Storage::putFile('photos', new File($request->file('photo')));
            $admin->photo_url = $path;
            $admin->save();

            $request->session()->flash('success', 'You have successfully uploaded your photo!');

            return redirect()->route('admin.show', $admin->id);
        }
    }

    public function changePassword(Admin $admin, Request $request) {
        if(Hash::check($request->old_password, $admin->password)) {
            $admin->password = bcrypt($request->password);
            $admin->save();

            $request->session()->flash('success', 'You have successfully changed your password!');
            return redirect()->route('admin.show', $admin->id);
        } else {
            $request->session()->flash('passwordError', 'Old password did not match!');
            return redirect()->route('admin.show', $admin->id);
        }
    }

    public function reviewApplicant(Member $applicant) {
        return view('admin.layout.applicant', compact('applicant'));
    }

    public function approvedMembers() {
        $members = Member::whereHas('shares')->get();

        return view('admin.members.approved', compact('members'));
    }

    public function showMember(Member $member) {
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

        $currentLoan = Loan::whereHas('promissoryNote', function($query) {
            $query->where('settled', 0)->where('remarks', null);
        })->orderByDesc('created_at')->first();

        $latestPromise = null;

        if(! is_null($currentLoan)) {
            $latestPromise = $currentLoan->promissoryNote->promises->where('carbonated_date', $currentLoan->promissoryNote->promises->where('status', 0)->min('carbonated_date'))->first();
        }

        return view('admin.members.show', compact('member', 'savings', 'totalSharePayments', 'latestPromise', 'currentLoan'));
    }

    public function loansIndex() {
        $loans = Loan::all();

        return view('admin.loans.index', compact('loans'));
    }

    public function showLoan(Loan $loan) {
        return view('admin.loans.show', compact('loan'));
    }

    /**
     * @param Member $member
     * @throws \Exception
     */
    public function deleteMember(Member $member) {
        $member->delete();

        return redirect()->route('admin.approved-members');
    }
}
