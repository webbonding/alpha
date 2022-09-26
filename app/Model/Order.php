<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['order_number','user_id','product_id','quantity','full_name','email','phone','item_price','address'
    ,'city','state','zipcode','social_title','notes','status'];
//    public $timestamps = false;
}
