<?php

namespace App\Http\Controllers;

use App\Member;
use App\Share;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => 'logout']);
    }

    public function update(Member $applicant, Request $request) {
        $approveApplication = "APPROVE APPLICATION";
        $pmesAttendee = "MARK AS PMES ATTENDEE";
        $informedFees = "APPLICANT INFORMED ABOUT FEES";
        $idReleased = "ID HAS BEEN RELEASED";
        $shareCertGiven = "SHARE CERTIFICATE GIVEN";
        $application = $applicant->application;

        if ($request->action == $approveApplication) {
            $application->approved = 1;
            $application->approved_by = Auth::guard('admin')->user()->id;
        } else if ($request->action == $pmesAttendee) {
            $application->attended_pmes = 1;
            $application->attendance_verified_by = Auth::guard('admin')->user()->id;
        } else if ($request->action == $informedFees) {
            $application->fees_informed = 1;
            $application->fees_informed_by = Auth::guard('admin')->user()->id;
        } else if ($request->action == $idReleased) {
            $application->id_has_been_released = 1;
            $application->id_released_by = Auth::guard('admin')->user()->id;
        } else if ($request->action == $shareCertGiven) {
            $application->share_cert_given = 1;
            $application->share_cert_given_by = Auth::guard('admin')->user()->id;
            $application->share_cert_release_date = Carbon::now()->toDateString();
        } else if ($request->disapproval_reason) {
            $this->validate($request, [
                'disapproval_reason' => 'required'
            ]);

            $application->approved = 0;
            $application->disapproval_reason = $request->disapproval_reason;
            $application->disapproved_by = Auth::guard('admin')->user()->id;
            $application->save();

            // soft delete applicant
            $application->delete();

            return back();
        }

        $application->save();

        if ($request->has('max_share')) {
            $amount = str_replace(',', '', $request->max_share);

            Share::create([
                'admin_id' => Auth::guard('admin')->user()->id,
                'member_id' => $applicant->id,
                'value' => $amount,
            ]);
        }

        return back();
    }
}
