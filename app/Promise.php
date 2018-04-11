<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promise extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function promissoryNote() {
        return $this->belongsTo(PromissoryNote::class);
    }

    public function payment() {
        return $this->hasOne(LoanPayment::class);
    }
}
