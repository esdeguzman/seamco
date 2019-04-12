<?php

namespace App;

use App\Notifications\AdminResetPassword;
use App\Traits\Historiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable, SoftDeletes, Historiable;

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
