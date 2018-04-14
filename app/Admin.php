<?php

namespace App;

use App\Notifications\AdminResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPassword($token));
    }

    // TODO: make approvedMembers(), deniedMembers(), approvedLoans() and deniedLoans()

    public function acceptedLoanPayments() {
        return $this->hasMany(LoanPayment::class);
    }

    public function acceptedSharePayments() {
        return $this->hasMany(SharePayment::class);
    }

    public function approvedApplications() {
        return $this->hasMany(Application::class);
    }
}
