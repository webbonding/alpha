<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserInfromation extends Model
{
    protected $fillable = ['user_id','full_name','email','phone','address','city','state','zipcode','social_title','status'];
    protected $table = 'user_information';
}
