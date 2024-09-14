<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanPayment extends Model
{
    protected $fillable = [
        'member_id',
        'loan_schedule_id',
        'date',
        'amount',
        'penalty',
        'received_by',
        'receipt_no',
        'loan_balance',
        'status'
    ];
    
    public function member()
    {
        return $this->belongsTo(Members::class, 'member_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'received_by');
    }
    
    public function schedule()
    {
        return $this->belongsTo(LoanSchedule::class, 'loan_schedule_id');
    }
}
