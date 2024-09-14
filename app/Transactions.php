<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $fillable = [
        'member_id',
        'date',
        'particulars',
        'amount',
        'remarks',
        'status',
        'audit_status',
        'audit_by',
        'audit_date',
        'audit_remarks'
    ];
    
    public function member()
    {
        return $this->belongsTo(Members::class, 'member_id');
    }
}
