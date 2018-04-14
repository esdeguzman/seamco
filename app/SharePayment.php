<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SharePayment extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function member() {
        return $this->belongsTo(Member::class);
    }

    public function receivedBy() {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
