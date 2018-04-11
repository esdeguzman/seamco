<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromissoryNote extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function member() {
        return $this->belongsTo(Member::class);
    }

    public function loan() {
        return $this->belongsTo(Loan::class);
    }

    public function promises() {
        return $this->hasMany(Promise::class);
    }

    public function creditEvaluation() {
        return $this->belongsTo(CreditEvaluation::class);
    }
}
