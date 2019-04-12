<?php

namespace App;

use App\Traits\Historiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    use SoftDeletes, Historiable;

    protected $guarded = [];

    public function member() {
        return $this->belongsTo(Member::class);
    }

    public function comaker() {
        return $this->hasOne(Comaker::class);
    }

    public function creditEvaluation() {
        return $this->belongsTo(CreditEvaluation::class);
    }

    public function payments() {
        return $this->hasMany(LoanPayment::class);
    }

    public function promissoryNote() {
        return $this->hasOne(PromissoryNote::class);
    }
}
