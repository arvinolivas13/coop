<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SavingsDeposit extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'member_id',
        'date',
        'amount',
        'receipt_number',
        'balance',
        'created_by',
        'updated_by',
        'damayan_status'
    ];
}
