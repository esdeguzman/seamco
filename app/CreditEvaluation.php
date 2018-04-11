<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreditEvaluation extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function loan() {
        return $this->hasOne(Loan::class);
    }

    public function promissoryNote() {
        return $this->hasOne(PromissoryNote::class);
    }

    public function member() {
        return $this->belongsTo(Member::class);
    }
}
