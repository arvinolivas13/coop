<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanSchedule extends Model
{
    protected $fillable = [
        'member_id',
        'loan_details_id',
        'date',
        'principal_amount',
        'interest_amount',
        'amount',
        'status',
        'approved_by',
        'approved_date'
    ];
    
    public function member()
    {
        return $this->belongsTo(Members::class, 'member_id');
    }
    
    public function details()
    {
        return $this->belongsTo(LoanDetails::class, 'loan_details_id');
    }
    
    public function payment()
    {
        return $this->belongsTo(LoanPayment::class, 'id', 'loan_schedule_id');
    }
}
