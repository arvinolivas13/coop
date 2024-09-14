<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanRequestDetails extends Model
{
    protected $fillable = [
        'loan_request_id',
        'loan_purpose',
        'amount',
    ];

    protected $table = 'loan_requests_details';
}
