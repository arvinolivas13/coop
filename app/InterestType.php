<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InterestType extends Model
{
    protected $fillable = ['name', 'description', 'rate'];
}
