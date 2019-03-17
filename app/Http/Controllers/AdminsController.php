<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Loan;
use App\Member;
use App\PromissoryNote;
use App\Share;
use App\SharePayment;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => 'logout']);
    }

    public function index()
    {
        $admins = Admin::all();

        return view('admin.index', compact('admins'));
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
        if (auth()->guard('admin')->user()->id == $admin->id) {
            if ($request->file('photo')) {
                if(! is_null($admin->photo_url)) {
                    unlink( str_replace('\\', '/', public_path('storage')) .'/'. $admin->photo_url);
                }

                    $path = Storage::putFile('photos', new File($request->file('photo')));
                    $admin->photo_url = $path;
                    $admin->save();

                    $request->session()->flash('success', 'You have successfully uploaded your photo!');
            } else {
                $this->validate($request,
                [
                    'contact_number' => 
                    array(
                        'required',
                        Rule::unique('admins')->ignore($admin->id),
                        'regex:/^((0|\+63)9\d{9})$/'
                    ),
                    'address' => 'required',
                    'email' => 
                    array(
                        'required',
                        Rule::unique('admins')->ignore($admin->id)
                    ),
                    'position' => 'required'
                ],
                [
                    'contact_number.regex' => 'Mobile number is invalid. Please make sure to use formats +639187263746 or 09187263746'
                ]);

                $admin->contact_number = $request->contact_number;
                $admin->save();


                $request->session()->flash('success', 'You have successfully updated your profile information!');
            }
        } else {
            $request->session()->flash('info', 'The profile you are trying to update is not yours. Process aborted!');
        }

        return redirect()->route('admin.show', $admin->id);
    }

    public function changePassword(Admin $admin, Request $request) {
        if (auth()->guard('admin')->user()->id == $admin->id) {
            if(Hash::check($request->old_password, $admin->password)) {
                $admin->password = bcrypt($request->password);
                $admin->save();

                $request->session()->flash('success', 'You have successfully changed your password!');
            } else {
                $request->session()->flash('passwordError', 'Passwords did not match!');
            }
        } else {
            $request->session()->flash('info', 'The profile you are trying to update is not yours. Process aborted!');
        }

        return redirect()->route('admin.show', $admin->id);
    }

    public function reviewApplicant($applicant) {
        $applicant = Member::find($applicant);

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

        $currentLoans = Loan::whereHas('promissoryNote', function($query) use ($member) {
            $query->where('settled', 0)->where('remarks', null)
                ->where('member_id', $member->id)
                ->where('remarks', null);
        })->orderByDesc('created_at')->get();

        $latestPromises = [];

        foreach($currentLoans as $currentLoan) {
            if(! is_null($currentLoan)) {
            $latestPromises[] = $currentLoan->promissoryNote->promises->where('carbonated_date', $currentLoan->promissoryNote->promises->where('status', 0)->min('carbonated_date'))->first();
            }
        }

        return view('admin.members.show', compact('member', 'savings', 'totalSharePayments', 'latestPromises', 'currentLoans'));
    }

    public function loansIndex(Request $request) {
        $loans = null;

        if ($request->status != 2 and $request->status != 1) {
            $loans = Loan::where('status', $request->status)->get();
        } else if ($request->status == 1) {
            $loans = Loan::whereHas('promissoryNote', function ($query) {
                $query->where('settled', 0);
            })->orWhere('status', 1)->get();
        } else {
            $loans = Loan::whereHas('promissoryNote', function ($query) {
                $query->where('settled', 1);
            })->orWhere('status', 2)->get();
        }

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

    public function updateMemberInfo(Member $member, Request $request) {
        $salary = str_replace(',', '', $request->salary);

        $member->full_name = $request->full_name;
        $member->civil_status = $request->civil_status;
        $member->birth_date = $request->birth_date;
        $member->mobile_number = $request->mobile_number;
        $member->present_address = $request->present_address;
        $member->employer = $request->employer;
        $member->tax_identification_number = $request->tax_identification_number;
        $member->position = $request->position;
        $member->department = $request->department;
        $member->employment_date = $request->employment_date;
        $member->salary = $salary;
        $member->employer_address = $request->employer_address;
        $member->other_source_of_income = $request->other_source_of_income;
        $member->number_of_dependents = $request->number_of_dependents;
        $member->save();

        return back();
    }
}
