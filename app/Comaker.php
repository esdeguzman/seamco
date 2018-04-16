<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comaker extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function member() {
        return $this->belongsTo(Member::class);
    }

    public function loan() {
        return $this->belongsTo(Loan::class, 'loan_id');
    }

    public function requestedBy() {
        return $this->belongsTo(Member::class, 'requested_by');
    }
}
