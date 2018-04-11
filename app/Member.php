<?php

namespace App;

use App\Notifications\MemberResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MemberResetPassword($token));
    }

    public function loans() {
        return $this->hasMany(Loan::class);
    }

    public function comakers() {
        return $this->hasMany(Comaker::class);
    }

    public function loanPayments() {
        return $this->hasMany(LoanPayment::class);
    }

    public function sharePayments() {
        return $this->hasMany(SharePayment::class);
    }

    public function promissoryNotes() {
        return $this->hasMany(PromissoryNote::class);
    }

    public function creditEvaluations() {
        return $this->hasMany(CreditEvaluation::class);
    }
}
