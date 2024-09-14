<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberBeneficiary extends Model
{
    protected $fillable = [
        'member_id',
        'name',
        'age',
        'relationship',
    ];
}
