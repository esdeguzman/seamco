<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function member() {
        return $this->belongsTo(Member::class);
    }

    public function approvedBy() {
        return $this->belongsTo(Admin::class, "approved_by");
    }

    public function attendanceVerifiedBy() {
        return $this->belongsTo(Admin::class, "attendance_verified_by");
    }

    public function feesInformedBy() {
        return $this->belongsTo(Admin::class, "fees_informed_by");
    }

    public function idReleasedBy() {
        return $this->belongsTo(Admin::class, "id_released_by");
    }

    public function shareCertReleasedBy() {
        return $this->belongsTo(Admin::class, "id_released_by");
    }
}
