<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'guard_name'
    ];
    
    public function role()
    {
        return $this->belongsTo(ModelHasRole::class, 'id', 'role_id');
    }
}
