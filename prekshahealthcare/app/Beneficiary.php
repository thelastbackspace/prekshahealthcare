<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    //
    protected $table = 'beneficiaries';
    protected $fillable = [
        'user_id', 'first_name',
        'last_name','gender', 'age',
    ];
}
