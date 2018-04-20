<?php

namespace App\Http\Controllers\MemberAuth;

use App\Admin;
use App\Application;
use App\Member;
use App\Notifications\NewApplicationNotification;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/member/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('member.guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'terms_and_conditions' => 'bail|accepted',
            'full_name' => 'required|max:255',
            'civil_status' => 'required',
            'birth_date' => 'required',
            'mobile_number' => 'required|unique:members,mobile_number',
            'gender' => 'required',
            'present_address' => 'required',
            'permanent_address' => 'required',
            'employer' => 'required',
            'tax_identification_number' => 'required|unique:members,tax_identification_number',
            'position' => 'required',
            'department' => 'required',
            'employment_date' => 'required',
            'salary' => 'required',
            'employer_address' => 'required',
            'other_source_of_income' => 'required',
            'number_of_dependents' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Member
     */
    protected function create(array $data)
    {
        $full_name = explode(' ', $data['full_name']);

        $data['salary'] = str_replace(',', '', $data['salary']);
        $data['username'] = strtolower($full_name[0]) .'0'. random_int(1, 99);
        $data['password'] = bcrypt(str_replace('-', '', $data['tax_identification_number']));

        $member = Member::create([
            'full_name' => $data['full_name'],
            'civil_status' => $data['civil_status'],
            'birth_date' => $data['birth_date'],
            'mobile_number' => $data['mobile_number'],
            'gender' => $data['gender'],
            'present_address' => $data['present_address'],
            'permanent_address' => $data['permanent_address'],
            'employer' => $data['employer'],
            'tax_identification_number' => $data['tax_identification_number'],
            'position' => $data['position'],
            'department' => $data['department'],
            'employment_date' => $data['employment_date'],
            'salary' => $data['salary'],
            'employer_address' => $data['employer_address'],
            'other_source_of_income' => $data['other_source_of_income'],
            'number_of_dependents' => $data['number_of_dependents'],
            'username' => $data['username'],
            'password' => $data['password'],
        ]);

        // set member code
        $member->code = 'M' . substr(str_replace('/', '', $data['birth_date']), 0, 4) . str_pad($member->id, 4, '0', STR_PAD_LEFT);
        $member->save();

        $application = Application::create([
           'member_id' => $member->id
        ]);

        // TODO: notify admin User::find(1)->notify(new NewApplicant());
        $admins = Admin::find(['2', '3', '4']);

        foreach ($admins as $admin) {
            $admin->notify(new NewApplicationNotification());
        }

        return $member;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('member.auth.register');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('member');
    }
}
