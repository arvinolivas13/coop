<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanRequest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'member_id',
        'income_type',
        'income_amount',
        'payment_frequency',
        'no_of_payment',
        'loan_amount',
        'loan_date',
        'reference_name_1',
        'reference_phone_1',
        'reference_relationship_1',
        'reference_name_2',
        'reference_phone_2',
        'reference_relationship_2',
        'co_maker_id',
        'status',
        'approved_by',
        'approved_date',
        'rejected_by',
        'rejected_date',
        'released_by',
        'released_date',
        'created_by',
        'updated_by',
    ];

    public function member()
    {
        return $this->belongsTo(Members::class, 'member_id');
    }
    
    public function comaker()
    {
        return $this->belongsTo(Members::class, 'co_maker_id');
    }
    
    public function details()
    {
        return $this->hasMany(LoanRequestDetails::class, 'loan_request_id', 'id');
    }
}
