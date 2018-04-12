<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Share extends Model
{
    use SoftDeletes;

    public function member() {
        return $this->belongsTo(Member::class);
    }

    public function updatedBy() {
        return $this->belongsTo(Admin::class);
    }
}
