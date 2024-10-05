<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Members extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'acc_no',
        'firstname',
        'middlename',
        'lastname',
        'nickname',
        'address',
        'religion',
        'birthdate',
        'birthplace',
        'gender',
        'mobile_no',
        'email_address',
        'occupation',
        'civil_status',
        'spouse',
        'spouse_occupation',
        'no_children',
        'mothers_name',
        'fathers_name',
        'company',
        'company_phone_no',
        'company_address',
        'source_of_income',
        'monthly_income',
        'educational_attainment',
        'contact_person',
        'contact_person_no',
        'contact_person_address',
        'status',
        'created_by',
        'updated_by',
        'deleted_at'
    ];

    public function beneficiaries()
    {
        return $this->hasMany(MemberBeneficiary::class, 'member_id', 'id');
    }
    
    public function share_capital()
    {
        return $this->hasMany(ShareCapital::class, 'member_id', 'id');
    }
    
    public function savings()
    {
        return $this->hasMany(SavingsDeposit::class, 'member_id', 'id');
    }
    
    public function details()
    {
        return $this->belongsTo(MemberDetails::class, 'id', 'member_id');
    }

}


