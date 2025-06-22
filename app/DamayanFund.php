<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DamayanFund extends Model
{
    protected $fillable = [
        'member_id',
        'amount',
        'date',
        'status',
        'created_by',
        'updated_by'
    ];
    
    public function member()
    {
        return $this->belongsTo(Members::class, 'member_id');
    }
}
