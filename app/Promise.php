<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promise extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $appends = ['carbonated_date'];

    public function promissoryNote() {
        return $this->belongsTo(PromissoryNote::class);
    }

    public function payment() {
        return $this->hasOne(LoanPayment::class);
    }

    public function getCarbonatedDateAttribute() {
        return Carbon::parse($this->due_date)->timestamp;
    }
}
