<?php

namespace App;

use App\Notifications\MemberResetPassword;
use App\Traits\Historiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use Notifiable, SoftDeletes, Historiable;

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

    public function shares() {
        return $this->hasMany(Share::class);
    }

    public function application() {
        return $this->hasOne(Application::class)->withTrashed();
    }
}
