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
        auth()->guard('admin')->user()->makeHistory('viewed admin index');

        $admins = Admin::all();

        return view('admin.index', compact('admins'));
    }

    public function dashboard() {
        auth()->guard('admin')->user()->makeHistory('viewed dashboard');

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
        auth()->guard('admin')->user()->makeHistory("viewed $admin->first_name $admin->last_name details");

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

                    auth()->guard('admin')->user()->makeHistory('updated profile picture');
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

                $oldAdmin = $admin;
                $admin->contact_number = $request->contact_number;
                $admin->address = $request->address;
                $admin->email = $request->email;
                $admin->position = $request->position;
                $admin->save();


                $request->session()->flash('success', 'You have successfully updated your profile information!');

                auth()
                    ->guard('admin')
                    ->user()
                    ->makeHistory("updated info from " .
                        "contact number: $oldAdmin->contact_number, " . 
                        "address: $oldAdmin->address, " .
                        "position: $oldAdmin->position, " .
                        "email: $oldAdmin->email");
            }
        } else {
            $request->session()->flash('info', 'The profile you are trying to update is not yours. Process aborted!');

            auth()
                    ->guard('admin')
                    ->user()
                    ->makeHistory("tried to update info of $admin->first_name $admin->last_name using " .
                        "contact number: $request->contact_number, " . 
                        "address: $request->address, " .
                        "position: $request->position, " .
                        "email: $request->email");
        }

        return redirect()->route('admin.show', $admin->id);
    }

    public function changePassword(Admin $admin, Request $request) {
        if (auth()->guard('admin')->user()->id == $admin->id) {
            if(Hash::check($request->old_password, $admin->password)) {
                $admin->password = bcrypt($request->password);
                $admin->save();

                $request->session()->flash('success', 'You have successfully changed your password!');

                auth()->guard('admin')->user()->makeHistory('updated password');
            } else {
                $request->session()->flash('passwordError', 'Passwords did not match!');
            }
        } else {
            $request->session()->flash('info', 'The profile you are trying to update is not yours. Process aborted!');

            auth()->guard('admin')->user()->makeHistory("tried to update password of $admin->first_name $admin->last_name");
        }

        return redirect()->route('admin.show', $admin->id);
    }

    public function reviewApplicant($applicant) {
        $applicant = Member::find($applicant);

        auth()->guard('admin')->user()->makeHistory("reviewed applicant $applicant->full_name");

        return view('admin.layout.applicant', compact('applicant'));
    }

    public function approvedMembers() {
        $members = Member::whereHas('shares')->get();

        auth()->guard('admin')->user()->makeHistory('viewed approved members');

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

        auth()->guard('admin')->user()->makeHistory("viewed profile of $member->full_name");

        return view('admin.members.show', compact('member', 'savings', 'totalSharePayments', 'latestPromises', 'currentLoans'));
    }

    public function loansIndex(Request $request) {
        $loans = null;

        if ($request->status != 2 and $request->status != 1) {
            $loans = Loan::where('status', $request->status)->where('deleted_at', null)->get(); // do not include soft deleted loans
        } else if ($request->status == 1) {
            $loans = Loan::whereHas('promissoryNote', function ($query) {
                $query->where('settled', 0);
            })->orWhere('status', 1)->get();
        } else {
            $loans = Loan::whereHas('promissoryNote', function ($query) {
                $query->where('settled', 1);
            })->orWhere('status', 2)->get();
        }

        auth()->guard('admin')->user()->makeHistory('viewed loans index');

        return view('admin.loans.index', compact('loans'));
    }

    public function showLoan(Loan $loan) {
        auth()->guard('admin')->user()->makeHistory("viewed loan of $loan->member->full_name with loan id: $loan->id");

        return view('admin.loans.show', compact('loan'));
    }

    /**
     * @param Member $member
     * @throws \Exception
     */
    public function deleteMember(Member $member) {
        auth()->guard('admin')->user()->makeHistory("deleted profile of member: $member->full_name");

        $member->delete();

        return redirect()->route('admin.approved-members');
    }

    public function updateMemberInfo(Member $member, Request $request) {
        $this->validate($request, [
            'email' => Rule::unique('members')->ignore($member->id),
            'full_name' => 'required',
            'birth_date' => 'required',
            'mobile_number' => 'required',
            'present_address' => 'required',
            'permanent_address' => 'required',
            'employer' => 'required',
            'tax_identification_number' => 'required',
            'position' => 'required',
            'department' => 'required',
            'employment_date' => 'required',
            'salary' => 'required',
            'employer_address' => 'required',
            'other_source_of_income' => 'required',
            'number_of_dependents' => 'required',
        ]);

        $salary = str_replace(',', '', $request->salary);
        
        $oldMember = $member;

        $member->full_name = $request->full_name;
        $member->civil_status = $request->civil_status;
        $member->birth_date = $request->birth_date;
        $member->mobile_number = $request->mobile_number;
        $member->present_address = $request->present_address;
        $member->permanent_address = $request->permanent_address;
        $member->employer = $request->employer;
        $member->tax_identification_number = $request->tax_identification_number;
        $member->position = $request->position;
        $member->department = $request->department;
        $member->employment_date = $request->employment_date;
        $member->salary = $salary;
        $member->employer_address = $request->employer_address;
        $member->other_source_of_income = $request->other_source_of_income;
        $member->number_of_dependents = $request->number_of_dependents;
        $member->email = $request->email;
        $member->save();

        auth()->guard('admin')->user()->makeHistory("updated profile of member: $member->full_name");

        return back();
    }
}
