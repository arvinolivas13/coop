<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'details',
        'amount',
        'date',
        'status',
        'created_by',
        'updated_by'
    ];
}
