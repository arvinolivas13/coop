<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberDetails extends Model
{
    protected $fillable = [
        'member_id',
        'photo',
        'signature',
        'valid_id',
        'member_fee',
        'approve',
        'approve_by',
        'or_no',
        'resolution_no',
        'date',
    ];
}
