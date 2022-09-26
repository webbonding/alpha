<?php

namespace App\Model;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

//use Laravel\Cashier\Billable;

class UserMaster extends Model implements Authenticatable {

    use \Illuminate\Auth\Authenticatable;

    public $confirm_password;
    protected $table = 'user_master';
    protected $fillable = [
        'id', 'type_id','full_name', 'email', 'password', 'phone', 'gender','image', 'status','payment_status','subscription_end', 'remember_token', 'reset_password_token', 'activation_token', 'created_at', 'updated_at'
    ];
    protected $hidden = [
        'password', 'hash_password'
    ];

}
