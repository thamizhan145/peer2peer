<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public $fillable = ['user_id','account_name','account_no','bank_name','account_type'];
}