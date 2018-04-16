<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanPayment extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function member() {
        return $this->belongsTo(Member::class);
    }

    public function loan() {
        return $this->belongsTo(Loan::class);
    }

    public function promise() {
        return $this->belongsTo(Promise::class);
    }

    public function receivedBy() {
        return $this->belongsTo(Admin::class, 'received_by');
    }
}
