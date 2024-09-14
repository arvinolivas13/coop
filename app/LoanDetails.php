<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanDetails extends Model
{
    protected $fillable = [
        'member_id',
        'loan_request_id',
        'interest_rate',
        'penalty_rate',
        'date_avail',
        'first_payment',
        'due_date',
        'loan_amount',
        'total_interest',
        'net_proceeds',
        'weekly_payment',
        'penalty_amount',
        'processing_fee',
        'created_by',
        'updated_by'
    ];
    
    public function loan()
    {
        return $this->belongsTo(LoanRequest::class, 'loan_request_id');
    }
    
    public function member()
    {
        return $this->belongsTo(Members::class, 'member_id');
    }
    
    public function schedule()
    {
        return $this->hasMany(LoanSchedule::class, 'loan_details_id', 'id');
    }
}
